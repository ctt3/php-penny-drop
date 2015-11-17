<?php
include '../../Base.class.php';
include '../../Models/charity.class.php';

Charity::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>