<?php
include './classes/included_classes.php';

$charles = User::find("39");
echo "id: " . $charles->id . "<br/>";
echo "name: " . $charles->name . "<br/>";
echo "username: " . $charles->username . "<br/>";
echo "password: " . $charles->password . "<br/>";
echo "pennies_available: " . $charles->pennies_available . "<br/>";
echo "<br/><br/><br/>";


$charles->update_attributes(["name" => "Beau Thiry", "username" => "ctt3"]);
echo "id: " . $charles->id . "<br/>";
echo "name: " . $charles->name . "<br/>";
echo "username: " . $charles->username . "<br/>";
echo "password: " . $charles->password . "<br/>";
echo "pennies_available: " . $charles->pennies_available . "<br/>";
echo "<br/><br/><br/>";

$charles = User::find("40");
echo "id: " . $charles->id . "<br/>";
echo "name: " . $charles->name . "<br/>";
echo "username: " . $charles->username . "<br/>";
echo "password: " . $charles->password . "<br/>";
echo "pennies_available: " . $charles->pennies_available . "<br/>";
echo "<br/><br/><br/>";

User::delete("39");
print_r(User::index());
?>