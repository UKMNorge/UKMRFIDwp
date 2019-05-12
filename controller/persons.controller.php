<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');

\UKMRFID::addViewData('persons', PersonColl::getAllByName() );