<?php

namespace UKMNorge\RFID;

require_once( UKMRFID .'/class/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// Todo: Registrer person
$foreign_id = $_POST['foreignId'];
$person_fornavn = $_POST['personFornavn'];
$person_etternavn = $_POST['personEtternavn'];
$personMobil = $_POST['personMobil'];
$personGruppe = $_POST['herd'];
$rfidValue = $_POST['rfidValue'];


require_once(UKMRFID .'/models/person.class.php');
try {
	Person::create( $person_fornavn, $person_etternavn, $personMobil, $rfidValue, $personGruppe, $foreign_id );
	\UKMRFID::addResponseData('success', true );
	\UKMRFID::addResponseData('gruppeid', $personGruppe);
	\UKMRFID::addResponseData('ukm_person_id', $person_id);
	\UKMRFID::addResponseData('rfid', $rfidValue);
} catch( Exception $e ) {
	\UKMRFID::addResponseData('success', false );
	\UKMRFID::addResponseData('message', $e->getMessage());
}