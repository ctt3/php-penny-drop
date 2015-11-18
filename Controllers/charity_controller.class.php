<?php

include '../Base.class.php';
include '../Models/charity.class.php';

class CharityController extends ControllerRecord{

  public static function index(){}
  public static function create(){}

  public static function edit(){
    return array('id'=>$_REQUEST['id']);
  }

  public static function update(){
    $charity = Charity::find($_POST['id']);
    $charity_array = array("name"=>$_POST['name'], "description"=>$_POST['description']);
    $charity->update_attributes($charity_array);
  }

  public static function save(){
    $new_charity_array = array("name"=>$_POST['name'], "description"=>$_POST['description']);
    Charity::create($new_charity_array);
  }

  public static function delete(){
    $charity = Charity::find($_REQUEST['id']);
    $charity->self_destruct();
  }
}

new CharityController();
?>