<?php

include '../Base.class.php';

session_start();
$name = $_POST['username'];
$pwd = $_POST['password'];
$result = Database::select("user", "username = '". $name ."' and password = '". $pwd . "'")[0];
if($result != false) {
	$_SESSION['user_id'] = $result['id'];
	$_SESSION['name'] = $result['name'];
	$_SESSION['pennies_available'] = $result['pennies_available'];
	$_SESSION['last_logged_in'] = $result['last_logged_in'];
	$_SESSION['admin'] = $result['admin'];
	echo 'true';
	}
else {
	echo 'false';
}

?>