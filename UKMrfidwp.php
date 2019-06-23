<?php  
/* 
Plugin Name: UKM RFID WP-ADMIN
Plugin URI: http://www.ukm-norge.no
Description: Admin for RFID scanners
Author: UKM Norge / M Mandal og A Hustad
Version: 0.1 
Author URI: http://ukm-norge.no
*/

use UKMNorge\RFID\POSTGRES;

if( !class_exists('UKMModul') ) {
	require_once('class/UKMModul.class.php');
}

if(is_admin()) {
	add_action('network_admin_menu', ['UKMRFID','meny']);
	add_action('admin_menu', ['UKMRFID','meny']);

	add_action('wp_ajax_RFID_ajax', ['UKMRFID', 'ajax']);
}

define('UKMRFID', dirname(__FILE__));
define('UKMRFID_INCLUDE_PATH', 'UKM/RFID/');


class UKMRFID extends UKMmodul {
	public static $monstring = null;
	public static $til = null;
	
	/**
	 * Initier Videresending-objektet
	 *
	**/
	public static function init($pl_id = null) {
		self::setAction('home');
		parent::init(null);
		require_once( 'UKM/postgres.class.php');
		POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );
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
	public static function adminDirectAreas() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'areas';
		}
		self::admin();
	}
	public static function adminDirectScanners() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'scanners';
		}
		self::admin();
	}	
	public static function adminDirectHerds() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'herds';
		}
		self::admin();
	}
	public static function adminDirectPersons() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'persons';
		}
		self::admin();
	}
	public static function adminDirectReports() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'reports';
		}
		self::admin();
	}
	public static function adminDirectRegistration() {
		if( !isset( $_GET['action'] ) ) {
			$_GET['action'] = 'backup_registration';
		}
		self::admin();
	}

	public static function scripts_and_styles() {
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
			['UKMRFID','admin'],
			'/wp-content/plugins/UKMRFIDwp/img/id-menu.png',
			20
		);
		add_action( 'admin_print_styles-' . $page, ['UKMRFID', 'scripts_and_styles'] );

		
		$subpage = add_submenu_page(
			'RFID',
			'Område',
			'Område',
			'administrator',
			'RFIDareas',
			['UKMRFID', 'adminDirectAreas']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );


		$subpage = add_submenu_page(
			'RFID',
			'Scannere',
			'Scannere',
			'administrator',
			'RFIDscanners',
			['UKMRFID', 'adminDirectScanners']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );

		$subpage = add_submenu_page(
			'RFID',
			'Grupper',
			'Grupper',
			'administrator',
			'RFIDherds',
			['UKMRFID', 'adminDirectHerds']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );

		$subpage = add_submenu_page(
			'RFID',
			'Personer',
			'Personer',
			'administrator',
			'RFIDpersons',
			['UKMRFID', 'adminDirectPersons']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );

		$subpage = add_submenu_page(
			'RFID',
			'Rapporter',
			'Rapporter',
			'ukmrfid_reports',
			'RFIDreports',
			['UKMRFID', 'adminDirectReports']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );

		$subpage = add_submenu_page(
			'RFID',
			'Etterregistrering',
			'Etterregistrering',
			'ukmrfid_reports',
			'RFIDbackup_registration',
			['UKMRFID', 'adminDirectRegistration']
		);
		add_action( 'admin_print_styles-' . $subpage, ['UKMRFID', 'scripts_and_styles'] );
	}
	
	public static function ajax() {
		if( is_array( $_POST ) ) {
			self::addResponseData('POST', $_POST );
		}
		
		try {
			$supported_actions = [
				'registerPerson',
				'scan',
				'search',
				'scannerMonitorSettings'
			];
			
			if( in_array( $_POST['subaction'], $supported_actions ) ) {
				require_once('ajax/'. $_POST['subaction'] .'.ajax.php');
			} else {
				throw new Exception('Beklager, støtter ikke denne handlingen!');
			}
		} catch( Exception $e ) {
			self::addResponseData('success', false);
			self::addResponseData('message', $e->getMessage() );
			self::addResponseData('code', $e->getCode() );
		}
		
		$data = json_encode( self::getResponseData() );
		echo $data;
		die();
	}
}