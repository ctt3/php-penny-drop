<?php
include '../../Base.class.php';
include '../../Models/question.class.php';

Question::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>