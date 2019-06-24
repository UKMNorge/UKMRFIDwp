<?php

namespace UKMNorge\RFID;
use Exception;
use stdClass;
	
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');


// Liste over alle scannere til velge-funksjon
$scanners = ScannerColl::getAllByName();

\UKMRFID::addViewData( 'scanners', $scanners );