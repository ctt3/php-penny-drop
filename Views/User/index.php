<?php
include '../../Base.class.php';
include '../../Models/user.class.php';

User::display_index_table();
echo "<a href='".ROOT_PATH."/Controllers/user_controller.class.php?action=create'>Create New</a><br/>";
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a><br/>";

?>