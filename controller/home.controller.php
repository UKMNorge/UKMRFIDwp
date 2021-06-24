<?php

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\HerdColl;
use UKMNorge\RFID\ScannerColl;

UKMRFID::addViewData('areas', AreaColl::getAllByName() );
UKMRFID::addViewData('herdCount', HerdColl::getCount() );
UKMRFID::addViewData('scanners', ScannerColl::getAllByName() );