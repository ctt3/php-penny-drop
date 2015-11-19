<?php
include '../../Base.class.php';
include '../../Models/response.class.php';

$response = Response::find($_REQUEST['id']);
$response->display_edit_form();

?>