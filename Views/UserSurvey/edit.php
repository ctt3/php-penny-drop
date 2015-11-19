<?php
include '../../Base.class.php';
include '../../Models/user_survey.class.php';

$user_survey = UserSurvey::find($_REQUEST['id']);
$user_survey->display_edit_form();

?>