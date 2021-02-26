<?php

require_once __DIR__ . '/BaseController.php';

use models\BaseModel;

/*
 * Class responsible for sales control and rules.
 */
class SaleController extends BaseController
{

    private $bm;
        
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->bm = new BaseModel();
    }
    function list()
    {
        $active = 'sales';
        $sql = 'select sales.id, sales.purchase_date,
                    (select sum(sales_products.value_product) 
                        from sales_products where sales_products.sales_id = sales.id) as sum_products,
                    (select sum(sales_products.quantity) 
                        from sales_products where sales_products.sales_id = sales.id) as count_products,
                    (select sum(sales_products.value_tax) 
                        from sales_products where sales_products.sales_id = sales.id) as  sum_tax
                from sales';

        $list = $this->bm->query($sql);
        $list_temp = [];

        foreach ($list as $key => $value) {

            $tsum = $this->removeMaskMoneyToView($value['sum_products']);
            $ttax = $this->removeMaskMoneyToView($value['sum_tax']);
            if ($tsum == '') {
                $tsum = 0;
            }
            if ($ttax == '') {
                $ttax = 0;
            }
            array_push(
                $list_temp,
                [
                    'id' => $value['id'],
                    'purchase_date' => date('d/m/Y - H:m:i', strtotime($value['purchase_date'])),
                    'sum_products' => number_format($tsum, 2, ',', '.'),
                    'sum_tax' => number_format($ttax, 2, ',', '.'),
                    'count_products' => $value['count_products']
                ]
            );
        }

        $list = $list_temp;

        $page = 'sales_list';
        include 'views/base.php';
    }
    
    /**
     * Create a new form to sales
     *
     * @return void
     */
    public function create()
    {
        $active = 'sales';
        $bm = new BaseModel();
        $sql = "select * from product order by name";
        $products = $this->bm->query($sql);
        $page = 'sales';
        $id_ = 0;
        $list_value = [];

        foreach ($products as $key => $value) {
            $t = $this->removeMaskMoneyToView($value['price']);
            array_push($list_value, ['id' => $value['id'], 'name' => $value['name'], 'price' => $t, 'product_type_name' => $value['product_type_name']]);
        }

        $products = $list_value;
        include 'views/base.php';
    }

    /**
     * stored a sales. Using ajax and created json.
     *
     * @param  mixed $datas
     * @return void
     */
    public function store($datas)
    {

        $product_id = $datas['product_id'];
        $quantity = $datas['quantity'];
        $id_ = (int)$datas['id_'];
        $bm = new BaseModel();

        // get price product
        $sql = "select price,tax from product
                    inner join product_type pt 
                    on product.product_type_id = pt.id where product.id=$product_id";

        $return = $this->bm->query($sql);
        $product_information = $return->fetch();
        $price = $this->removeMaskMoneyToView($product_information['price']);
        $tax = $this->removeMaskMoneyToView($product_information['tax']);

        //if $id_ = 0 then insert sales
        if ($id_ == 0) {
            $date = date('Y-m-d H:i:s');
            $this->bm->table = 'sales';
            $this->bm->insert(['purchase_date' => $date]);
            $id_ = $this->bm->getLastInsertId('sales_id_seq');
        }

        //save products in sales_products
        $this->bm->table = 'sales_products';
        $valueTax = $price * ($tax / 100);


        $this->bm->insert(['product_id' => $product_id, 'value_product' => $price, 'value_tax' => $valueTax, 'sales_id' => $id_, 'quantity' => $quantity]);

        header('Content-type: application/json');
        $summation = $this->summation($id_);
        $products = $this->getProducts($id_);


        echo json_encode(
            [
                'id_' => $id_,
                'sum_products' => number_format($this->removeMaskMoneyToView($summation['sum_products']), 2, ',', '.'),
                'sum_tax' => number_format($summation['sum_tax'], 2, ',', '.'),
                'products' => $products
            ]
        );
    }
    
    /**
     * Show form Sales
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        $active = 'sales';
        $page = 'sales_show';
        $summation = $this->summation($id);
        $products = $this->getProducts($id);

        $datas = [
                'sum_products' => number_format($this->removeMaskMoneyToView($summation['sum_products']), 2, ',', '.'),
                'sum_tax' => number_format($summation['sum_tax'], 2, ',', '.'),
                'products' => $products
        ];

        include 'views/base.php';
    }

    
    /**
     * Delete a sales
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $active = 'sales';
        $bm = new BaseModel();
        $this->bm->table = 'sales';
        $this->bm->delete($id);
        $_SESSION['message_success'] = 'Produto excluído com sucesso';
        header("Location: /sales");
    }
    
    /**
     * Summation products and tax
     *
     * @param  mixed $salesId
     * @return void
     */
    public function summation($salesId)
    {


        $sql = "select 
                    sum(value_product * quantity) as sum_products,
                    sum(value_tax) as sum_tax        
                from sales_products
                where sales_id = $salesId";

        $return = $this->bm->query($sql);
        return $return->fetch();
    }
    
    /**
     * Get all products of the a Sales.
     *
     * @param  mixed $id
     * @return void
     */
    public function getProducts($id)
    {

        $sql = "select

        p.name as product_name,
        pt.name as product_type_name,
        sales_products.quantity,
        sales_products.value_product,
        sales_products.value_tax,
        (quantity * value_product) as subtotal
    from sales_products
    inner join product p on sales_products.product_id = p.id
    inner join product_type pt on p.product_type_id = pt.id
    where sales_id = $id
    order by product_name";

        $return = $this->bm->query($sql);
        $list = [];
        foreach ($return->fetchAll() as $key => $value) {
            array_push($list, [
                'product_name' => $value['product_name'],
                'product_type_name' => $value['product_type_name'],
                'quantity' => $value['quantity'],
                'value_product' => number_format($this->removeMaskMoneyToView($value['value_product']), 2, ',', '.'),
                'value_tax' => number_format($value['value_tax'], 2, ',', '.'),
                'subtotal' => number_format($this->removeMaskMoneyToView($value['subtotal']), 2, ',', '.'),

            ]);
        };

        return  $list;
    }
}
