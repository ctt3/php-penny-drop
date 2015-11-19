<?php
include '../../Base.class.php';
include '../../Models/payment.class.php';
include '../../Controllers/payment_controller.class.php';

echo "<h1>PAYMENT DELETED!</h1>";
PaymentController::render('index');

?>
