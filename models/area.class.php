<?php
	
require_once(UKMRFID .'/models/orm.class.php');
	
class Area extends RFIDORM {
	const TABLE_NAME = 'area';
	
	var $name = null;
	var $capacity = null;
	
	public function populate( $row ) {
		$this->setName( $row['name'] );
		$this->setCapacity( $row['capacity'] );
	}
	
	public function setName( $name ) {
		$this->name = $name;
		return $this;
	}
	public function getName() {
		return $this->name;
	}
	
	public function setCapacity( $capacity ) {
		$this->capacity = $capacity;
		return $this;
	}
	public function getCapacity() {
		return $this->capacity;
	}
}