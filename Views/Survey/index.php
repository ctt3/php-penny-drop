<?php
include '../../Base.class.php';
include '../../Models/survey.class.php';

Survey::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>