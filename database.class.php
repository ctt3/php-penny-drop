<?php
class Database {
	protected static $connection;

	public static function connect(){
		$config = parse_ini_file('config.ini');
		self::$connection = new mysqli('127.0.0.1', $config['username'], $config['password'], $config['dbname']);
		if (self::$connection->connect_errno) {
			echo self::$connection->connect_errno . ": " . self::$connection->connect_error;
			exit;
		}
	}

	public static function disconnect(){
		self::$connection->close();
	}

	public static function execute_query($sql){
		self::connect();
		$result = self::$connection->query($sql);
		if ($result === false){echo self::$connection->error;}
		self::disconnect();
		return $result;
	}

	public static function execute_insert_query($sql){
		self::connect();
		$result = self::$connection->query($sql);
		if ($result === false){
			echo self::$connection->error;
		}else{
			$result = self::$connection->insert_id;
		}
		self::disconnect();
		return $result;
	}

	public static function insert($table, $columns, $values){
		$sql = "insert into " . $table . " (" . $columns . ") Values (" . $values . ")";
		$result = self::execute_insert_query($sql);
		if($result != false) {
			return self::select($table, "id = " . $result)[0];
		} else{ return $result; }
	}

	public static function update($table, $column_values, $id){
  	$sql = "update " . $table . " set " . $column_values . " where id = " . $id;
		$result = self::execute_query($sql);
		if($result != false) {
			return self::select($table, "id = " . $id)[0];
		} else{ return $result; }
	}

	public static function delete($table, $id){
		$sql = "delete from " . $table . " where id = " . $id;
		$result = self::execute_query($sql);
		return $result;
	}

	public static function select($table, $conditions){
		$sql = "select * from " . $table . " where " . $conditions;
		$result = self::execute_query($sql);
		if($result != false) {
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) { $rows[] = $row; }
			return $rows;
		} else{ return $result; }
	}
}

?>