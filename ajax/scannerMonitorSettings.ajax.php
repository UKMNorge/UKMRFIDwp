<?php

// Sett session_id cookie if not set
if(!isset($_COOKIE["session_id"])) {
	$session_id = uniqid();
	setcookie("session_id", $session_id, 0, "/", ".ukm.no");
} else {
	$session_id = $_COOKIE["session_id"];
}

// Will only dump on next load.
var_dump($session_id);

// Check table for list of scanners
require_once(UKMRFID_INCLUDE_PATH . 'monitoraccess.collection.php');

// Process posted settings:
// Are there any scanners in the list from the frontend?
var_dump(MonitorAccessColl::getForSessionId($session_id));

// If not, use table settings

// If yes, update scanner-list in monitor_access for this session_id

// Reply JSON OK to enable SSE on client-side.
self::addResponseData('success', false);

// Add list of devices currently in table