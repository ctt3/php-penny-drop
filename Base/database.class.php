<?php
class Database {
	protected static $connection;

	public static function connect(){
		// Action: Parses config file,
		//         Instantiates connection to database
		$config = parse_ini_file('config.ini');
		self::$connection = new mysqli('127.0.0.1', $config['username'], $config['password'], $config['dbname']);
		if (self::$connection->connect_errno) {
			echo self::$connection->connect_errno . ": " . self::$connection->connect_error;
			exit;
		}
	}

	public static function disconnect(){
		// Action: Closes connection to database
		self::$connection->close();
	}

	public static function execute_query($sql){
		// Input: String sql query
		// Action: Opens connection, queries db, closes connection
		// Output: Query result
		self::connect();
		$result = self::$connection->query($sql);
		if ($result === false){echo self::$connection->error;}
		self::disconnect();
		return $result;
	}

	public static function execute_insert_query($sql){
		// Input: String sql query
		// Action: Opens connection, inserts into db, closes connection
		// Output: Id of inserted record
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
		// Input: String table-name, String listed columns, String listed values
		// Action: Builds and executes insert sql, Retrieves newly inserted record
		// Output: New record
		$sql = "insert into " . $table . " (" . $columns . ") Values (" . $values . ")";
		$result = self::execute_insert_query($sql);
		if($result != false) {
			return self::select($table, "id = " . $result)[0];
		} else{ return $result; }
	}

	public static function update($table, $column_values, $id){
		// Input: String table-name, String columns = values, String id
		// Action: Builds and executes update sql, Retrieves newly updated record
		// Output: Updated record
  	$sql = "update " . $table . " set " . $column_values . " where id = " . $id;
		$result = self::execute_query($sql);
		if($result != false) {
			return self::select($table, "id = " . $id)[0];
		} else{ return $result; }
	}

	public static function delete($table, $id){
		// Input: String table-name, String id
		// Action: Builds and executes delete sql
		// Output: Query result
		$sql = "delete from " . $table . " where id = " . $id;
		$result = self::execute_query($sql);
		return $result;
	}

	public static function select($table, $conditions){
		// Input: String table-name, String where-conditions
		// Action: Builds and executes select sql
		// Output: Array of selected records
		$sql = "select * from " . $table . " where " . $conditions;
		$result = self::execute_query($sql);
		if($result != false) {
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) { $rows[] = $row; }
			return $rows;
		} else{ return $result; }
	}

	public static function get_column_names($table){
		// Input: String table-name
		// Action: Builds and executes show columns sql
		// Output: Array of column names
		$sql = "show columns from " . $table;
		$result = self::execute_query($sql);
		if($result != false) {
			$rows = array();
			while ($row = mysqli_fetch_assoc($result)) { $rows[] = $row['Field']; }
			return $rows;
		} else{ return $result; }
	}
}

?>