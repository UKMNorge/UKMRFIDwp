<?php
namespace UKMNorge\RFID;

### ETTERREGISTRERING
require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );
\UKMRIFD::addViewData('persons', PersonColl::getAll() );