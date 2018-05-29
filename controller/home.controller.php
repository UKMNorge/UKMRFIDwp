<?php
require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/herd.collection.php');
require_once(UKMRFID .'/models/scanner.collection.php');

RFID::addViewData('areas', AreaColl::getAllByName() );
RFID::addViewData('herdCount', HerdColl::getCount() );
RFID::addViewData('scanners', ScannerColl::getAllByName() );