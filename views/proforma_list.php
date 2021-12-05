
<?php 
    require_once('../../../../wp-load.php');
    $proformas = get_posts(array('post_type'  => 'lw_proformas', 'orderby' => 'date')); 
?>
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="title">Todas tus proformas <button onclick="create()" class="btn btn-sm btn-dark">Nueva</button></h4>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-sm-12">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Titulo</th>
                <th scope="col">Cliente</th>
                <th scope="col">Producto</th>
                <th scope="col">Plan</th>
                <!-- <th scope="col">Chatbot</th> -->
              </tr>
            </thead>
            <tbody>
              <?php foreach($proformas as $proforma) { ?>
                <tr>
                  <td>
                      <?php echo $proforma->ID; ?>
                      <br />
                      <?php echo $proforma->post_date; ?>
                  </td>
                  <td>
                    <?php echo $proforma->post_title; ?>
                  </td>
                  <td>
                    <?php echo get_post_meta($proforma->ID, 'lw_customer', true); ?>
                    <br />
                    <?php echo get_post_meta($proforma->ID, 'lw_customer_name', true); ?>
                  </td>
                  <td>
                    <?php echo get_post_meta($proforma->ID, 'lw_product', true); ?>
                    <br />
                    <?php echo get_post_meta($proforma->ID, 'lw_product_name', true); ?>
                  </td>
                  <td>
                    <?php echo get_post_meta($proforma->ID, 'lw_term', true); ?>
                    <br />
                    <?php echo get_post_meta($proforma->ID, 'lw_term_name', true); ?>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
    </div>

</div>
