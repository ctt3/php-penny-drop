<?php
include '../../Base.class.php';
include '../../Models/survey.class.php';

$survey = Survey::find($_REQUEST['id']);
$survey->display_edit_form();

?>