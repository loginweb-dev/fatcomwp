<?php 
require_once('../../../../wp-load.php');
    $post = get_post( $_GET["box_id"] );
    $tv=0;
    // $orders = wc_get_orders(array('limit' => 100, 'meta_query' => array('wc_pos_register_id' => $_GET["cod_box"])));
    $orders = wc_get_orders(array('limit' => 100, 'orderby' => 'date'));
    foreach ($orders as $key) {
        if (get_post_meta( $key->ID, 'lw_accounting', true )  == 'no' && get_post_meta( $key->ID, 'wc_pos_register_id', true )  == $_GET["box_id"]) {
            $tv = $tv + get_post_meta( $key->ID, '_order_total', true );
        } 
    }   
    ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="form-group text-center">
                    <h5><u>Tipo de Venta</u></h5>
                </div>
                <div class="form-group">
                    <label><u>Titulo</u></label>
                    <input id="" type="text" class="form-control" placeholder="" value="<?php echo $post->post_title; ?>" readonly>
                </div>
                <div class="form-group">
                    <label><u>Nota de Apertura</u></label>
                    <textarea id="" class="form-control"><?php echo get_post_meta($post->ID, 'lw_nota_apertura', true);  ?></textarea>
                </div>
                <div class="form-group">
                    <label><u>Nota de Cierre</u></label>
                    <textarea id="nota_cierre" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label><u>Monto Final = <?php echo get_post_meta($post->ID, 'lw_monto_inicial', true); ?> + <?php echo $tv; ?></u> (MI+TV)</label>
                    <input id="lw_monto_final" type="text" class="form-control" placeholder="" value="<?php echo $tv + get_post_meta($post->ID, 'lw_monto_inicial', true); ?>">
                </div>
        
                <div class="form-group text-center">
                    <button href="#" onclick="box_close()" type="button" class="btn btn-primary btn-sm"> Cerrar </button>
                    <a href="#" class="btn btn-dark btn-sm" onclick='clear_search_products()'>  Cancelar </a>   
                </div>
            </div>
        </div>
    </div>