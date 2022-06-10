<h4>Listado de Ordenes</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                  <thead>
                      <tr>
                          <th>Id Orden</th>
                          <th>Cliente</th>
                          <th>Email</th>
                          <th>Móvil</th>
                          <th>Valor</th>
                          <th>Status</th>
                          <th>Fecha Creación</th>
                          <th>Opciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                      <?php foreach($orders as $filas){ ?>
                        <td><?php echo $filas->id; ?></td>
                        <td><?php echo $filas->custome_name; ?></td>
                        <td><?php echo $filas->custome_email; ?></td>
                        <td><?php echo $filas->custome_mobile; ?></td>
                        <td><?php echo $filas->valor; ?></td>
                        <td><?php if($filas->status=='PAYED'){ ?>
                            <div class="alert alert-success" role="alert">
                              PAGADA
                            </div>
                            <?php }else if($filas->status=='CREATED') { ?>
                              <div class="alert alert-primary" role="alert">
                              CREATED
                              </div>
                            <?php }else{ ?>
                              <div class="alert alert-danger" role="alert">
                              RECHAZADA
                              </div>
                            <?php } ?>
                        </td>
                        <td><?php echo $filas->created_at; ?></td>
                        <td>
                          <?php if($filas->status=='CREATED'){ ?>
                          <a class="btn btn-primary" href="{{ url('orders/show').'/'.$filas->id; }}" role="button">
                            <i class="bi bi-cart-check-fill"></i>Pagar
                          </a>
                         <?php }else{ ?>
                         <a class="btn disabled" href="#" role="button">
                            <i class="bi bi-cart-check-fill"></i>Pagar
                          </a>
                         <?php } ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
              </table>