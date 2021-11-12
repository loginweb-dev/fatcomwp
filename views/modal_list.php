<?php 
    require_once('../../../../wp-load.php');
    // $orders = wc_get_orders(array('limit' => 100, 'orderby' => 'date'));
    $args = array(
        'post_type'        => 'pos_register',
        'post_status'        => 'publish',
        'orderby' => 'date',
        // 'author' => '-1',
    );
    $rows = get_posts( $args );
?>
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6 col-sm-12">
        
          <div class="form-group text-center">
            <h5 >CAJAS DISPONIBLES</h5>  
          </div>
         
          <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Accion</th>
              </tr>
            </thead>
            <tbody>
              <?php for($i=0; $i < count($rows); $i++) {  $outlet = get_post(get_post_meta($rows[$i]->ID, 'outlet', true)); ?>
                <tr>
                    <td>
                        <?php echo 'ID: '.$rows[$i]->ID; ?>
                        <br />
                        <?php echo $rows[$i]->post_date; ?>
                    </td>
                    <td>
                      <?php echo $rows[$i]->post_title; ?>
                      <br />
                      <?php echo $outlet->post_title; ?>
                    </td>
                    <td><button onclick="box_change('<?php echo $rows[$i]->ID; ?>')" class="btn btn-sm btn-dark">Cambiar</button></td>
                </tr>

              <?php } ?>
            </tbody>
          </table>
          <!-- <div class="border-top form-group text-center">
              <button class="btn btn-primary"> Nueva Caja</button>
              <button class="btn btn-dark"> Cerra</button>
          </div> -->
        </div>
 
      </div>
    </div>

 