<?php
class Db {

	protected static $db;

	public static function getDb() {

		if(!isset(self::$db)) {
			try {
			   self::$db = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME.";charset=utf8", Config::DB_USER, Config::DB_PASS);
			   self::$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

			   // set the PDO error mode to exception
			   self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			}catch(PDOException $e){
			  echo "Connection failed: " . $e->getMessage();
			}
		}

		return self::$db;
	}

	public static function query($sql, $attrs = array()) {
		if(!is_array($attrs)){
			$attrs = array($attrs);
		}

	  $query = Db::getDb()->prepare($sql);
	  $query->execute($attrs);

		return $query;
	}

}
?>