<?php

class ControllerRecord {

  protected static $actions = array('index', 'create', 'update', 'delete');

  public static function render($action){
    // send to correct view
    $domain = $_SERVER['SERVER_NAME'];
    $controller_class = str_replace("Controller", "", static::class);
    $view =  $action . ".php";
    $url = "http://" . $domain . "/views/" . $controller_class . "/" . $view;
    echo "<script>window.location = '". $url . "'</script>";
  }

  function ControllerRecord(){
    // call action method on inheriting class
    // reroute to view named class/method.php
    $action_request = $_REQUEST['action'];
    if (in_array($action_request, self::$actions)){
      static::$action_request();
      static::render($action_request);
    }
  }
}
?>