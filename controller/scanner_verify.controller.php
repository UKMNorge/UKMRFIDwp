<?php

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\ScannerColl;

UKMRFID::addViewData('scanner', ScannerColl::getById( $_GET['id'] ) );
UKMRFID::addViewData('areas', AreaColl::getAllByName() );