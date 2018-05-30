<?php

namespace UKMNorge\RFID;

use fylker;
use monstringer_v2;
use stdClass;
use PHPExcel\PHPExcel;
use PHPExcel_IOFactory;

$mobileColumn = "C";
$firstNameColumn = "A";
$lastNameColumn = "B";
$herdColumn = "D";

require_once('PHPExcel/PHPExcel.php');
if (UKM_HOSTNAME != 'ukm.dev') {
	require_once('PHPExcel/IOFactory.php');
}

// Hvis vi har mottatt en fil:
try {
	if ( null != $_FILES['excelImportFile'] ) {
		// Global personliste 
		$personListe = array();
		// Pakk ut Excel-fil
		$excelDoc = PHPExcel_IOFactory::load($_FILES['excelImportFile']['tmp_name']);
		$worksheet = $excelDoc->getSheet(0);
		// First row is headers
		$row = 2;
		// Loop through alle linjer der navnet ikke er tomt.
		while ($worksheet->getCell($firstNameColumn.$row)->getValue() != "") {

			$person = new stdClass();
			$person->id = $row;
			$person->fornavn = $worksheet->getCell($firstNameColumn.$row)->getValue();
			$person->etternavn = $worksheet->getCell($lastNameColumn.$row)->getValue();
			$person->mobil = $worksheet->getCell($mobileColumn.$row)->getValue();
			$person->herd = $worksheet->getCell($herdColumn.$row)->getValue();
			
			$personListe[] = $person;

			$row++;
		}
		
		\UKMRFID::addViewData('filnavn', $_FILES['excelImportFile']['name']);
		\UKMRFID::addViewData('personListe', $personListe);	
	}
}
catch (Exception $e) {
	\UKMRFID::addViewData('error', array('level'=>'danger', 'message'=>"Klarte ikke å lese filen du lastet opp!"));
}

require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
$herds = HerdColl::GetAllByName();

\UKMRFID::addViewData('herds', $herds);