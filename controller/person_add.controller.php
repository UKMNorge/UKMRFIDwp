<?php
namespace UKMNorge\RFID;

use Exception;
use StdClass;

### Etterregistrering av enkeltpersoner som scannes inn.
require_once( 'UKM/postgres.class.php' );
POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

require_once(UKMRFID_INCLUDE_PATH . 'person.collection.php');
require_once(UKMRFID_INCLUDE_PATH . 'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH . 'herd.collection.php');

\UKMRFID::addViewData( 'persons', PersonColl::getAll() );
\UKMRFID::addViewData( 'areas', AreaColl::getAllByName() );
\UKMRFID::addViewData( 'herds', HerdColl::getAllByName() );
\UKMRFID::addViewData( 'UKM_HOSTNAME', UKM_HOSTNAME );