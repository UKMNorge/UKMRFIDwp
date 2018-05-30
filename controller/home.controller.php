<?php

namespace UKMNorge\RFID;
use Exception;

require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'scanner.collection.php');

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );
\UKMRFID::addViewData('herdCount', HerdColl::getCount() );
\UKMRFID::addViewData('scanners', ScannerColl::getAllByName() );