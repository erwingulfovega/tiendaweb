<h5>Nueva Orden</h5>
<form id="form_order" name="form_order">
    {{ method_field('POST') }}
    {{ csrf_field() }}
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Nombres Completos</label>
        <input type="text" class="form-control" id="nombres" name="nombres">
      </div>
      <div class="form-group col-md-6">
        <label>Email</label>
        <input type="email" class="form-control" id="email" name="email">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label>Celular</label>
        <input type="email" class="form-control" id="celular" name="celular">
      </div>
      <div class="form-group col-md-6">
        <label>Artículos</label>
        <input type="hidden" class="form-control" id="id_articulos" name="id_articulos">
        <input type="hidden" class="form-control" id="descripcion" name="description">
        <input type="hidden" class="form-control" id="codigo_articulo" name="codigo_articulo">
        <input type="hidden" class="form-control" id="subtotal" name="subtotal">
        <input type="hidden" class="form-control" id="valor_formateado" name="valor_formateado">
        <input type="text" class="form-control" id="articulos" name="articulos">
      </div>
      <div class="form-group col-md-6">
        <label>Cantidad</label>    
        <input type="text" class="form-control" id="cantidad" name="cantidad">
      </div>
    </div> 
    <div class="form-group">
        <button type="button" class="btn btn-primary" onclick="javascript:agregar_item();"><i class="bi bi-save2-fill"></i>
          Agregar item
        </button>
    </div>
    <h5>Artículos en la Orden</h5>
        <div class="form-group">
          <input type="hidden" id="detalles" name="detalles" style="display:none;">
          <table class="table table-striped table-bordered" style="width:100%" id="orden_detalles">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Valor</th>
                    <th><div style="text-align: center;">Opción</div></th>
                </tr>
                <tr id="total_orden">
                </tr>
             </thead>
            <tbody>
            </tbody>
        </table>
        <div style="text-align:right;">Total: 
          <div id="valor_orden"></div>
          <input id="valor_input_orden" name="valor_input_orden" type="hidden">
        </div>
        </div>      
  </form>
    <div class="form-group">
    <button type="button" class="btn btn-success" id="guardar" name="guardar"><i class="bi bi-cart-check-fill"></i>
    Guardar Orden</button>
  </div>
  
  <div id="mensaje"></div>

  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle de la Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Pagar</button>
      </div>
    </div>
  </div>
</div>