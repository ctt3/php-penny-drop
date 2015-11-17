<?php
include '../../Base.class.php';
include '../../Models/user.class.php';

$user = User::find($_REQUEST['id']);
$user->display_edit_form();

?>