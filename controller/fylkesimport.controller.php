<?php

namespace UKMNorge\RFID;

use fylker;
use monstringer_v2;
use stdClass;

// Generer lister med fylker
require_once("UKM/fylker.class.php");
require_once("UKM/monstringer.class.php");


$fylker = fylker::getAll();
\UKMRFID::addViewData('fylker', $fylker );

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
				// TODO: Sjekk personens lagrede gruppe (krever postgres-spørring!)

				// TODO: Oppdater personens lagrede RFID, for sjekking av grønn-status.

				$personListe[$fylke->id][] = $person;
			}
		}
	}
}

\UKMRFID::addViewData('personListe', $personListe);
\UKMRFID::addViewData('monstring', $monstring);

require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
$herds = HerdColl::GetAllByName();

\UKMRFID::addViewData('herds', $herds);