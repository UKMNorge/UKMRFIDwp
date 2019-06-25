<?php

namespace UKMNorge\RFID;
use Exception;
use stdClass;
	
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once( 'UKM/postgres.class.php');
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.collection.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// Liste over alle scannere til velge-funksjon
$scanners = ScannerColl::getAllByName();
\UKMRFID::addViewData( 'scanners', $scanners );

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	// Oppdater scannerliste.
}

try {
	$session_id = $_COOKIE["session"];
	$selectedScanners = MonitorAccessColl::getForSessionId($session_id);
	\UKMRFID::addViewData( 'selectedScanners', $selectedScanners);	
} catch( Exception $e ) {

}