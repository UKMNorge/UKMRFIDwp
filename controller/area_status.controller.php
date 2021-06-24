<?php

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\PiAColl;

UKMRFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );
UKMRFID::addViewData('persons', PiAColl::getAllByArea( $_GET['id'] ) );