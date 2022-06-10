@if( $guardar==true )
<script type="text/javascript">

    Swal.fire({
          icon: 'success',
          title: "Orden",
          text: "{{$mensaje}}",
          showConfirmButton: false,
          timer: 1500
    });

    url="{{ url('orders/show/').'/'.$order_id }}";
    $(location).attr('href',url); 


</script>
@else
<script type="text/javascript">

    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: "{{$mensaje}}"
    })

</script>
@endif