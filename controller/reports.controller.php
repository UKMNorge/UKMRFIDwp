<?php

use UKMNorge\RFID\AreaColl;

UKMRFID::addViewData('areas', AreaColl::getAllByName() );