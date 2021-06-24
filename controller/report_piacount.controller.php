<?php

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\HerdColl;

UKMRFID::addViewData('area', AreaColl::getById( $_GET['area'] ) );
UKMRFID::addViewData('herds', HerdColl::getAllByName());