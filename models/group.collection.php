<?php
require_once(UKMRFID .'/models/orm.collection.php');
require_once(UKMRFID .'/models/group.class.php');
	
class GroupColl extends RFIDColl {
	const TABLE_NAME = Group::TABLE_NAME;
	public static $models = null;
}