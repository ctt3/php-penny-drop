<?php

include '../Base.class.php';
include '../Models/user.class.php';

class UserController extends ControllerRecord{

  public static function index(){}
  public static function create(){}
  public static function edit(){}
  public static function update(){}

  public static function save(){
    $new_user_array = array("name"=>$_POST['name'], "username"=>$_POST['username'], "password"=>$_POST['password']);
    User::create($new_user_array);
  }

  public static function delete(){}
}

new UserController();
?>