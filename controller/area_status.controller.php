<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'pia.collection.php');

\UKMRFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );
\UKMRFID::addViewData('persons', PiAColl::getAllByArea( $_GET['id'] ) );