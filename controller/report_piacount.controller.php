<?php
namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');

\UKMRFID::addViewData('area', AreaColl::getById( $_GET['area'] ) );
\UKMRFID::addViewData('herds', HerdColl::getAllByName());