<?php
include '../../Base.class.php';
include '../../Models/donation.class.php';
include '../../Controllers/donation_controller.class.php';

echo "<h1>DONATION DELETED!</h1>";
DonationController::render('index');

?>
