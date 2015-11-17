<?php
include '../../Base.class.php';
include '../../Models/payment.class.php';

Payment::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>