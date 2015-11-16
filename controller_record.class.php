<?php

class ControllerRecord {

  protected static $actions = array('index', 'create', 'update', 'delete');

  public static function render(){
    $url = 'http://www.google.com'; //save domain in config.ini, navigate to correct view
    echo "<script>window.location = '". $url . "'</script>";
  }

  public static function route(){
    $action_request = $_REQUEST['action'];
    if (in_array($action_request, self::$actions)){
      static::$action_request();
      static::render();
    }
  }
}

?>