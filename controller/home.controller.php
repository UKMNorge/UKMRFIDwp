<?php

namespace UKMNorge\RFID;
use Exception;

require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/herd.collection.php');
require_once(UKMRFID .'/models/scanner.collection.php');

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );
\UKMRFID::addViewData('herdCount', HerdColl::getCount() );
\UKMRFID::addViewData('scanners', ScannerColl::getAllByName() );