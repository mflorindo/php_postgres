<?php

require_once __DIR__ . '/BaseController.php';

use models\BaseModel;

/*
 * Class responsible for product control and rules.
 */
class ProductController extends BaseController
{

     
    /**
     * list all products
     *
     * @return void
     */
    public function list()
    {
        $active = 'products';
        $bm = new BaseModel();

        $sql = 'select product.id, product.name,product.price, pt.name as product_type_name from product
         inner join product_type pt on product.product_type_id = pt.id order by product.name';

        $list = $bm->query($sql);
        $list_value = [];

        foreach ($list as $key => $value) {
            $t = $this->removeMaskMoneyToView($value['price']);
            array_push($list_value, ['id' => $value['id'], 'name' => $value['name'], 'price' => $t, 'product_type_name' => $value['product_type_name']]);
        }

        $list = $list_value;

        $page = 'products_list';
        include 'views/base.php';
    }

    
    /**
     * create a new form to product
     *
     * @return void
     */
    public function create()
    {
        $active = 'products';
        $bm = new BaseModel();
        $sql = "select * from product_type order by name";
        $productsTypes = $bm->query($sql);
        $page = 'products';
        include 'views/base.php';
    }

    
    /**
     * save a product
     *
     * @param  mixed $datas
     * @return void
     */
    public function store($datas)
    {
        $active = 'products';
        $bm = new BaseModel();
        $bm->table = 'product';
        $haveError = false;

        //check if value exist in table
        $sql = "select count(*) as count from product where upper(name) = upper('" . $datas['name'] . "') and product_type_id =" . $datas['product_type_id'];

        $return = $bm->query($sql);

        // return if exist same name
        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Nome de produto já existente no sistema para a mesmo tipo de produto';
            $haveError = true;
        }

        if ($haveError == false) {
            $datas['price'] = $this->convertMoneyToDatabase($datas['price']);
            $bm->insert($datas);
            $_SESSION["message_success"] = 'Produto inserido com sucesso';
            header("Location: /products");
        } else {
            $name_ = $datas['name'];
            $product_type_id_ = $datas['product_type_id_'];
            $price_ = $datas['price'];
            $page = 'products';
            include 'views/base.php';
        }
    }
    
    /**
     * Select one product and open form with datas (product)
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $active = 'products';
        $bm = new BaseModel();
        $bm->table = 'product';
        $haveError = false;

        $sql = "select * from product where id = " . $id;
        $object = ($bm->query($sql))->fetch();



        $sql = "select * from product_type order by name";
        $productsTypes = $bm->query($sql);

        $name_ = $object['name'];
        $product_type_id_ = $object['product_type_id'];
        $id_ = $object['id'];
        $price_ = number_format($this->removeMaskMoneyToView($object['price']), 2, ',', '.');
        $page = 'products';
        include 'views/base.php';
    }
    
    /**
     * Updates a product. The "id" field must exist
     *
     * @param  mixed $datas
     * @return void
     */
    public function update($datas)
    {

        $active = 'products';
        $bm = new BaseModel();
        $bm->table = 'product';
        $haveError = false;

        //check if value exist in table
        $sql = "select count(*) as count from product where upper(name) = upper('" . $datas['name'] . " ') and  product_type_id=" . $datas['product_type_id'] . " and id <>" . $datas['id'];
        //echo $sql;exit;
        $return = $bm->query($sql);

        // return if exist same name
        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Nome de produto já existente no sistema para a mesmo tipo de produto';
            $haveError = true;
            $name_ = $datas['name'];
            $product_type_id_ = $datas['product_type_id'];
            $id_ = $datas['id'];
            $price_ = $datas['price'];
            $page = 'products';
            include 'views/base.php';
        }

        if ($haveError == false) {
            $datas['price'] = $this->convertMoneyToDatabase($datas['price']);
            $bm->update($datas, $datas['id']);
            $_SESSION["message_success"] = 'Produto alterado com sucesso';
            header("Location: /products");
        } else {
            $name_ = $datas['name'];
            $product_type_id_ = $datas['product_type_id'];
            $id_ = $datas['id'];
            $price_ = $datas['price'];
            $page = 'products';
            include 'views/base.php';
        }
    }
    
    /**
     * Delete a product
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $active = 'products';
        $bm = new BaseModel();
        $bm->table = 'product';
        $haveError = false;

        // check if exist FK
        $sql = "select count(*) as count from sales where product_id = " . $id;
        $return = $bm->query($sql);

        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Não poderá ser excluído. Há vendas vinculadas a este produto';
        } else {

            $bm->delete($id);
            $_SESSION['message_success'] = 'Produto excluído com sucesso';
        }

        header("Location: /products");
    }
}
