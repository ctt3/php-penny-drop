<?php

include '../Base.class.php';
include '../Models/survey.class.php';

class SurveyController extends ControllerRecord{

  public static function index(){}
  public static function create(){}

  public static function edit(){
    return array('id'=>$_REQUEST['id']);
  }

  public static function update(){
    $survey = Survey::find($_POST['id']);
    $survey_array = array("name"=>$_POST['name'], "description"=>$_POST['description'], "available_surveys"=>$_POST['available_surveys'],"amount_earnable"=>$_POST['amount_earnable']);
    $survey->update_attributes($survey_array);
  }

  public static function save(){
    $new_survey_array = array("name"=>$_POST['name'], "description"=>$_POST['description'], "available_surveys"=>$_POST['available_surveys'],"amount_earnable"=>$_POST['amount_earnable']);
    Survey::create($new_survey_array);
  }

  public static function delete(){
    $survey = Survey::find($_REQUEST['id']);
    $survey->self_destruct();
  }
}

new SurveyController();
?>