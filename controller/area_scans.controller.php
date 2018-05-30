<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'scan.collection.php');

#Scan::create( rand(1,10), (rand(0,1)?'in':'out'), 23);

\UKMRFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );
\UKMRFID::addViewData('scans', ScanColl::getAllByArea( $_GET['id'] ) );