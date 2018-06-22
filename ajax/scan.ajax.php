<?php

namespace UKMNorge\RFID;
use Exception;

require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

require_once(UKMRFID_INCLUDE_PATH .'person.class.php');
require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'scan.collection.php');


$area = $_POST['area'];
$rfid = $_POST['rfid'];
$direction = $_POST['direction'];

try {
	$scan = Scan::create($rfid, $direction, $area);
	\UKMRFID::addResponseData('success', true );
	\UKMRFID::addResponseData('rfid', $rfid );
}
catch (Exception $e) {
	\UKMRFID::addResponseData('success', false );
	\UKMRFID::addResponseData('message', "Feilet på å opprette scanning for rfid ". $rfid .": " .$e->getMessage());
}