<?php
include '../../Base.class.php';
include '../../Models/charity.class.php';
include '../../Controllers/charity_controller.class.php';

echo "<h1>CHARITY UPDATED!</h1>";
CharityController::render('index');

?>
