<?php

class ModelRecord {
  //**Class methods
  public static function index(){
    // Action: Retrieve all records in table, wrap records into objects
    // Output: Array of objects
    $table_name = strtolower( static::class );
    $result = Database::select($table_name, "1");
    $objects = array();
    foreach ($result as $index => $value_set){
      $obj = new static();
      static::assign_instance_variables($obj, $value_set);
      $objects[$index] = $obj;
    }
    return $objects;
  }

  public static function find($id){
    // Input: String id
    // Action: Retrieve record with id, wrap into object
    // Output: Object
    $table_name = strtolower( static::class );
    $result = Database::select($table_name, "id = " . $id)[0];
    $obj = new static();
    static::assign_instance_variables($obj, $result);
    return $obj;
  }

  public static function create($attribute_hash){
    // Input: Associative Array [String column] => String value
    // Action: Create record, wrap returned record in object
    // Output: Object
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
    // Input: String id
    // Action: Delete record with id
    // Output: Query result
    $table_name = strtolower( static::class );
    return Database::delete($table_name, $id);
  }

  public static function attribute_names(){
    // Action: Get column names for table
    // Output: Array of column names
    $table_name = strtolower( static::class );
    return Database::get_column_names($table_name);
  }

  public static function assign_instance_variables($obj, $query_result){
    // Input: Object instance, Query result
    // Action: assign record values to object instance variables
    foreach($query_result as $attribute => $value) $obj->$attribute = $value;
  }

  public static function display_index_table(){
    // Action: Draw HTML for table of all records in table
    $objects = static::index();
    $attributes = static::attribute_names();
    echo "<table border=1><tr>";
    foreach($attributes as $index => $column){ echo "<th>" . $column . "</th>"; }
    echo "</tr>";
    foreach($objects as $index => $obj){
      echo "<tr>";
      foreach($attributes as $index => $column){ echo "<td>" . $obj->$column . "</td>"; }
      echo "</tr>";
    }
    echo "</table>";
  }

  //**Instance methods
  public function update_attributes($attribute_hash){
    // Input: Associative Array [String column] => String value
    // Action: Update record to new values, reassign instance variables to current object
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

  public function self_destruct(){
    // Action: Delete record from db
    // Output: Query result
    $table_name = strtolower( static::class );
    return Database::delete($table_name, $this->$id);
  }
}

?>