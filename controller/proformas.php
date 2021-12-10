<?php

    require_once('../../../../wp-load.php');
    if (isset($_GET['midata'])) {
        $data = json_decode(stripslashes($_GET['midata']));
        $user = get_users(array(
            'meta_key' => 'billing_phone',
            'meta_value' => str_replace(' ', '', $data->telefono),
            'role__in' => "customer"
        ));
        if ($user) {
            $user_id = $user[0]->ID;
            
            $num=1;
            $ts = get_posts(array('post_type'  => 'lw_proforma', 'orderby' => 'date', 'numberposts' => -1)); 
            foreach ($ts as $key) {
                $num = $num  + 1;
            }
            $my_box = array(
                'post_status'   => 'publish',
                'post_type'   => 'lw_proforma',
                'meta_input' => array( 
                    'lw_num_prof' => $num,
                    'lw_product' => $data->product,
                    'lw_customer' => $user_id,
                    'lw_garante' => $data->garante,
                    'lw_fci' => $data->fci,
                    'lw_ubs' => $data->ubs,
                    'lw_cfl' => $data->cfl,
                    'lw_cdt' => $data->cdt,
                    'lw_afp' => $data->afp,
                    'lw_fci2' => $data->fci2,
                    'lw_nit' => $data->nit,
                    'lw_cfd' => $data->cfd,
                    'lw_soat' => $data->soat,
                    'lw_garantia' => $data->garantia,
                    'lw_mantenimiento' => $data->mantenimiento,
                    'lw_inicial' => $data->inicial,
                    'lw_mensual' => $data->mensual,
                    'lw_plazo' => $data->plazo,
                )
            );
            $pro =  wp_insert_post( $my_box );
            echo json_encode(array("message" => "Cliente existente"));
        } else {
            $miname = str_replace('ñ', 'n', $data->nombre);
            $miname2 =  str_replace('ñ', 'n', $data->apellido);
            $miphone = $data->telefono;
            $user_email = str_replace(' ', '.', strtolower($miname)).'.'.str_replace(' ', '.',strtolower($miname2)).'@loginweb.dev';
            $user_id = wc_create_new_customer($user_email);
            if ( ! is_wp_error( $user_id ) ) {
                update_user_meta( $user_id, "first_name", $data->nombre );
                update_user_meta( $user_id, "last_name", $data->apellido );
                update_user_meta( $user_id, "billing_first_name", $data->nombre );
                update_user_meta( $user_id, "billing_last_name", $data->apellido);
                update_user_meta( $user_id, "billing_phone", $miphone );
                $num=1;
                $ts = get_posts(array('post_type'  => 'lw_proforma', 'orderby' => 'date', 'numberposts' => -1)); 
                foreach ($ts as $key) {
                    $num = $num  + 1;
                }
                $my_box = array(
                    'post_status'   => 'publish',
                    'post_type'   => 'lw_proforma',
                    'meta_input' => array( 
                        'lw_num_prof' => $num,
                        'lw_product' => $data->product,
                        'lw_customer' => $user_id,
                        'lw_garante' => $data->garante,
                        'lw_fci' => $data->fci,
                        'lw_ubs' => $data->ubs,
                        'lw_cfl' => $data->cfl,
                        'lw_cdt' => $data->cdt,
                        'lw_afp' => $data->afp,
                        'lw_fci2' => $data->fci2,
                        'lw_nit' => $data->nit,
                        'lw_cfd' => $data->cfd,
                        'lw_soat' => $data->soat,
                        'lw_garantia' => $data->garantia,
                        'lw_mantenimiento' => $data->mantenimiento,
                        'lw_inicial' => $data->inicial,
                        'lw_mensual' => $data->mensual,
                        'lw_plazo' => $data->plazo,
                    )
                );
                $pro =  wp_insert_post( $my_box );
                echo json_encode(array("message" => "Nuevo Cliente"));
            } else {
                $error_string = $user_id->get_error_message();
                echo json_encode(array("error" => $error_string));
            }

        }
    }
?>