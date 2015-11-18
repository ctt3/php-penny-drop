<?php
include '../../Base.class.php';
include '../../Models/user.class.php';

User::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a><br/>";

?>