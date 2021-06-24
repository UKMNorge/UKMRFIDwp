<?php

use fylker;
use monstringer_v2;
use stdClass;
use UKMNorge\RFID\HerdColl;

// Global personliste 
$personListe = array();
// Pakk ut Excel-fil
UKMRFID::addViewData('filnavn', $_FILES['importExcelFile']['name']);

UKMRFID::addViewData('personListe', $personListe);

require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
$herds = HerdColl::GetAllByName();

UKMRFID::addViewData('herds', $herds);