<?php

use UKMNorge\RFID\Area;
use UKMNorge\RFID\AreaColl;
use UKMNorge\RFID\PersonColl;

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Area::create( $_POST['name'], $_POST['capacity'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					UKMRFID::addMessage('error', 'Området finnes allerede!');
				} else {
					UKMRFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

UKMRFID::addViewData('areas', AreaColl::getAllByName() );
UKMRFID::addViewData('persons', PersonColl::getAllByName() );