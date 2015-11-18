<?php
include '../../Base.class.php';
include '../../Models/survey.class.php';
include '../../Controllers/survey_controller.class.php';

echo "<h1>SURVEY CREATED!</h1>";
SurveyController::render('index');

?>
