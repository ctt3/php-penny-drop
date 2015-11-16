<?php

include 'controller_record.class.php';

class UserController extends ControllerRecord{

  public static function index(){echo 'index';}
  public static function create(){echo 'create';}
  public static function update(){echo 'update';}
  public static function delete(){echo 'delete';}
}

UserController::route();
?>