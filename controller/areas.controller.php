<?php

namespace UKMNorge\RFID;
use Exception;

require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'person.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Area::create( $_POST['name'], $_POST['capacity'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					\UKMRFID::addMessage('error', 'Området finnes allerede!');
				} else {
					\UKMRFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

\UKMRFID::addViewData('areas', AreaColl::getAllByName() );
\UKMRFID::addViewData('persons', PersonColl::getAllByName() );