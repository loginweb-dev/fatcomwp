<?php 
    require_once('../../../../wp-load.php');
    $args=array(
        'title' => $_GET["cupon_code"] ,
        'post_type' => 'shop_coupon',
        'post_status' => 'publish'
        );
    $post = get_posts($args);
    echo json_encode(array("message" => "Producto Agredado Correctamente.", "cupon_id"=> $post[0]->ID));  