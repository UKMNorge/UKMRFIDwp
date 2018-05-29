<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/herd.collection.php');
require_once(UKMRFID .'/models/pia.collection.php');

\UKMRFID::addViewData('area', AreaColl::getById( $_GET['id'] ) );
\UKMRFID::addViewData('persons', PiAColl::getAllByArea( $_GET['id'] ) );