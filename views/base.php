<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

  <title>Mercado ( PHP e Postgresql )</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">

  <!-- Bootstrap core CSS -->
  <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">
</head>

<body>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

  <script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
  <script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">PHP e Postgres 9.4</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?php if ($active == 'products') { ?> active <?php } ?> ">
            <a class="nav-link" href="/products">Produtos</a>
          </li>
          <li class="nav-item <?php if ($active == 'products-types') { ?> active <?php } ?> ">
            <a class="nav-link" href="/products-types">Tipos de Produtos</a>
          </li>
          <li class="nav-item <?php if ($active == 'sales') { ?> active <?php } ?> ">
            <a class="nav-link" href="/sales">Vendas</a>
          </li>
        </ul>

      </div>
    </nav>
  </header>

  <!-- Begin page content -->
  <main role="main" class="container">

    <?php if ($_SESSION['message_error'] != null) { ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['message_error'] ?>

      </div>
    <?php } ?>

    <?php if ($_SESSION['message_success'] != null) { ?>
      <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['message_success'] ?>

      </div>
    <?php } ?>

    <div style="height: 20px;"></div>
    <?php
    switch ($page) {
      case 'products_types_list':
        include 'views/products_types_list.php';
        break;
      case 'products_types':
        include 'views/products_types.php';
        break;
      case 'products_list':
        include 'views/products_list.php';
        break;
      case 'products':
        include 'views/products.php';
        break;
      case 'sales_list':
        include 'views/sales_list.php';
        break;
      case 'sales':
        include 'views/sales.php';
        break;
      case 'sales_show':
        include 'views/sales_show.php';
        break;
    }
    ?>
  </main>

  <footer class="footer">
    <div class="container">
      <span class="text-muted">PHP com Postgresql 9.4</span>
    </div>
  </footer>



  <script>
    $(function() {
      $('.currency').maskMoney();
    });
  </script>
</body>

</html>
<?php session_unset(); ?>