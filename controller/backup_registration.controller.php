<?php
namespace UKMNorge\RFID;

### ETTERREGISTRERING
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );