<?php
include '../../Base.class.php';
include '../../Models/question.class.php';
include '../../Controllers/question_controller.class.php';

echo "<h1>QUESTION UPDATED!</h1>";
QuestionController::render('index');

?>
