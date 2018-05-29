<?php
	
require_once(UKMRFID .'/models/group.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Group::create( $_POST['name'], $_POST['foreign'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					RFID::addMessage('error', 'Gruppen finnes allerede!');
				} else {
					RFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

RFID::addViewData('groups', GroupColl::getAllByName() );