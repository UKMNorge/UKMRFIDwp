<?php


### ETTERREGISTRERING

use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\PersonColl;
use UKMNorge\RFID\POSTGRES;

POSTGRES::connect( PG_RFID_USER, PG_RFID_PASS, PG_RFID_DB );

if( 'ukm.dev' != UKM_HOSTNAME) {
	UKMRFID::addViewData('areas', AreaColl::getAllByName() );
	UKMRFID::addViewData('persons', PersonColl::getAll() );
} 
	
UKMRFID::addViewData('UKM_HOSTNAME', UKM_HOSTNAME );
