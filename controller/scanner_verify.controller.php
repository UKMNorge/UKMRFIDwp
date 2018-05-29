<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID .'/models/scanner.collection.php');
require_once(UKMRFID .'/models/area.collection.php');

\UKMRFID::addViewData('scanner', ScannerColl::getById( $_GET['id'] ) );
\UKMRFID::addViewData('areas', AreaColl::getAllByName() );