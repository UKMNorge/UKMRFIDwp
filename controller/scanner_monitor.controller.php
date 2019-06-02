<?php

namespace UKMNorge\RFID;
use Exception;
use stdClass;
	
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

// Last inn valgte scannere fra tabell monitor_access


// Liste over alle scannere til velge-funksjon
$scanner = new stdClass();
$scanner->id = 1;
$scanners = array($scanner);

\UKMRFID::addViewData( 'scanners',