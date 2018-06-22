<?php
namespace UKMNorge\RFID;
use Exception;
use StdClass;

### ETTERREGISTRERING
require_once( 'UKM/postgres.class.php');
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');

if( 'ukm.dev' != UKM_HOSTNAME) {
	\UKMRFID::addViewData('areas', AreaColl::getAllByName() );
	\UKMRFID::addViewData('persons', PersonColl::getAll() );
} 
	
\UKMRFID::addViewData('UKM_HOSTNAME', UKM_HOSTNAME );
