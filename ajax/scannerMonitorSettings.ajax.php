<?php

namespace UKMNorge\RFID;
use Exception;

// Sett session_id cookie if not set
// TODO: Finn navnet på denne - må be Marius om tilgang til repo.
if(!isset($_COOKIE["kiosksession"])) {
	$session_id = uniqid();
	setcookie("kiosksession", $session_id, 0, "/", ".ukm.no");
} else {
	$session_id = $_COOKIE["kiosksession"];
}

require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// TODO: Move upwards
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.collection.php');

// Check table for list of scanners
$scannerList = MonitorAccessColl::getForSessionId($session_id);
$postedScannerList = $_POST["scannerList"];

// Process posted settings:
// Are there any scanners in the list from the frontend, and the numbers don't match up?
if (
	$postedScannerList != null && 
	( count($postedScannerList) != count($scannerList)	) ) 
{
	// If yes, update scanner-list in monitor_access for this session_id
	createList($postedScannerList);
	var_dump($postedScannerList);
	self::addResponseData('success', false);
} elseif ($postedScannerList != null) {
	// Also, if there is posted a scanner list and it has different ID's, update list in table
	updateList($postedScannerList, $scannerList);
	self::addResponseData('success', false);

} else {
	// If there are no posted lists, just add the ones from the table
	self::addResponseData('scannerList', $scannerList);
	// Reply JSON OK to enable SSE on client-side.
	self::addResponseData('success', true);
}


// Add list of devices currently in table
function updateList($posted, $current) {
	var_dump($posted);
	$newScanners = array();
	foreach($posted as $postedScannerID) {
		$exists = false;
		foreach($current as $tableScanner) {
			if ( $tableScanner->ID == $postedScannerID) {
				$exists = true;
			}
		}
		if( !$exists ) {
			// Add to table
			array_push($newScanners, $postedScannerId);
		}
	}

	// If a scanner exists in current but not in posted, it should be removed from the table.

	// Actually add any if $newScanners aren't empty.
	throw new Exception("Can't update list yet!");
}

function createList($newList) {
	// Remove all old scanners that have the same session_id first!!!

}