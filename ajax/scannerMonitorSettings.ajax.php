<?php

// Sett session_id cookie if not set
if(!isset($_COOKIE["session_id"])) {
	setcookie("session_id", uniqid(), 0, "/", ".ukm.no");
}

// Will only dump on next load.
var_dump($_COOKIE["session_id"]);
// Process scanner settings:
// Which scanners are selected?

// Update scanner-list in monitor_access for this session_id

// Reply JSON OK to enable SSE on client-side.
self::addResponseData('success', false);