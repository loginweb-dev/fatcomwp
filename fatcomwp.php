<?php
/**
* Plugin Name: FATCOMWP
* Plugin URI: https://loginweb.dev/fatcomwp/
* Description: Terminal Punto de Venta - Plugins Diseñado y Desarrollado por Loginweb, para Gestionar la Facturacion Computarizada, Flujo de Caja, Compras.
* Version: 3.0
* Author: Ing. Percy Alvarez Cruz
* Author URI: https://loginweb.dev/profile
**/


// insert post setting ------------------------------------------------------

function lw_create_setting() {
	$setting = get_posts(array('post_type' => 'pos_lw_setting'));
	for($i=0; $i < count($setting); $i++) { 
		wp_delete_post($setting[$i]->ID, true);
	}
	$setting = array(
		'post_title'    => 'Post setting FATCOMWP',
		'post_status'   => 'publish',
		'post_type'   => 'pos_lw_setting',
		'meta_input' => array(
			'lw_image' => 'myimage.png',
			'lw_img_extencion' => 'PNG',
			'lw_ceo' => 'Ing. Percy Alvarez C.',
			'lw_direction' => 'Trinidad - Beni',
			'lw_movil' => '+591 71130523',
			'lw_city' => 'TRINIDAD',
			'lw_activity' => 'Ingenieria y Negocios',
			'lw_name_business' => 'LoginWeb @2021',
			'lw_nit' => '5619016018',
			'lw_legend' => 'El Estado es Nuestro Enemigo',
			'lw_cat_default' => 'Menu',
			'lw_caja_default' => '100',
			'lw_extra_id' => '101',
			'lw_tour' => 'true',
			'lw_or' => 'false',
		)
	);
	// if (!post_exists('pos_lw_setting')) {
		wp_insert_post( $setting );
	// }	
}
register_activation_hook(__FILE__, 'lw_create_setting');


// link para setting --------------------------------------------
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'lw_settings_link' );
function lw_settings_link( $links ) {
	$url = admin_url('admin.php?page=setting');
	$settings_link = "<a href='$url'>" . __( 'Settings' ) . '</a>';
	array_push(
		$links,
		$settings_link
	);
	return $links;
}

// menu TPV items --------------------------------------------------------------------
add_action('admin_menu','fw_add_menu');
function fw_add_menu() {
	
	//MENU TPV
	add_menu_page('Punto de Venta', //page title
        'Punto de Venta', //menu title
        'manage_options', //capabilitiesw
        'terminal-punto-venta', //menu slug
        'lw_pos', //function
        'dashicons-align-full-width'
	);

        add_submenu_page('terminal-punto-venta', //parent slug
			'Configuracion', //page title
			'Configuracion', //menu title
			'manage_options', //capability
			'setting', //menu slug
			'lw_setting'); //function


		// add_submenu_page('terminal-punto-venta', //parent slug
		// 	'Dosificaciones', //page title
		// 	'Dosificaciones', //menu title
		// 	'manage_options', //capability
		// 	'dosifications', //menu slug
		// 	'dosifications_list'
		// ); //function

		add_submenu_page(null, //parent slug
			'Delivery Whatsapp', //page title
			'Delivery Whatsapp', //menu title
			'manage_options', //capability
			'delivery-whatsapp', //menu slug
			'delivery_whatsapp'); //function
}

//-------------------------OPTIONS RESTAURANT tipo de venta--------------------
add_filter( 'manage_edit-shop_order_columns', 'custom_shop_order_column', 10 );
function custom_shop_order_column($columns)
{
    $reordered_columns = array();
    foreach( $columns as $key => $column){
        $reordered_columns[$key] = $column;
        if( $key ==  'order_status' ){
            $reordered_columns['my-column1'] = __( 'Tipo','theme_domain');
			$reordered_columns['my-column2'] = __( 'Tickes','theme_domain');
			$reordered_columns['my-column3'] = __( 'Pago por:','theme_domain');
			$reordered_columns['my-column4'] = __( 'Conta:','theme_domain');
        }
    }
    return $reordered_columns;
}

add_action( 'manage_shop_order_posts_custom_column' , 'custom_orders_list_column_content', 10, 2 );
function custom_orders_list_column_content( $column, $post_id )
{
    switch ( $column )
    {
        case 'my-column1' :
            $my_var_one = get_post_meta( $post_id, 'lw_or', true );
            if(!empty($my_var_one))
                echo $my_var_one;
            else
                echo '<small>(<em>no value</em>)</small>';
            break;
			case 'my-column2' :
				$my_var_one1 = get_post_meta( $post_id, 'lw_pos_tickes', true );
				if(!empty($my_var_one1))
					echo $my_var_one1;
				else
					echo '<small>(<em>no value</em>)</small>';
				break;
			case 'my-column3' :
				$my_var_one2 = get_post_meta( $post_id, '_payment_method_title', true );
				if(!empty($my_var_one2))
					echo $my_var_one2;
				else
					echo '<small>(<em>no value</em>)</small>';
				break;
			case 'my-column4' :
				$my_var_one1 = get_post_meta( $post_id, 'lw_accounting', true );
				if(!empty($my_var_one1))
					echo $my_var_one1;
				else
					echo '<small>(<em>no value</em>)</small>';
				break;
    }
}





// -------------  Imppimir Recibo -----------------------------------------------------------
add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
function add_custom_order_status_actions_button( $actions, $order ) {
		$action_slug = 'custom2';
        $actions[$action_slug] = array(
            'url'       => WP_PLUGIN_URL.'/fatcomwp/views/print_recibo.php?cod_order='.$order->get_id(),
            'name'      => __( 'Imprimir TPV', 'woocommerce' ),
            'action'    => $action_slug,
		);
		return $actions;

}
add_action( 'admin_head', 'add_custom_order_actions_button_css2' );
function add_custom_order_actions_button_css2() {
    $action_slug = "custom2";
    echo '<style>.wc-action-button-'.$action_slug.'::after { font-family: woocommerce !important; content: "\e01d" !important; }</style>';
}



add_filter( 'woocommerce_admin_order_actions', 'add_whatsapp', 100, 2 );
function add_whatsapp( $actions, $order ) {
		$action_slug = 'custom';
        $actions[$action_slug] = array(
            'url'       => admin_url('admin.php?page=delivery-whatsapp.php&cod_order='.$order->get_id()),
            'name'      => __( 'Enviar Whatsapp', 'woocommerce' ),
            'action'    => $action_slug,
        );
    return $actions;
}
add_action( 'admin_head', 'add_custom_order_actions_button_css' );
function add_custom_order_actions_button_css() {
    // The key slug defined for your action button
    $action_slug = "custom";
    echo '<style>.wc-action-button-'.$action_slug.'::after { font-family: woocommerce !important; content: "\e019" !important; }</style>';
}





// Cargando views php -----------------------------------------------------
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'views/pos.php');
require_once(ROOTDIR . 'views/setting.php');
require_once(ROOTDIR . 'views/delivery_whatsapp.php');
require_once(ROOTDIR . 'views/dosifications_list.php');

?>