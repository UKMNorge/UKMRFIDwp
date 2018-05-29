<?php

// Generer lister med fylker
require_once("UKM/fylker.class.php");
require_once("UKM/monstringer.class.php");


$fylker = fylker::getAll();
RFID::addViewData('fylker', $fylker );

// Mønstringsdata for festivalen:
$monstring = monstringer_v2::land(get_site_option('season'));

// Global personliste.
$personListe = array();

foreach($fylker as $fylke) {
	$innslag = $monstring->getInnslag()->getAllByFylke($fylke);
	foreach( $innslag as $inn ) {
		$personer = $inn->getPersoner();
		foreach ($personer->personer as $person) {
			if( ! in_array($person, $personListe) ) {
				// TODO: Add gruppe og RFID-verdi til bruker-objekt om vi har de.
				$person->gruppe = new stdClass();
				$person->gruppe->id = 2;

				$personListe[$fylke->id][] = $person;
			}
		}
	}
}

RFID::addViewData('personListe', $personListe);
RFID::addViewData('monstring', $monstring);

// TODO: Finn grupper med API
$gruppe = new stdClass();
$gruppe->id = 1;
$gruppe->navn = "Test";

$gruppe2 = new stdClass();
$gruppe2->id = 2;
$gruppe2->navn = "Test2";

require_once(UKMRFID .'/models/group.collection.php');
$grupper = GroupColl::GetAllByName();

RFID::addViewData('grupper', $grupper);