<?php

namespace UKMNorge\RFID;

use fylker;
use monstringer_v2;
use stdClass;
use UKMRFID;
use Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception as PHPOfficeException;

$mobileColumn = "C";
$firstNameColumn = "A";
$lastNameColumn = "B";
$herdColumn = "D";

$fileName = $_FILES['excelImportFile']['name'];
$fileExt = strtolower(
	substr( 
		$fileName,
		strrpos(
			$fileName,
			'.'
		)+1
	)
);
$fileType = ucfirst( $fileExt );

require_once('UKM/inc/excel.inc.php');



// Hvis vi har mottatt en fil:
if ( null != $_FILES['excelImportFile'] ) {
	try {
		$reader = IOFactory::createReader( $fileType );	
		$doRead = true;
	} catch( PHPOfficeException $e ) {
		$doRead = false;
		UKMRFID::addViewData('error', array('level'=>'danger', 'message'=>"Klarte ikke å lese filen du lastet opp! Ukjent filtype:" . $e->getMessage()));
	}

	// Hvis vi klarer å lese filen
	if( $doRead ) {
		try {
			// Global personliste 
			$personListe = array();
			// Pakk ut Excel-fil
			$excelDoc = $reader->load($_FILES['excelImportFile']['tmp_name']);
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
			
			UKMRFID::addViewData('filnavn', $_FILES['excelImportFile']['name']);
			UKMRFID::addViewData('random', hash('md5', $_FILES['excelImportFile']['tmp_name']));
			UKMRFID::addViewData('personListe', $personListe);	
		}
		catch (Exception $e) {
			UKMRFID::addViewData('error', array('level'=>'danger', 'message'=>"Klarte ikke å lese filen du lastet opp!"));
		}
	}
}

require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
$herds = HerdColl::GetAllByName();

UKMRFID::addViewData('herds', $herds);