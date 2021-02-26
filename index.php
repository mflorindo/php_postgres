<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/models/BaseModel.php';
require_once __DIR__ . '/controllers/ProductTypeController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/SaleController.php';


use Steampixel\Route;

Route::add('/', function () {

    include 'views/base.php';
});


################################################
# sales
##############################################

/* List sales */
Route::add('/sales', function () {
    $controller = new SaleController();
    $controller->list();
}, 'get');

/* Open new form to sales */
Route::add('/sales/new', function () {
    $controller = new SaleController();
    $controller->create();
}, 'get');

/* stored a sales */
Route::add('/sales/store', function () {

    $controller = new SaleController();
    $controller->store($_POST);

}, 'post');

/* delete a sales */
Route::add('/sales/delete/([0-9-]*)', function ($id) {

    $controller = new SaleController();
    $controller->delete($id);
});

/* show datas of the sales */
Route::add('/sales/show/([0-9-]*)', function ($id) {
    $controller = new SaleController();
    $controller->show($id);
}, 'get');




################################################
# products
##############################################

Route::add('/products', function () {
    $controller = new ProductController();
    $controller->list();
}, 'get');

Route::add('/products/new', function () {
    $controller = new ProductController();
    $controller->create();
}, 'get');

Route::add('/products/store', function () {

    $controller = new ProductController();
    $controller->store($_POST);

}, 'post');

Route::add('/products/([0-9-]*)/edit', function ($id) {
    $controller = new ProductController();
    $controller->edit($id);
}, 'get');

Route::add('/products/update', function () {

    $controller = new ProductController();
    $controller->update($_POST);

}, 'post');

Route::add('/products/delete/([0-9-]*)', function ($id) {

    $controller = new ProductTypeController();
    $controller->delete($id);
});

################################################
# products type
################################################
Route::add('/products-types', function () {
    $controller = new ProductTypeController();
    $controller->list();
}, 'get');

Route::add('/products-types/new', function () {
    $controller = new ProductTypeController();
    $controller->create();
}, 'get');

Route::add('/products-types/store', function () {

    $controller = new ProductTypeController();
    $controller->store($_POST);

}, 'post');

Route::add('/products-types/([0-9-]*)/edit', function ($id) {
    $controller = new ProductTypeController();
    $controller->edit($id);
}, 'get');

Route::add('/products-types/update', function () {

    $controller = new ProductTypeController();
    $controller->update($_POST);

}, 'post');

Route::add('/products-types/delete/([0-9-]*)', function ($id) {

    $controller = new ProductTypeController();
    $controller->delete($id);
});

Route::add('/vendas', function () {
    $active = 'vendas';
    include 'views/base.php';
}, 'get');

// Run the router
Route::run('/');
