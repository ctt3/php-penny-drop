<?php
include '../../Base.class.php';
include '../../Models/user.class.php';
include '../../Controllers/user_controller.class.php';

echo "<h1>USER DELETED!</h1>";
UserController::render('index');

?>
