<?php
include '../../Base.class.php';
include '../../Models/user_survey.class.php';

UserSurvey::display_index_table();
echo "<a href='".ROOT_PATH."/Views/reports.php'>Reports</a>"

?>