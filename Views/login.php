<?php

include '../Base.class.php';

session_start();
$name = $_POST['username'];
$pwd = md5($_POST['password']);
$result = Database::select("user", "username = '". $name ."' and password = '". $pwd . "'")[0];
if($result != false) {
	$_SESSION['user_id'] = $row['id'];
	$_SESSION['name'] = $row['name'];
	$_SESSION['pennies_available'] = $row['pennies_available'];
	$_SESSION['last_logged_in'] = $row['last_logged_in'];
	$_SESSION['admin'] = $row['admin'];
	echo 'true';
	}
else {
	echo 'false';
}

?>