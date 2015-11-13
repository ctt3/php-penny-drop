<?php

class User {
	//Class properties
	public static $table_name = "user";
	public static $columns = "name, username, password";

	//**Class methods
	public static function index(){
		return Database::select(self::$table_name, "1");
	}

	public static function create($name, $username, $password){
		$values = "'" . $name . "', '" . $username . "', '" . $password . "'";
		$result = Database::insert(self::$table_name, self::$columns, $values);
		if ($result != false){
			$user = new User($result[0]["id"]);
			PennyBank::create($user->id, "0"); }
		return $user;
	}

	public static function read($id){
		return Database::select(self::$table_name, "id = " . $id);
	}

	public static function update($id, $name, $username, $password){
		$values = "name = '" . $name . "', username = '" . $username . "', password = '" . $password . "'";
		return Database::update(self::$table_name, $values, $id);
	}

	public static function delete($id){
		return Database::delete(self::$table_name, $id);
	}


	//**Instance methods
	public $id, $name, $username, $password;
	function User($id){
		$result = self::read($id)[0];
		$this->id = $result["id"];
		$this->name = $result["name"];
		$this->username = $result["username"];
		$this->password = $result["password"];
	}

	public function get_penny_bank(){
		$penny_bank = new PennyBank();
		return $penny_bank;
	}
}

?>