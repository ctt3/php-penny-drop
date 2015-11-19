<?php
include '../../Base.class.php';
include '../../Models/payment.class.php';

$payment = Payment::find($_REQUEST['id']);
$payment->display_edit_form();

?>