<?php
include '../../Base.class.php';
include '../../Models/user_survey.class.php';
include '../../Controllers/user_survey_controller.class.php';

echo "<h1>USER SURVEY CREATED!</h1>";
UserSurveyController::render('index');

?>
