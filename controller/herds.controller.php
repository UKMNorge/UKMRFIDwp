<?php

namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID .'/models/herd.collection.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	switch( $_POST['action'] ) {
		case 'add':
			try {
				Herd::create( $_POST['name'], $_POST['foreign'] );
			} catch( Exception $e ) {
				if( $e->getCode() == 1 ) {
					\UKMRFID::addMessage('error', 'Gruppen finnes allerede!');
				} else {
					\UKMRFID::addMessage('error', $e->getMessage());
				}
			}
			break;
	}
}
	

\UKMRFID::addViewData('groups', HerdColl::getAllByName() );