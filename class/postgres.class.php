<?php
	
class POSTGRES {
	private static $connection = null;
	
	public static function connect( $username, $password, $database) {
		self::$connection = pg_connect("host=localhost dbname=$database user=$username password=$password");
	}
	
	public static function getRow( $query ) {
		$result = self::getResults( $query );
		if( isset( $result[0] ) ) {
			return $result[0];
		}
		throw new Exception('POSTGRES did not return any rows');
	}
	
	public static function getValue( $query ) {
		$result = self::getRow( $query );
		
		if( is_array( $result ) ) {
			return reset( $result );
		}
		
		throw new Exception('POSTGRES did not return any values');
	}
	
	public static function getResults( $query ) {
		$result = pg_query( self::$connection, $query );
		return pg_fetch_all( $result );
	}
	
	public static function prepare( $query, $vars ) {
		
	}
}

/**
	$conn = pg_connect("host=localhost dbname=ukmrfid_db port=5432 user=ukmrfid_user password=39p81AolxYjL");
	$result = pg_query($conn, "select * from areas");
	var_dump(pg_fetch_all($result));
**/