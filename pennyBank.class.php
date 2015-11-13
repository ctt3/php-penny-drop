<?php

class PennyBank {
	//Class properties
	public static $table_name = "penny_bank";
	public static $columns = "user_id, amount_available";

	//**Class methods
	public static function index(){
		return Database::select(self::$table_name, "1");
	}

	public static function create($user_id, $amount_available){
		$values = "'" . $user_id . "', '" . $amount_available . "'";
		return new PennyBank(Database::insert(self::$table_name, self::$columns, $values)['id']);
	}

	public static function read($id){
		return Database::select(self::$table_name, "id = " . $id);
	}

	public static function update($id, $user_id, $amount_available){
		$values = "user_id = '" . $user_id . "', amount_available = '" . $amount_available . "'";
		return Database::update(self::$table_name, $values, $id);
	}

	public static function delete($id){
		return Database::delete(self::$table_name, $id);
	}

	public static function find_by_user_id($user_id){
		return new PennyBank(Database::select(self::$table_name, "user_id = " . $user_id));
	}

	//**Instance methods
	public $id, $user_id, $amount_available;
	function PennyBank($id){
		$result = self::read($id)[0];
		$this->id = $result["id"];
		$this->user_id = $result["user_id"];
		$this->amount_available = $result["amount_available"];
	}
}

?>