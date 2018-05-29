<?php
	
require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/scan.collection.php');

Scan::create( rand(1,10), (rand(0,1)?'in':'out'), 23);

RFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );

RFID::addViewData('scans', ScanColl::getByArea( $_GET['id'] ) );