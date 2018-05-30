<?php
namespace UKMNorge\RFID;
use Exception;
	
require_once(UKMRFID_INCLUDE_PATH .'area.collection.php');
require_once(UKMRFID_INCLUDE_PATH .'herd.collection.php');

$herds = HerdColl::getAllByName();
$lederHerds = [];

foreach( $herds as $herd ) {
	if( strpos( $herd->getForeignId(), 'UKM-fylke-ledere-' ) === 0 ) {
		$lederHerds[ str_replace('-ledere-', '-', $herd->getForeignId()) ] = $herd;
	}
}

\UKMRFID::addViewData('area', AreaColl::getById( $_GET['area'] ) );
\UKMRFID::addViewData('herds', $herds);
\UKMRFID::addViewData('lederHerds', $lederHerds);