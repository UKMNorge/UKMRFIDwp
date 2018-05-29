<?php  

class UKMRFID extends UKMmodul {
	public static $monstring = null;
	public static $til = null;
	
	/**
	 * Initier Videresending-objektet
	 *
	**/
	public static function init() {
		self::$view_data = [];
		parent::init();
	}
	
	/**
	 * Generer admin-GUI
	 *
	 * @return void, echo GUI.
	**/
	public static function admin() {
		## SETUP LOGGER
		global $current_user;
		get_currentuserinfo();
		require_once('UKM/logger.class.php'); 
		UKMlogger::setID( 'wordpress', $current_user->ID, get_option('pl_id') );

		## ACTION CONTROLLER
		require_once('controller/'. self::getAction() .'.controller.php');
		
		## RENDER
		echo TWIG( ucfirst(self::getAction()) .'/forside.html.twig', self::getViewData() , dirname(__FILE__), true);
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
		UKM_add_menu_page(
			'monstring', 
			'Videresending', 
			'Videresending',
			'editor', 
			'UKMVideresending',
			['UKMVideresending','admin'],
			'//ico.ukm.no/paper-airplane-20.png',
			20
		);
		UKM_add_scripts_and_styles(
			'UKMVideresending_admin',	# Page-hook
			['UKMVideresending', 'script']	# Script-funksjon
		);

		if( self::getType() == 'fylke') {
			// Legg videresendingsskjemaet som en submenu under Mønstring.
			UKM_add_submenu_page(
				'UKMMonstring', 
				'Videresendingsskjema', 
				'Skjema for videresending', 
				'editor', 
				'UKMVideresendingsskjema', 
				['UKMVideresending','skjema']
			);
			UKM_add_scripts_and_styles(
				'UKMVideresending_skjema',
				['UKMVideresending', 'skjema_script']
			);
			// Legg nominasjon som en submenu under Mønstring.
			UKM_add_submenu_page(
				'UKMVideresending',
				'Nominasjon',
				'Nominasjoner',
				'ukm_nominasjon',
				'UKMnominasjon',
				['UKMVideresending', 'nominasjon']
			);
			UKM_add_scripts_and_styles(
				'UKMVideresending_nominasjon',
				['UKMVideresending', 'nominasjon_script']
			);
		}
	}
	

}
