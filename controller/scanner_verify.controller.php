<?php
	
require_once(UKMRFID .'/models/scanner.collection.php');
require_once(UKMRFID .'/models/area.collection.php');

RFID::addViewData('scanner', ScannerColl::getById( $_GET['id'] ) );
RFID::addViewData('areas', AreaColl::getAllByName() );