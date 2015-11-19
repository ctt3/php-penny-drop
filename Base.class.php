<?php
define("ROOT_PATH", "http://" . $_SERVER["SERVER_NAME"]);

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

//**************************************************************//

function from_camel_case($input) {
  // CITE: http://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
  preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
  $ret = $matches[0];
  foreach ($ret as &$match) {
    $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
  }
  return implode('_', $ret);
}

//**************************************************************//

class ModelRecord {

  //**Class methods
  public static function index(){
    // Action: Retrieve all records in table, wrap records into objects
    // Output: Array of objects
    $table_name = from_camel_case( static::class );
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
    $table_name = from_camel_case( static::class );
    $result = Database::select($table_name, "id = " . $id)[0];
    $obj = new static();
    static::assign_instance_variables($obj, $result);
    return $obj;
  }

  public static function create($attribute_hash){
    // Input: Associative Array [String column] => String value
    // Action: Create record, wrap returned record in object
    // Output: Object
    $table_name = from_camel_case( static::class );
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
    $table_name = from_camel_case( static::class );
    return Database::delete($table_name, $id);
  }

  public static function attribute_names(){
    // Action: Get column names for table
    // Output: Array of column names
    $table_name = from_camel_case( static::class );
    return Database::get_column_names($table_name);
  }

  public static function assign_instance_variables($obj, $query_result){
    // Input: Object instance, Query result
    // Action: assign record values to object instance variables
    foreach($query_result as $attribute => $value) $obj->$attribute = $value;
  }

  public static function display_index_table(){
    // Action: Draw HTML for table of all records in table
    $controller_path = ROOT_PATH . "/Controllers/" . from_camel_case( static::class ) . "_controller.class.php";
    $objects = static::index();
    $attributes = static::attribute_names();
    echo "<table border=1><tr>";
    foreach($attributes as $index => $column){ echo "<th>" . $column . "</th>"; }
    echo "<th>Actions</th>";
    echo "</tr>";
    foreach($objects as $index => $obj){
      echo "<tr>";
      foreach($attributes as $index => $column){ echo "<td>" . $obj->$column . "</td>"; }
      echo "<td><a href='".$controller_path."?action=edit&id=".$obj->id."'>Edit</a>";
      echo "&nbsp;&nbsp;";
      echo "<a href='".$controller_path."?action=delete&id=".$obj->id."'>Delete</a></td>";
      echo "</tr>";
    }
    echo "</table>";
    echo "<a href='".$controller_path."?action=create'>Create New</a><br/>";
  }

  //**Instance methods
  public function update_attributes($attribute_hash){
    // Input: Associative Array [String column] => String value
    // Action: Update record to new values, reassign instance variables to current object
    $table_name = from_camel_case( static::class );
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
    $table_name = from_camel_case( static::class );
    return Database::delete($table_name, $this->id);
  }

  public function get_dependents($dependent_table){
    // Input: String name of dependent table
    // Action: instantiatesobjects of dependent table class that have
    //          a foreign key that relates to current object
    // Output: Array of objects of dependent class
    $tableid = from_camel_case( static::class ) . "id";
    $dependent_model = str_replace("_", "", ucwords($dependent_table, "_ \t\r\n\f\v"));
    $result = Database::select($dependent_table, $tableid."=".$this->id);
    $objects = array();
    foreach ($result as $index => $value_set){
      $obj = new $dependent_model();
      self::assign_instance_variables($obj, $value_set);
      $objects[$index] = $obj;
    }
    return $objects;

  }
}

//**************************************************************//

class ControllerRecord {

  protected static $actions = array('index', 'create', 'edit', 'update', 'save', 'delete');

  public static function render($action, $params=array()){
    // send to correct view
    $controller_class = str_replace("Controller", "", static::class);
    $view =  $action . ".php";
    $url = ROOT_PATH . "/Views/" . $controller_class . "/" . $view;
    if (count($params) > 0){
      $url .= "?";
      $last_value = end($params);
      foreach ($params as $param => $value){
        if ($value == $last_value){
          $url .= $param . "=" . $value;
        }else {
          $url .= $param . "=" . $value . "&";
        }
      }
    }
    echo "<script>window.location = '". $url . "'</script>";
  }

  public static function clean_post($post){
    // makes sure blank strings are not sent to db
    // TODO: make sure this doesn't stop users from clearing fields****************
    $new_post = array();
    foreach($post as $key => $val){
      if (strlen($val) > 0) $new_post[$key] = $val;
    }
    return $new_post;
  }

  function ControllerRecord(){
    // call action method on inheriting class
    // reroute to view named class/method.php
    $action_request = $_REQUEST['action'];
    $this->model_name = strtolower(str_replace("Controller", "", static::class));
    if (in_array($action_request, self::$actions)){
      $params = $this->$action_request();
      static::render($action_request, $params);
    }
  }

  public function index(){}
  public function create(){}

  public function edit(){
    // passes the id along to the rendered view
    return array('id'=>$_REQUEST['id']);
  }

  public function update(){
    // finds the appropriate record
    // updates its attributes
    $model = ucfirst($this->model_name);
    $obj = $model::find($_POST['id']);
    unset($_POST['id']);
    $obj->update_attributes(self::clean_post($_POST));
  }

  public function save(){
    // creates record
    $model = ucfirst($this->model_name);
    $model::create(self::clean_post($_POST));
  }

  public function delete(){
    // deletes record
    $model = ucfirst($this->model_name);
    $obj = $model::find($_REQUEST['id']);
    $obj->self_destruct();
  }

}

?>
