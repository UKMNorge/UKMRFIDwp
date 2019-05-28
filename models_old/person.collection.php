<?php

namespace UKMNorge\RFID;

require_once(UKMRFID .'/models/orm.collection.php');
require_once(UKMRFID .'/models/person.class.php');
	
class PersonColl extends RFIDColl {
	const TABLE_NAME = Person::TABLE_NAME;
	public static $models = null;
	
	public static function getByForeignId( $id ) {
		$row = POSTGRES::getRow("SELECT * FROM ". self::TABLE_NAME ." WHERE foreign_id=$1", [$id]);
		
		$object_class = str_replace('Coll', '', get_called_class());
		return new $object_class( $row );
	}

	public static function countMatching($firstname, $lastname, $phone) {
		$row_count = POSTGRES::getResults( 
			"SELECT COUNT('rfid') FROM ". self::TABLE_NAME ." WHERE 
				CAST(phone AS TEXT) LIKE '$1%' AND
				last_name LIKE '$2%' AND
				first_name LIKE '$3%'", [$phone, $lastname, $firstname]);
		return $row_count;
	}
}