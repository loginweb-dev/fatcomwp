<?php 
    require_once('../../../../wp-load.php');

    if ($_GET["change"]) {
        $box = get_post( $_GET["change"]);
        $outlet = get_post(get_post_meta($box->ID, 'outlet', true));
        echo json_encode(array('idb' => $box->ID, 'titleb' => $box->post_title, 'ido' => $outlet->ID, 'titleo' => $outlet->post_title));
    
       
    } else {
        # code...
    }
    
?>