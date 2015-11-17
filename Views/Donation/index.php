<?php
include '../../Base.class.php';
include '../../Models/donation.class.php';

Donation::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>