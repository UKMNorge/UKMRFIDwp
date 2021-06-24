<?php

use UKMNorge\RFID\Herd;
use UKMNorge\RFID\HerdColl;

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Herd::create( $_POST['name'], $_POST['foreign'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					UKMRFID::addMessage('error', 'Gruppen finnes allerede!');
				} else {
					UKMRFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

UKMRFID::addViewData('groups', HerdColl::getAllByName() );