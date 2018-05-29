<?php
require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/group.collection.php');
require_once(UKMRFID .'/models/scanner.collection.php');

RFID::addViewData('areas', AreaColl::getAllByName() );
RFID::addViewData('groupCount', GroupColl::getCount() );
RFID::addViewData('scanners', ScannerColl::getAllByName() );