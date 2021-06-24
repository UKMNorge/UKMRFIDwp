<?php

use UKMNorge\RFID\PersonColl;

UKMRFID::addViewData('persons', PersonColl::getAllByName() );