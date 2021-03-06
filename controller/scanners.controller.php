<?php

use UKMNorge\RFID\ScannerColl;

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
	try {
		switch( $_POST['action'] ) {
			case 'verify':
				$scanner = ScannerColl::getById( $_POST['scanner'] );
				$scanner->setVerified( true );
				$scanner->setName( $_POST['name'] );
				$scanner->setAreaId( $_POST['area'] );
				$scanner->setDirection( $_POST['direction'] );
				$scanner->save();
			break;
			default:
				throw new Exception('Beklager, støtter ikke handlingen du etterspør.');
		}
	} catch( Exception $e ) {
		if( $e->getCode() == 1 ) {
			UKMRFID::addMessage('error', 'Scanneren finnes allerede!');
		} else {
			UKMRFID::addMessage('error', $e->getMessage());
		}
	}
}

//Scanner::create( '123e4567-e89b-12d3-a456-426655440004', $_SERVER['HTTP_CF_CONNECTING_IP'] );

UKMRFID::addViewData('scanners', ScannerColl::getAllByName() );