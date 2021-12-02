<?php 
    require_once('../../../../wp-load.php');
    $current_user = wp_get_current_user();
    if ($_GET["change"]) {
        $box = get_post( $_GET["change"]);
        $outlet = get_post(get_post_meta($box->ID, 'outlet', true));
        echo json_encode(array('idb' => $box->ID, 'titleb' => $box->post_title, 'ido' => $outlet->ID, 'titleo' => $outlet->post_title));
    
       
    } if(isset($_GET["nota_cierre"])){
        $my_post = array(
            'post_title'    => wp_strip_all_tags( 'POS Register #'.$_GET["box_id"] ),
            'post_type'  => 'pos_temp_order',
            'post_status'   => 'publish',
            'post_parent'   => $_GET["box_id"],
            'post_author'   => $current_user->id,
            'meta_input' => array(
                'lw_nota_cierre' => $_GET["nota_cierre"],
                'lw_monto_inicial' => $post->lw_monto_inicial,
                'lw_monto_ventas' => $_GET["lw_monto_final"],
            )
        );
        wp_insert_post( $my_post );
        // $post->post_status = "pending";
        // wp_update_post( $post );
        // update_post_meta($_GET["box_id"], 'lw_nota_apertura', null);
        // update_post_meta($_GET["box_id"], 'lw_monto_inicial', null);
        // update_post_meta($_GET["box_id"], 'lw_nota_cierre', $_GET["nota_cierre"]);
        // update_post_meta($_GET["box_id"], 'lw_monto_final', $_GET["lw_monto_final"]);

        $orders = wc_get_orders(array('limit' => 100, 'orderby' => 'date'));
        if (get_post_meta( $key->ID, 'lw_accounting', true )  == 'no' && get_post_meta( $key->ID, 'wc_pos_register_id', true )  == $_GET["box_id"]  ) {       
        foreach ($orders as $key) {
           update_post_meta( $key->ID, 'lw_accounting', 'yes' );
        }   
            // update_post_meta($_GET["box_id"], 'lw_nota_cierre', $_GET["nota_cierre"]);
        }
    }
    
?>