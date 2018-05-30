<?php

namespace UKMNorge\RFID;

use fylker;
use monstringer_v2;
use stdClass;

// Global personliste 
$personListe = array();
// Pakk ut Excel-fil
\UKMRFID::addViewData('filnavn', $_FILES['importExcelFile']['name']);

\UKMRFID::addViewData('personListe', $personListe);

require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
$herds = HerdColl::GetAllByName();

\UKMRFID::addViewData('herds', $herds);