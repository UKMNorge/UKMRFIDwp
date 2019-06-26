<?php

namespace UKMNorge\RFID;
use Exception;
use stdClass;
	
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once( 'UKM/postgres.class.php');
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.class.php');
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.collection.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// Liste over alle scannere til velge-funksjon
$scanners = ScannerColl::getAllByName();
\UKMRFID::addViewData( 'scanners', $scanners );
$session_id = $_COOKIE["session"];
// Remove s:
$session_id = substr($session_id, 2, count($session_id));

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	// Oppdater scannerliste.
	$scanner_id = $_POST['scannerId'];
	$newMonitor = MonitorAccess::create($session_id, $scanner_id);
}

try {
	$selectedScanners = array();
	$monitorAccesses = MonitorAccessColl::getForSessionId($session_id);
	foreach($monitorAccesses as $monitor) {
		$selectedScanners[] = ScannerColl::getById($monitor->getScannerId());
	}

	\UKMRFID::addViewData( 'selectedScanners', $selectedScanners);	
} catch( Exception $e ) {

}