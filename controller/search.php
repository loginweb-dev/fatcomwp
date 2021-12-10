<?php 

    require_once('../../../../wp-load.php');
    global $woocommerce, $product, $post;
    if ($_GET["get_products"]) {
        $args = array(
            'orderby' => 'date',
            'order' => 'DESC',
            'status' => 'publish',
            'post_type'   => array('product', 'product_variation'),
            'tax_query' => array(
                array(
                   'taxonomy' => 'product_tag',
                   'field' => 'slug',
                   'terms' => $_GET["get_products"],
                   'operator' => 'IN',
                )
             ),
        );
        $json = array();
        //--------------------------------------type tags-----------
        $loop = wc_get_products($args);
        if (count($loop) == 0 ) {
            $args = array(
                'orderby' => 'date',
                'order' => 'DESC',
                'status' => 'publish',
                'post_type'   => array('product', 'product_variation'),
                's' => $_GET["get_products"],
            );
            $loop = wc_get_products($args);
        }

        foreach ($loop as $key) {
            $item = wc_get_product( $key->get_id() );
            if ($item->get_type() == "variable") {//-------------------------------
                foreach ($key->get_available_variations() as $variation) {
                    $provar = wc_get_product($variation['variation_id']);
                    array_push($json, array(
                        "id" => $variation['variation_id'],
                        "name" => $provar->name,
                        "description" => $provar->description ? $provar->description : $provar->short_description, //description
                        "regular_price" => $provar->regular_price,
                        "bought_price" => $provar->get_meta('_wc_cog_cost'),
                        "sku" => $provar->sku, 
                        "image" => get_the_post_thumbnail_url($item->id), 
                        "stock_quantity" => $provar->stock_quantity ? $provar->stock_quantity : 0,
                        "lg_estante" => $provar->get_meta('lg_estante'),
                        "lg_bloque" => $provar->get_meta('lg_bloque'),
                        "lg_date" => $provar->get_meta('_expiration-date'), //lg_date
                        "brands" => json_encode(get_the_terms($item->id, 'product_brand') ? get_the_terms($item->id, 'product_brand') : get_the_terms($item->id, 'yith_product_brand')), //product_brand
                        "cats" => json_encode(get_the_terms($item->id, 'product_cat')),
                        "tags" => json_encode(get_the_terms($item->id, 'product_tag')),
                    ));
                }
                // echo json_encode($json);
            } else {
                $ed = get_post_meta($item->id,'_expiration-date',true);
    		    // echo ($ed ? get_date_from_gmt(gmdate('Y-m-d H:i:s',$ed),get_option('date_format').' '.get_option('time_format')) : __("Never",'post-expirator'));
                array_push($json, array(
                    "id" => $item->id,
                    "name" => $item->name,
                    "description" => $item->description ? $item->description : $item->short_description, //description
                    "regular_price" => $item->regular_price,
                    "bought_price" => $item->get_meta('_wc_cog_cost'),
                    "sku" => $item->sku, 
                    "image" => get_the_post_thumbnail_url($item->id) ? get_the_post_thumbnail_url($item->id) : WP_PLUGIN_URL.'/iby2/resources/default_product.png', 
                    "stock_quantity" => $item->stock_quantity ? $item->stock_quantity : 0,
                    "lg_estante" => $item->get_meta('lg_estante'),
                    "lg_bloque" => $item->get_meta('lg_bloque'),
                    "lg_date" => get_date_from_gmt(gmdate('Y-m-d H:i:s',$ed),get_option('date_format').' '.get_option('time_format')), //lg_date
                    "brands" => json_encode(get_the_terms($item->id, 'yith_product_brand') ? get_the_terms($item->id, 'yith_product_brand') : get_the_terms($item->id, 'product_brand')), //product_brand
                    "cats" => json_encode(get_the_terms($item->id, 'product_cat')),
                    "tags" => json_encode(get_the_terms($item->id, 'product_tag')),
                ));
            }
        }
       echo json_encode($json);
    } else if($_GET["get_sku"]) {
       $product_id = wc_get_product_id_by_sku( $_GET["get_sku"] );
    //    $product = wc_get_product( $product_id );
        
       echo json_encode(array("product_id" => $product_id )); 
    } else if($_GET["get_customer_id"]) {

         $args = array(
            'role' => 'customer',
            'order' => 'ASC',
            'search' => $_GET["get_customer_id"]
        );
        $query = new WP_User_Query($args);
        $users = (array) $query->results;
        $json = array();
        foreach ( $users as $user ) {
            $usermeta = get_user_meta($user->id);
            array_push($json, array(
                "id" => $user->id,
                "user_nicename" => $user->user_nicename,
                "user_email" => $user->user_email,
                "user_login" => $user->user_login,
                "billing_first_name" => $usermeta['billing_first_name'][0],
                "billing_last_name" => $usermeta['billing_last_name'][0],
                "billing_phone" => $usermeta['billing_phone'][0],
                "billing_postcode" => $usermeta['billing_postcode'][0]
            ));
 
        }
        echo json_encode($json);
        // $get_user = get_user_by( 'id', $_GET['get_customer_id']);
        // echo json_encode(array('message' => 'Cliente Obtenido Correctamente..', 'id' => $get_user->id, 'billing_first_name' => get_user_meta($get_user->id ,'billing_first_name', true),  $get_user->id, 'billing_first_name' => get_user_meta($get_user->id ,'billing_first_name', true)));
    } else if($_GET["get_customers"]) {

    $search_string = $_GET["get_customers"];
    $json = array();
    $args = array(
        'search' => "*{$search_string}*",
        // 'role__in' => "cliente"
    );
    $users = get_users( $args );
       foreach ( $users as $user ) {
           $usermeta = get_user_meta($user->id);
           array_push($json, array(
               "id" => $user->id,
               "user_nicename" => $user->user_nicename,
               "user_email" => $user->user_email,
               "user_login" => $user->user_login,
               "billing_first_name" => $usermeta['billing_first_name'][0],
               "billing_last_name" => $usermeta['billing_last_name'][0],
               "billing_phone" => $usermeta['billing_phone'][0],
               "billing_postcode" => $usermeta['billing_postcode'][0]
           ));
       }
       echo json_encode($json);
    }else if($_GET["user_id"]) {

        $id = $_GET["user_id"];
        $user = get_user_by( 'id', $id );
        $usermeta = get_user_meta($user->id);
        $json = array(
            "id" => $user->id,
            "user_nicename" => $user->user_nicename,
            "user_email" => $user->user_email,
            "user_login" => $user->user_login,
            "billing_first_name" => $usermeta['billing_first_name'][0],
            "billing_last_name" => $usermeta['billing_last_name'][0],
            "billing_phone" => $usermeta['billing_phone'][0],
            "billing_postcode" => $usermeta['billing_postcode'][0]
        );
        echo json_encode($json);
    }else if($_GET["product_id"]) {
    
        $id = $_GET["product_id"];
        $product = wc_get_product( $id );
        $json = array(
            "id" => $product->id,
            "price" => $product->regular_price,
            "name" => $product->name,
            "description" => $product->short_description,
            "category" => json_encode(get_the_terms($id, 'product_cat')),
            "link" => get_permalink($id),
            "image" => get_the_post_thumbnail_url($product->id), 
        );
        echo json_encode($json);
    }else if($_GET["term_id"]) {
    
        $id = $_GET["term_id"];
        $term = get_term( $id, 'wcdp_payment_plan' );
        $json = array(
            "id" => $term->term_id,
            "title" => $term->name,
            "deposit_percentage" => get_term_meta($id, 'deposit_percentage', true),
            "payment_details" => get_term_meta($id, 'payment_details', true)
        );
        echo json_encode($json);
    }else if($_GET["telefono"]) {
    
        $user = get_users(array(
            'meta_key' => 'billing_phone',
            'meta_value' => $_GET["telefono"],
            'role__in' => "customer"
        ));
        $usermeta = get_user_meta($user[0]->ID);
        $json = array(
            "id" => $user[0]->ID,
            "nombre" => $usermeta['first_name'][0],
            "apellido" => $usermeta['last_name'][0]
        );

        echo json_encode($json);
    }else if($_GET["users_customer"]) {
    
        $users = get_users('orderby=user_registered&order=DESC&role=customer');
        $json = array();
        foreach ( $users as $user ) {
            $usermeta = get_user_meta($user->id);
            array_push($json, array(
                "id" => $user->id,
                "user_nicename" => $user->user_nicename,
                "user_email" => $user->user_email,
                "user_login" => $user->user_login,
                "billing_first_name" => $usermeta['billing_first_name'][0],
                "billing_last_name" => $usermeta['billing_last_name'][0],
                "billing_phone" => $usermeta['billing_phone'][0],
                "billing_postcode" => $usermeta['billing_postcode'][0],
                "message" => "Mostranto todos lo clientes."
            ));
        }

        echo json_encode($json);
    }else if($_GET["get_attachment"]) {
    
        $post = get_post($_GET["id"]);
        $json = array(
            "id" => $post->ID,
            "title" => $post->post_title,
            "type" => $post->post_type,
            "mime" => $post->post_mime_type,
            "location" => get_post_meta($post->ID, '_wp_attached_file', true),

        );
        echo json_encode($json);
    }
    
    
?>