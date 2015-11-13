<?php
include './classes/user.class.php';

$charles = new User("5");
echo "id: " . $charles->id . "<br/>";
echo "name: " . $charles->name . "<br/>";
echo "username: " . $charles->username . "<br/>";
echo "password: " . $charles->password . "<br/>";
?>