<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );