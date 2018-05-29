<?php
	
abstract class RFIDORM {
	
	var $id = null;
	
	abstract public function populate( $row );
	
	public function __construct( $id_or_row ) {
		if( is_numeric( $id_or_row ) ) {
			$id_or_row = self::getRowFromDb( $id_or_row );
		}
		
		$this->setId( $id_or_row['id'] );
		
		$this->populate( $id_or_row );
	}
	
	public static function getRowFromDb( $id ) {
		return POSTGRES::getRow("SELECT * FROM ". self::TABLE_NAME ." WHERE id=". $id);
	}
	
	
	public function setId( $id ) {
		$this->id = $id;
		return $this;
	}
	public function getId() {
		return $this->id;
	}
}