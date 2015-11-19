<?php
include '../../Base.class.php';
include '../../Models/response.class.php';
include '../../Controllers/response_controller.class.php';

echo "<h1>RESPONSE CREATED!</h1>";
ResponseController::render('index');

?>
