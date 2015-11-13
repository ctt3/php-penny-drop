<?php

class ModelRecord {
  //**Class methods
  public static function index(){
    $table_name = strtolower( static::class );
    return Database::select($table_name, "1");
  }

  public static function find($id){
    $table_name = strtolower( static::class );
    $result = Database::select($table_name, "id = " . $id)[0];
    $obj = new static();
    static::assign_instance_variables($obj, $result);
    return $obj;
  }

  public static function create($attribute_hash){
    $table_name = strtolower( static::class );
    $columns = "";
    $values = "";
    $last_value = end($attribute_hash);
    foreach ($attribute_hash as $attribute => $value){
      if ($value == $last_value){
        $columns .= $attribute . "";
        $values .= "'" . $value . "'";
      }else{ 
        $columns .= $attribute . ", ";
        $values .= "'" . $value . "', ";
      }
    }
    $result = Database::insert($table_name, $columns, $values);
    if ($result != false){ 
      $obj = new static();
      static::assign_instance_variables($obj, $result);
      return $obj;
    }else{ return $result; }
  }

  public static function delete($id){
    $table_name = strtolower( static::class );
    return Database::delete($table_name, $id);
  }

  public static function assign_instance_variables($obj, $query_result){
    foreach($query_result as $attribute => $value) $obj->$attribute = $value;
  }

  //**Instance methods
  public function update_attributes($attribute_hash){
    $table_name = strtolower( static::class );
    $values = "";
    $last_value = end($attribute_hash);
    foreach ($attribute_hash as $attribute => $value){
      if ($value == $last_value){
        $values .= $attribute . " = '" . $value . "'";
      }else{ $values .= $attribute . " = '" . $value . "', "; }
    }
    $result = Database::update($table_name, $values, $this->id);
    static::assign_instance_variables($this, $result);
  }
}

?>