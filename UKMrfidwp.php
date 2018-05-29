<?php  
/* 
Plugin Name: UKM RFID WP-ADMIN
Plugin URI: http://www.ukm-norge.no
Description: Admin for RFID scanners
Author: UKM Norge / M Mandal og A Hustad
Version: 0.1 
Author URI: http://ukm-norge.no
*/

if( !class_exists('UKMModul') ) {
	require_once('class/UKMModul.class.php');
}

if(is_admin()) {
	add_action('network_admin_menu', ['RFID','meny']);
}



class RFID extends UKMmodul {
	public static $monstring = null;
	public static $til = null;
	
	/**
	 * Initier Videresending-objektet
	 *
	**/
	public static function init() {
		self::setAction('home');
		parent::init(null);
	}
	
	/**
	 * Generer admin-GUI
	 *
	 * @return void, echo GUI.
	**/
	public static function admin() {
		self::init();
		## ACTION CONTROLLER
		require_once('controller/'. self::getAction() .'.controller.php');
		
		## RENDER
		echo TWIG( strtolower(self::getAction()) .'.html.twig', self::getViewData() , dirname(__FILE__), true);
		echo TWIGjs( dirname(__FILE__) );
		return;
	}
	
	public static function script() {
		wp_enqueue_script('WPbootstrap3_js');
		wp_enqueue_style('WPbootstrap3_css');
		wp_enqueue_script('TwigJS');
	}

	/**
	 * Registrer menyer
	 *
	**/
	public static function meny() {
		$page = add_menu_page(
			'RFID', 
			'RFID',
			'administrator', 
			'RFID',
			['RFID','admin'],
			'/wp-content/plugins/UKMRFIDwp/img/id-menu.png',
			20
		);
		UKM_add_scripts_and_styles(
			'UKMVideresending_admin',	# Page-hook
			['UKMVideresending', 'script']	# Script-funksjon
		);
	}
	

}