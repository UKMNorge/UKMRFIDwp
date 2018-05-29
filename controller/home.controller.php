<?php
require_once(UKMRFID .'/models/area.collection.php');
require_once(UKMRFID .'/models/group.collection.php');

RFID::addViewData('areas', AreaColl::getAllByName() );
RFID::addViewData('groupCount', GroupColl::getCount() );