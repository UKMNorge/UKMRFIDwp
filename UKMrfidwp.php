<?php  
/* 
Plugin Name: UKM RFID WP-ADMIN
Plugin URI: http://www.ukm-norge.no
Description: Admin for RFID scanners
Author: UKM Norge / M Mandal og A Hustad
Version: 0.1 
Author URI: http://ukm-norge.no
*/

require_once('class/UKMModul.class.php');
require_once('class/UKMRFID.class.php');

if(is_admin()) {
	add_action('network_admin_menu', ['UKMRFID','meny']);
}
