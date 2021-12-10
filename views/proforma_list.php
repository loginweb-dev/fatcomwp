
<?php 
    require_once('../../../../wp-load.php');
    $proformas = get_posts(array('post_type'  => 'lw_proforma', 'orderby' => 'date', 'numberposts' => -1)); 
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
            <thead class="">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Producto</th>
                <th scope="col">Cliente</th>
                <th scope="col">Plan</th>
                <th scope="col">Dependientes</th>
                <th scope="col">Independientes</th>
                <th scope="col">Incluye</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($proformas as $proforma) { ?>
                <tr>
                  <td>
                      <?php echo '# '.get_post_meta($proforma->ID, 'lw_num_prof', true); ?>
                      <br />
                      <?php echo $proforma->post_date; ?>
                      <br />
                      <?php $user = get_user_by( 'id', $proforma->post_author ); echo $user->first_name.' '.$user->last_name; ?>
                  </td>
                  <td>
                    <?php $product=get_post_meta($proforma->ID, 'lw_product', true); echo '# '.$product; ?>
                    <br />
                    <?php $product = wc_get_product( $product ); echo $product->name; ?>
                    <br />
                    <?php echo 'Bs. '.$product->regular_price; ?>
                  </td>
                  <td>
                    <?php $userid = get_post_meta($proforma->ID, 'lw_customer', true); echo '# '.$userid; ?>
                    <br />
                    <?php $user = get_user_by( 'id', $userid ); $usermeta = get_user_meta($user->id); echo $user->first_name.' '.$user->last_name; ?>
                    <br />
                    <?php echo $usermeta['billing_phone'][0]; ?>
                  </td>
                  <td>
                    <strong>Inicial: </strong> <?php echo get_post_meta($proforma->ID, 'lw_inicial', true); ?>
                    <br />
                    <strong>Mensual: </strong> <?php echo get_post_meta($proforma->ID, 'lw_mensual', true); ?>
                    <br />
                    <strong>Plazo: </strong> <?php echo get_post_meta($proforma->ID, 'lw_plazo', true); ?>
                    <br />
                    <strong>Garantes: </strong> <?php echo get_post_meta($proforma->ID, 'lw_garante', true); ?>
                  </td>
                  <td>
                    <input class="form-check-input" type="checkbox" <?php if(get_post_meta($proforma->ID, 'lw_fci', true) == true ){ echo 'checked';} ?>>--- Fotocopia CI a Color
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_ubs', true) == true ){ echo 'checked';} ?>>--- Boleta o Planilla
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_cfl', true) == true ){ echo 'checked';} ?>>--- Factura de Luz
                    <br />
                    <input class="form-check-input" type="checkbox" <?php if(get_post_meta($proforma->ID, 'lw_cdt', true) == true ){ echo 'checked';} ?>>--- Croquis
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_afp', true) == true ){ echo 'checked';} ?>>--- AFP
                  </td>
                  <td>
                    <input class="form-check-input" type="checkbox" <?php if(get_post_meta($proforma->ID, 'lw_fci2', true) == true ){ echo 'checked';} ?>>--- Fotocopia CI a Color
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_nit', true) == true ){ echo 'checked';} ?>>--- NIT o Licencia
                    <br />
                    <input class="form-check-input" type="checkbox" <?php if(get_post_meta($proforma->ID, 'lw_cfd', true) == true ){ echo 'checked';} ?>>--- Factura de Luz
                  </td>
                  <td>
                    <input class="form-check-input" type="checkbox" <?php if(get_post_meta($proforma->ID, 'lw_soat', true) == true ){ echo 'checked';} ?>>--- SOAT
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_garantia', true) == true ){ echo 'checked';} ?>>--- Gtia 1 Año
                    <br />
                    <input class="form-check-input" type="checkbox"<?php if(get_post_meta($proforma->ID, 'lw_mantenimiento', true) == true ){ echo 'checked';} ?>>--- Mto 1500 KM
                  </td>
                  <td>
                    <button onclick="imprimir('<?php echo $proforma->ID; ?>')" class="btn btn-sm btn-dark">Imprimir</button>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
    </div>

</div>

<script>
  function imprimir(cod_proforma) {
    window.open('<?php echo WP_PLUGIN_URL; ?>'+'/fatcomwp/views/proforma_pdf.php?cod_proforma='+cod_proforma, '_blank', 'location=yes,height=600,width=400,scrollbars=yes,status=yes');
    
  }
</script>
