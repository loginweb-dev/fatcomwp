<?php 
    require_once('../../../../wp-load.php');

    if (isset($_GET['save'])) {
        $my_box = array(
            'post_title'    => $_GET['title'],
            'post_status'   => 'publish',
            'post_type'   => 'lw_proformas',
            'meta_input' => array(
                'lw_customer' => $_GET['customer'],
                'lw_customer_name' => $_GET['customer_name'],
                'lw_product' => $_GET['product'],
                'lw_product_name' => $_GET['product_name'],
                'lw_term' => $_GET['term'],
                'lw_term_name' => $_GET['term_name'],
            )
        );
        
      $pro =  wp_insert_post( $my_box );
      echo $pro;
    }

?>