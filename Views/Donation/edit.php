<?php
include '../../Base.class.php';
include '../../Models/donation.class.php';

$donation = Donation::find($_REQUEST['id']);
$donation->display_edit_form();

?>