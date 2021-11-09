<?php
/**
* Plugin Name: FATCOM-WP
* Plugin URI: https://loginweb.dev/fatcomwp/
* Description: Terminal Punto de Venta - Plugins Diseñado y Desarrollado por Loginweb, para Gestionar la Facturacion Computarizada, Flujo de Caja, Compras.
* Version: 3.0
* Author: Ing. Percy Alvarez Cruz
* Author URI: https://loginweb.dev/profile
**/


// insert post setting ------------------------------------------------------
function lw_create_setting() {
	$setting = array(
		'post_title'    => 'Post setting TPV',
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
			'lw_extra_id' => null,
		)
	);
	wp_insert_post( $setting );
}
register_activation_hook(__FILE__, 'lw_create_setting');

// menu TPV items --------------------------------------------------------------------
add_action('admin_menu','lw_add_menu_2');
function lw_add_menu_2() {
	
	//MENU TPV
	add_menu_page('Punto de Venta 2', //page title
        'Punto de Venta 2', //menu title
        'manage_options', //capabilitiesw
        'terminal-punto-venta-2', //menu slug
        'lw_pos', //function
        'dashicons-align-full-width'
	);

        add_submenu_page('terminal-punto-venta-2', //parent slug
			'Configuracion', //page title
			'Configuracion', //menu title
			'manage_options', //capability
			'setting', //menu slug
			'lw_setting'); //function


		add_submenu_page('terminal-punto-venta-2', //parent slug
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