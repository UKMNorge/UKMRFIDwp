<?php

class lederPersonIntermediary {
	var $id = null;
	var $fornavn = null;
	var $etternavn = null;
	var $mobil = null;
	var $attributes = null;
	
	public function __construct( $data ) {
		$this->attributes = [];
		$this->id = $data['l_id'];
		$this->_fixName( $data['l_navn'] );
		$this->mobil = $data['l_mobilnummer'];
		$this->attributes['herd'] = 'UKM-fylke-ledere-'. $data['pl_fylke'];
		$this->attributes['type'] = 'leder';
	}
		
	public function getId() {
		return $this->id;
	}
	public function getFornavn() {
		return $this->fornavn;
	}
	public function getEtternavn(){
		return $this->etternavn;
	}
	public function getMobil(){
		return $this->mobil;
	}
	
	public function getNavn() {
		return $this->getFornavn() .' '. $this->getEtternavn();
	}
	
	public function setAttr( $key, $value ) {
		$this->attributes[ $key ] = $value;
		return $this;
	}

	public function getAttr( $key ) {
		return isset( $this->attributes[ $key ] ) ? $this->attributes[ $key ] : false;
	}
	
	private function _fixName( $name ) {
		$names = explode(' ', $name );
		
		if( sizeof( $names ) == 3 ) {
			$this->etternavn = array_pop( $names );
			$this->fornavn = join(' ', $names);
		} elseif( sizeof( $names ) == 2 ) {
			$this->fornavn = $names[0];
			$this->etternavn = $names[1];
		} else {
			$names = array_chunk( $names, round(sizeof($names)/2) );
			$this->fornavn = join(' ', $names[0]);
			if( isset($names[1]) ) {
				$this->etternavn = join(' ', $names[1]);
			} else {
				$this->etternavn = 'UTEN ETTERNAVN!';
			}
		}
	}
}