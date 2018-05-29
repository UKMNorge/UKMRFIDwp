<?php
	
require_once(UKMRFID .'/models/area.collection.php');

RFID::addViewData('areas', AreaColl::getAllByName() );