<?php
include '../../Base.class.php';
include '../../Models/question.class.php';

$question = Question::find($_REQUEST['id']);
$question->display_edit_form();

?>