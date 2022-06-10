<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>.:: Tienda Online ::.</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Tienda en Línea</h3>
            </div>

            <ul class="list-unstyled components">
                <p>Menú Principal</p>
                <li>
                    <a href="{{url('/')}}"></i> Inicio</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Ordenes</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="../orders"><i class="bi bi-cart-plus-fill"></i> Nueva</a>
                        </li>
                        <li>
                            <a href="../orders/list"><i class="bi bi-calendar2-range"></i> Listar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info xs">
                        <span>
                            <i class="bi bi-skip-start-btn-fill"></i>
                        </span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                </div>
            </nav>

            <div id="pintar_vistas"></div>
               <?php 
                if($vista=='lista'){ ?>
                    @include('orders.orderstable')
               <?php } ?>
            </div>

            
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
        
        var detalles  = [];

        var dialogo = {
            autoOpen: false,
            modal: true,
            width: 300,
            height:300,
            title: 'Mensaje'
        };
        
        $(document).ready(function () {

            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

            $('#example').DataTable();

            $( "#articulos" ).autocomplete({
                  source: "{{ url('articles/autocomplete')}}",
                  minLength: 0,
                  select: function( event, ui ) {
                        
                        const id_articulos     = ui.item.id;
                        const codigo           = ui.item.codigo;
                        const descripcion      = ui.item.descripcion;
                        const valor            = ui.item.valor;
                        const valor_formateado = ui.item.valor_formateado;
                        const anulado          = ui.item.anulado;

                        $("#id_articulos").val(id_articulos);
                        $("#articulos").val(descripcion);
                        $("#descripcion").val(descripcion);
                        $("#codigo_articulo").val(codigo);
                        $("#articulos").val(descripcion);
                        $("#valor_formateado").val(valor_formateado);
                        $("#subtotal").val(valor);
                        
                        /*console.log("Id Artículo: ");
                        console.log(id_articulo);
                        console.log("Código: ");
                        console.log(codigo);
                        console.log("Artículos: ");
                        console.log(descripcion);
                        console.log("Valor: ");
                        console.log(valor);*/
                            
                  }
            });

            //agregar_item(id_articulos, codigo, descripcion, valor, valor_formateado, anulado);

            $("#guardar").click(function(){
            
                if(confirm("Desea guardar la orden?")){
                
                    $("#agregar_item").attr("disabled","disabled");
                    $("#guardar").attr("disabled","disabled");

                    //console.log(detalles.length);
                    //console.log($("#detalles").val());

                    if($("#detalles").val()!='' && $("#nombres").val()!='' && $("#email").val()!='' && $("#celular").val()!='' && detalles.length>0){

                        var datos = $("#form_order").serialize();
                        
                        var jqXHR = $.ajax({
                            type: "POST",
                            url: "{{ url('orders/store') }}",
                            data: datos,
                            success: function(data) {
                                
                                /*Swal.fire({
                                  icon: 'success',
                                  title: "Orden Guardada Correctamente!",
                                  showConfirmButton: false,
                                  timer: 1500
                                });*/

                                $("#mensaje").html(data);

                                var json=JSON.stringify(data);

                                console.log(json.url);

                                $("#agregar_item").removeAttr("disabled");
                                $("#guardar").removeAttr("disabled");
                            },
                            error: function(data) {
                                $("#agregar_item").removeAttr("disabled");
                                $("#guardar").removeAttr("disabled");
                            }
                        });

                    }else{
                        
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'La orden no tiene artículos, favor verificar'
                        })
                
                        $("#guardar").removeAttr("disabled");
                        $("#guardar2").removeAttr("disabled");
                    }

                }else{
                    $("#guardar").removeAttr("disabled");
                    $("#guardar2").removeAttr("disabled");
                }
            });
        });

        function agregar_item(){

            var id_articulos   =$("#id_articulos").val();
            var codigo_articulo=$("#codigo_articulo").val();
            var subtotal       =$("#subtotal").val();
            var descripcion    =$("#descripcion").val();
            var cantidad       =$("#cantidad").val();

            detalles.push({ 
                "id"               : id_articulos,
                "codigo"           : codigo_articulo,
                "descripcion"      : descripcion,
                "cantidad"         : cantidad,
                "subtotal"         : subtotal,
                "valor"            : subtotal*cantidad,
                "valor_formateado" : valor_formateado,
                "anulado"          : "NO"
            });
            
            console.log(JSON.stringify(detalles));
            $("#detalles").val(JSON.stringify(detalles));

            actualizar_tabla(detalles);

            $("#id_articulos").val("");
            $("#articulos").val("");
            $("#cantidad").val("");

        }

        function actualizar_tabla(miJSON){          

            let valor=0;

            if(miJSON.length==1){
    
                $.each(miJSON, function(i,item){
                    $("#orden_detalles").append('<tr><td>'+item.codigo+'</td><td>'+item.descripcion+'</td><td>'+item.cantidad+'</td><td>'+item.subtotal+'</td><td>'+item.valor+'</td><td align="center"><button type="button" onclick="javascript:quitar('+item.id+');"><i class="bi bi-trash3-fill"></i></button></tr>');
                        valor=parseInt(valor)+parseInt(item.valor);
                });
                
                totalizar();        

            }else{

                $("#orden_detalles > tbody"). empty();
                
                $.each(miJSON, function(i,item){
                    $("#orden_detalles").append('<tr><td>'+item.codigo+'</td><td>'+item.descripcion+'</td><td align="center">'+item.cantidad+'</td><td>'+item.subtotal+'</td><td>'+item.valor+'</td><td align="center"><button type="button" onclick="javascript:quitar('+item.id+');"><i class="bi bi-trash3-fill"></i></button></tr>');
                        valor=parseInt(valor)+parseInt(item.valor);
                });

                totalizar();

            }

        }

        function totalizar(){
            var subtotal = 0;
            console.log("tam: ",detalles.length);
            for(i=0;i<detalles.length;i++) {  
                if(detalles[i].anulado == 'NO'){
                    subtotal    += parseFloat(detalles[i].subtotal)*parseFloat(detalles[i].cantidad);    
                 console.log("valor:"+detalles[i].valor);
                 console.log("cantidad: "+detalles[i].cantidad);
                }
            }
            var currencyString = numeral(subtotal);
            $("#valor_orden").text(currencyString.format('$0,0.00'));
            $("#valor_input_orden").val(subtotal);
        }
    </script>
    </body>
</html>