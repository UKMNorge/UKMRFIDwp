<?php


use monstringer_v2;
use stdClass;
use lederPersonIntermediary;
use UKMNorge\Database\SQL\Query;
use UKMNorge\Geografi\Fylker;
use UKMNorge\RFID\HerdColl;

// Generer lister med fylker
require_once("UKM/Autoloader.php");

$fylker = Fylker::getAllInkludertGjester();
UKMRFID::addViewData('fylker', $fylker );

// Mønstringsdata for festivalen:
$monstring = monstringer_v2::land(get_site_option('season'));

// Global personliste.
$personListe = array();

foreach($fylker as $fylke) {
	foreach( $monstring->getInnslag()->getAllByFylke($fylke) as $innslag ) {
		foreach ($innslag->getPersoner()->getAll() as $person) {
			if( ! in_array($person, $personListe) ) {
				// TODO: Sjekk personens lagrede gruppe (krever postgres-spørring!)
				// TODO: Oppdater personens lagrede RFID, for sjekking av grønn-status.
				$personListe[$fylke->id][] = $person;
				$person->setAttr('herd', 'UKM-fylke-'. $innslag->getFylke()->getId());
				$person->setAttr('type', 'deltaker');
			}
		}
	}
}

/**
 * Henter ledere fra videresendingssystemet
**/
$monstring = monstringer_v2::land( get_site_option('season') );
$leder_sql = new Query("SELECT *
					FROM `smartukm_videresending_ledere_ny` AS `leder`
					LEFT JOIN `smartukm_place` AS `sort` ON (`sort`.`pl_id` = `leder`.`pl_id_from`)
					WHERE `pl_id_to` = '#pl_to'
					AND `leder`.`season` = '#season'
					ORDER BY `sort`.`pl_name` ASC
					",
				array(	'pl_to' => $monstring->getId(),
						'season' => $monstring->getSesong(),
					)
				);
$res = $leder_sql->run();
while( $row = Query::fetch( $res ) ) {
	$personListe[ $row['pl_fylke'] ][] = new lederPersonIntermediary( $row );
}

UKMRFID::addViewData('personListe', $personListe);
UKMRFID::addViewData('monstring', $monstring);

$herds = HerdColl::GetAllByName();
UKMRFID::addViewData('herds', $herds);