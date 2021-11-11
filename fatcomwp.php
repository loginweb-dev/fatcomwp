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
	$setting = array(
		'post_title'    => 'Post setting FATCOMWP',
		'post_status'   => 'publish',
		'post_type'   => 'pos_lw_setting',
		'meta_input' => array(
			'lw_image' => null,
			'lw_img_extencion' => 'PNG',
			'lw_ceo' => 'Ing. Percy Alvarez Cruz',
			'lw_direction' => 'Trinidad - Beni',
			'lw_movil' => '+591 71130523',
			'lw_city' => 'TRINIDAD',
			'lw_activity' => 'Ingenieria y Negocios',
			'lw_name_business' => 'LoginWeb @2021',
			'lw_nit' => '5619016018',
			'lw_legend' => 'EL ESTADO ES NUESTRO ENEMIGO',
			'lw_cat_default' => 'Menu',
			'lw_caja_default' => '272',
			'lw_extra_id' => null,
			'lw_tour' => 'true',
		)
	);
	if (!post_exists('pos_lw_setting')) {
		wp_insert_post( $setting );
	}
	
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


		add_submenu_page('terminal-punto-venta', //parent slug
			'Dosificaciones', //page title
			'Dosificaciones', //menu title
			'manage_options', //capability
			'dosifications', //menu slug
			'dosifications_list'
		); //function

}
// Cargando views php -----------------------------------------------------
define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'views/pos.php');
require_once(ROOTDIR . 'views/setting.php');
require_once(ROOTDIR . 'views/dosifications_list.php');

?>