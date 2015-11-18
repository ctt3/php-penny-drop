<?php

include '../Base.class.php';
include '../Models/user.class.php';

class UserController extends ControllerRecord{

  public static function index(){}
  public static function create(){}

  public static function edit(){
    return array('id'=>$_REQUEST['id']);
  }

  public static function update(){
    $user = User::find($_POST['id']);
    $user_array = array("name"=>$_POST['name'], "username"=>$_POST['username'], "password"=>$_POST['password']);
    $user->update_attributes($user_array);
  }

  public static function save(){
    $new_user_array = array("name"=>$_POST['name'], "username"=>$_POST['username'], "password"=>$_POST['password']);
    User::create($new_user_array);
  }

  public static function delete(){
    $user = User::find($_REQUEST['id']);
    $user->self_destruct();
  }
}

new UserController();
?>