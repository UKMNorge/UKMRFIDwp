<?php
	
	
abstract class RFIDColl {
	static $models = null;
	

	public static function getAllByName() {
		if( self::$models == null ) {
			self::load();
		}
		
		$sorted = [];
		foreach( self::$models as $model ) {
			$sorted[ $model->getName() ] = $model;
		}
		ksort( $sorted );
		return $sorted;
	}
	
	public static function load() {
		self::$models = [];
		
		$called_class = get_called_class();
		$rows = POSTGRES::getResults("SELECT * FROM ". $called_class::TABLE_NAME);
		
		if( is_array( $rows ) ) {
			foreach( $rows as $row ) {
				self::$models[] = new Area( $row );
			}
		}
	}
}