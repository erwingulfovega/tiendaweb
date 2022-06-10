<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>.:: Estado Transacción ::.</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<div class="jumbotron">
  <h1 class="display-4">Gracias por tu Compra en Tienda en Línea</h1>
  <p class="lead">Resumen de la Orden</p>
  <p class="lead">Orden Nro   : <b><?php echo $order_id; ?></b></p>
  <p class="lead">Valor Orden : <b><?php echo '$ '.number_format($valor,'0',',','.'); ?></b></p>
  <p class="lead">Mensaje     : <b><?php echo $message; ?></b></p>
  <p class="lead">Fecha       : <b><?php echo $fecha; ?></b></p>
  <p></p>
  <p class="lead" style="text-align: right;">
      <a href="{{ url('orders/list') }}" class="btn btn-primary stretched-link"><i class="bi bi-cart-check-fill"></i>
      Ir a ordenes
      </a>
  </p>
</div>