<?php
include '../../Base.class.php';
include '../../Models/charity.class.php';

$charity = Charity::find($_REQUEST['id']);
$charity->display_edit_form();

?>