<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>.:: Estado Transacción ::.</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<div class="jumbotron">
  <h1 class="display-4">Gracias por Comprar en Tienda en Línea</h1>
  <p class="lead">Datos Personales</p>
  <p class="lead">Nombres: <b><?php echo $orders->custome_name; ?></b></p>
  <p class="lead">Email  : <b><?php echo $orders->custome_email; ?></b></p>
  <p class="lead">Celular: <b><?php echo $orders->custome_mobile; ?></b></p>
  <p class="lead">Detalles de la Orden</p>
  <hr class="my-4">
  <form id="orders" name="orders">
    {{ method_field('POST') }}
    {{ csrf_field() }}
    <table class="table table-striped table-bordered" style="width:100%" id="detalles_ordenes">
          <thead>
              <tr>
                  <th>Código</th>
                  <th>Artículo</th>
              </tr>
              <tr>
              <?php foreach($details as $filas){ ?>
                <td><?php echo $filas->codigo; ?></td>
                <td><?php echo $filas->descripcion; ?></td>
              <?php } ?>
              <tr>
                <td colspan="2" align="right">Total a Pagar: <?php echo '$'.number_format($orders->valor,0,',','.'); ?></td>
              </tr>
           </thead>
          <tbody>
          </tbody>
    </table>
  </form>
  <p></p>
  <p class="lead" style="text-align: right;">
     <button type="button" class="btn btn-success" id="pagar_orden" name="pagar_orden">
      <i class="bi bi-cart-check-fill"></i>
      Pagar
    </button>
  </p>
</div>

<script type="text/javascript">
  $(document).ready(function () {

     //$('#detalles_ordenes').DataTable();
     
     var datos = $("#orders").serialize();

     $("#pagar_orden").click(function(){

        jQuery("#pagar_orden").attr("disabled","disabled");
            
        if(confirm("Desea confirmar la orden?")){
    
            var jqXHR = $.ajax({
                    type: "POST",
                    url: "{{ url('orders/thankey') }}/{{$id}}",
                    data: datos,
                    beforeSend: function () {
                       Swal.fire({
                          icon: 'info',
                          title: "Orden",
                          text: "Procesando Orden, por favor espere",
                          showConfirmButton: false,
                          timer: 3500
                      });
                    },
                    success: function(data) {

                      if(data.status.status==='OK'){

                        console.log(data.status.status);
                        console.log(data.requestId);
                        console.log(data.processUrl);

                        Swal.fire({
                            icon: 'success',
                            title: data.status.message,
                            timer: 1500
                        });

                        $(location).attr('href',data.processUrl);

                      }                       

                    },
                    error: function(data) {

                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: "Algo pasó con la petición,intente nuevamente!"
                        });

                        $("#pagar_orden").removeAttr("disabled");
  
                    }
                });

        }
    });
});
  
</script>