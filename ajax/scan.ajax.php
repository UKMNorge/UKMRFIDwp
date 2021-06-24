<?php

use UKMNorge\RFID\Scan;

$area = $_POST['area'];
$rfid = $_POST['rfid'];
$direction = $_POST['direction'];

UKMRFID::addResponseData('rfid', $rfid );

try {
	$scan = Scan::create($rfid, $direction, $area);
	UKMRFID::addResponseData('success', true );
}
catch (Exception $e) {
	UKMRFID::addResponseData('success', false );
	UKMRFID::addResponseData('message', "Feilet på å opprette scanning for rfid ". $rfid .": " .$e->getMessage());
}