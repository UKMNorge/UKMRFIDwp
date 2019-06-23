<?php

namespace UKMNorge\RFID;
use Exception;

// Sett session_id cookie if not set
// TODO: Finn navnet på denne - må be Marius om tilgang til repo.
if(!isset($_COOKIE["session_id"])) {
	$session_id = uniqid();
	setcookie("session_id", $session_id, 0, "/", ".ukm.no");
} else {
	$session_id = $_COOKIE["session_id"];
}

require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// TODO: Move upwards
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.collection.php');

// Will only dump on next load.
var_dump("Session_ID: ".$session_id);

// Check table for list of scanners


// Process posted settings:

// Are there any scanners in the list from the frontend?
var_dump(MonitorAccessColl::getForSessionId($session_id));

// If not, use table settings

// If yes, update scanner-list in monitor_access for this session_id

// Reply JSON OK to enable SSE on client-side.
self::addResponseData('success', false);

// Add list of devices currently in table