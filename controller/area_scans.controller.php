<?php

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\ScanColl;

#Scan::create( rand(1,10), (rand(0,1)?'in':'out'), 23);

UKMRFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );
UKMRFID::addViewData('scans', ScanColl::getAllByArea( $_GET['id'] ) );