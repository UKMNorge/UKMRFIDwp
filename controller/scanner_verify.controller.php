<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

\UKMRFID::addViewData('scanner', ScannerColl::getById( $_GET['id'] ) );
\UKMRFID::addViewData('areas', AreaColl::getAllByName() );