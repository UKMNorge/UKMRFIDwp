<?php
require_once(UKMRFID .'/models/area.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Area::create( $_POST['name'], $_POST['capacity'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					RFID::addMessage('error', 'Området finnes allerede!');
				} else {
					RFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

RFID::addViewData('areas', AreaColl::getAllByName() );