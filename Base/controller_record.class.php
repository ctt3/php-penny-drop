<?php

class ControllerRecord {

  protected static $actions = array('index', 'create', 'update', 'delete');

  public static function render($action){
    // send to correct view
    $domain = parse_ini_file('config.ini')['domain'];
    $controller_class = str_replace("Controller", "", static::class);
    $view =  $action . ".php";
    $url = $domain . "/views/" . $controller_class . "/" . $view;
    echo "<script>window.location = '". $url . "'</script>";
  }

  public static function route(){
    $action_request = $_REQUEST['action'];
    if (in_array($action_request, self::$actions)){
      static::$action_request();
      static::render($action_request);
    }
  }
}

?>