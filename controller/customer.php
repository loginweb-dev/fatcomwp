<?php 
    require_once('../../../../wp-load.php');
    header('content-type: text/html; charset: utf-8');

    if ($_GET["customer_id"]) {
        $uid = array( $_GET["customer_id"] );
        $args = array(
            'include' => $uid,
        );
        $user_query = new WP_User_Query( $args );
        $users = (array) $user_query->results;
        $json = array();
        foreach ( $users as $user ) {
            $usermeta = get_user_meta($user->id);
            array_push($json, array(
                "id" => $user->id,
                "user_nicename" => $user->user_nicename,
                "user_email" => $user->user_email,
                "user_login" => $user->user_login,
                "first_name" => $usermeta['first_name'][0],
                "last_name" => $usermeta['last_name'][0]
            ));

        }
        // echo print_r($users);
        echo json_encode($json);

    
    }elseif ($_GET["customer_store"]){
        // $userdata = compact( 'user_email', 'user_pass' );
        $user_email = $_GET["user_email"];
        $user_login = $_GET["user_login"];
        $user_id = wc_create_new_customer( $user_email, $user_login, 'password');
        update_user_meta( $user_id, "billing_first_name", $_GET["first_name"] );
        update_user_meta( $user_id, "billing_last_name", $_GET["last_name"] );
        update_user_meta( $user_id, "billing_phone", $_GET["billing_phone"] );
        update_user_meta( $user_id, "billing_postcode", $_GET["billing_postcode"] );
        
        echo json_encode(array('message' => 'Cliente Create Correctamente..'.$user_login, 'customer_id' => $user_id));
    }elseif ($_GET["save"]){
        $user = get_users(array(
            'meta_key' => 'billing_phone',
            'meta_value' => str_replace(' ', '', $_GET["phone"]),
            'role__in' => "customer"
        ));
        if ($user) {
            // $user_id = $user[0]->ID;
            $user = get_user_by( 'id', $user[0]->ID );
            $usermeta = get_user_meta($user->id);
            $json = array(
                "id" => $user->id,
                "user_nicename" => $user->user_nicename,
                "user_email" => $user->user_email,
                "user_login" => $user->user_login,
                "first_name" => $user->first_name,
                "last_name" => $user->last_name,
                "billing_first_name" => $usermeta['billing_first_name'][0],
                "billing_last_name" => $usermeta['billing_last_name'][0],
                "billing_phone" => $usermeta['billing_phone'][0],
                "billing_postcode" => $usermeta['billing_postcode'][0],
                "message" => "El cliente ya exitia."
            );
            echo  json_encode($json);
        } else {
            $miname = str_replace('ñ', 'n', $_GET["first_name"]);
            $miname2 =  str_replace('ñ', 'n',$_GET["last_name"]);
            $miphone = $_GET["phone"];
            $user_email = str_replace(' ', '.', strtolower($miname)).'.'.str_replace(' ', '.',strtolower($miname2)).'@loginweb.dev';
            $user_id = wc_create_new_customer($user_email);
            if (is_wp_error($user_id)) {
                // throw new WC_CLI_Exception($user_id->get_error_code(), $user_id->get_error_message());
                $json = array(
                    "error" => $user_id->get_error_message(),
                );
                echo  json_encode($json);
            }else
                {
                update_user_meta( $user_id, "first_name", $miname );
                update_user_meta( $user_id, "last_name", $miname2 );
                update_user_meta( $user_id, "billing_first_name", $miname );
                update_user_meta( $user_id, "billing_last_name", $miname2 );
                update_user_meta( $user_id, "billing_phone", $miphone );

                $user = get_user_by( 'id', $user_id );
                $usermeta = get_user_meta($user->id);
                $json = array(
                    "id" => $user->id,
                    "user_nicename" => $user->user_nicename,
                    "user_email" => $user->user_email,
                    "user_login" => $user->user_login,
                    "first_name" => $user->first_name,
                    "last_name" => $user->last_name,
                    "billing_first_name" => $usermeta['billing_first_name'][0],
                    "billing_last_name" => $usermeta['billing_last_name'][0],
                    "billing_phone" => $usermeta['billing_phone'][0],
                    "billing_postcode" => $usermeta['billing_postcode'][0],
                    "message" => "Se registro nuevo Cliente."
                );
                echo  json_encode($json);
            }
        }
    }
?>