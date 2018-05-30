<?php

namespace UKMNorge\RFID;
use Exception;

require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

// Todo: Registrer person
$foreign_id = $_POST['foreignId'];
$person_fornavn = $_POST['personFornavn'];
$person_etternavn = $_POST['personEtternavn'];
$personMobil = $_POST['personMobil'];
$personGruppe = $_POST['herd'];
$rfidValue = $_POST['rfidValue'];

$person = null;


require_once(UKMRFID_INCLUDE_PATH .'person.class.php');
require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');
// Sjekk om personen finnes og skal oppdateres
try {
	$person = PersonColl::getByForeignId($foreign_id);
}
catch(Exception $e) {
	// Only means that we didn't find a row
	\UKMRFID::addResponseData('info', "Ignored an exception when getting by Foreign ID");
}	

if( is_object($person) ) {
	$person->setFirstName($person_fornavn)
	->setLastName($person_etternavn)
	->setPhone($personMobil)
	->setHerd($personGruppe)
	->setRFID($rfidValue);
	$person->save();

	\UKMRFID::addResponseData('success', true );
	
} else {
	try {
		Person::create( $person_fornavn, $person_etternavn, $personMobil, $rfidValue, $personGruppe, $foreign_id );
		\UKMRFID::addResponseData('success', true );
	}
	catch(Exception $e) {
		\UKMRFID::addResponseData('success', false );
		\UKMRFID::addResponseData('message', "Create-feil: " .$e->getMessage());
	}
}

\UKMRFID::addResponseData('gruppeid', $personGruppe);
\UKMRFID::addResponseData('ukm_person_id', $foreign_id);
\UKMRFID::addResponseData('rfid', $rfidValue);
	
