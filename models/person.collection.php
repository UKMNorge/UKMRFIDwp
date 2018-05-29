<?php

namespace UKMNorge\RFID;

require_once(UKMRFID .'/models/orm.collection.php');
require_once(UKMRFID .'/models/person.class.php');
	
class PersonColl extends RFIDColl {
	const TABLE_NAME = Person::TABLE_NAME;
	public static $models = null;
}