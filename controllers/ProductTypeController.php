<?php
session_start();
require_once __DIR__ . '/BaseController.php';

use models\BaseModel;

/**
 * ProductTypeController
 */
class ProductTypeController extends BaseController
{
    
    /**
     * list
     *
     * @return void
     */
    public function list() {
        $active = 'products-types';
        $bm = new BaseModel();
        $sql = 'select * from product_type order by name';
        $list = $bm->query($sql);

        $page = 'products_types_list';
        include 'views/base.php';

    }
    
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        $active = 'products-types';
        $page = 'products_types';
        include 'views/base.php';
    }
    
    /**
     * store
     *
     * @param  mixed $datas
     * @return void
     */
    public function store($datas)
    {
        $active = 'products-types';
        $error = null;
        $bm = new BaseModel();
        $bm->table = 'product_type';
        $haveError = false;


        //check if value exist in table
        $sql = "select count(*) as quantidade from product_type where upper(name) = upper('" . $datas['name'] . "')";
        $return = $bm->query($sql);

        // return if exist same name
        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Nome do tipo de produto já existente no sistema';
            $haveError = true;

        }

        if ($haveError == false) {
            $datas['tax'] = $this->convertMoneyToDatabase($datas['tax']);
            $bm->insert($datas);
            $_SESSION["message_success"] = 'Produto inserido com sucesso';
            header("Location: /products-types");
        } else {
            $name_ = $datas['name'];
            $tax_ = $datas['tax'];
            $page = 'products_types';
            include 'views/base.php';
        }

    }
    
    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        $active = 'products-types';
        $bm = new BaseModel();
        $bm->table = 'product_type';
        $haveError = false;

        $sql = "select * from product_type where id = " . $id;
        $object = ($bm->query($sql))->fetch();

        $name_ = $object['name'];
        $tax_ = number_format($object['tax'],2,',','.');
        $id_ = $object['id'];
        $page = 'products_types';
        include 'views/base.php';
    }
    
    /**
     * update
     *
     * @param  mixed $datas
     * @return void
     */
    public function update($datas)
    {

        $active = 'products-types';
        $error = null;
        $bm = new BaseModel();
        $bm->table = 'product_type';
        $haveError = false;

        

        //check if value exist in table
        $sql = "select count(*) as count from product_type where upper(name) = upper('" . $datas['name'] . " ') and id <>" . $datas['id'];
        $return = $bm->query($sql);

        // return if exist same name
        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Nome do tipo de produto já existente no sistema';
            $haveError = true;
            $name_ = $datas['name'];
            $tax_ = $datas['tax'];
            $id_ = $datas['id'];
            $page = 'products_types';
            include 'views/base.php';

        }

        if ($haveError == false) {
            $datas['tax'] = $this->convertMoneyToDatabase($datas['tax']);            
            $bm->update($datas, $datas['id']);
            $_SESSION["message_success"] = 'Produto alterado com sucesso';
            header("Location: /products-types");
        } else {
            $name_ = $datas['name'];
            $tax_ = $datas['tax'];
            $id_ = $datas['id'];
            $page = 'products_types';
            include 'views/base.php';
        }

    }
    
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */    
    /**
     * delete
     *
     * @param  mixed $id
     * @return void
     */
    public function delete($id)
    {
        $active = 'products-types';
        $bm = new BaseModel();
        $bm->table = 'product_type';
        $haveError = false;

        // check if exist FK
        $sql = "select count(*) as count from product where product_type_id = " . $id;
        $return = $bm->query($sql);

        


        if ($return->fetchColumn() > 0) {
            $_SESSION['message_error'] = 'Não poderá ser excluído. Há produtos vinculados a este tipo de produto';
        } else {
            
            $bm->delete($id);
            $_SESSION['message_success'] = 'Tipo de produto excluído com sucesso';
        }

        header("Location: /products-types");
    }

}
