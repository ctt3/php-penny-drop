<?php

class UserSurvey extends ModelRecord{
  public static function display_create_form(){
    echo "<form action='../../Controllers/user_survey_controller.class.php?action=save' method='post'>";
  	echo "User ID: <input type='text' name='userid' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' /><br />";
  	echo "Completion Date: <input type='text' name='completion_date' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    echo "<form action='../../Controllers/user_survey_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
  	echo "User ID: <input type='text' name='userid' value='".$this->userid."' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' value='".$this->surveyid."' /><br />";
  	echo "Completion Date: <input type='text' name='completion_date' value='".$this->completion_date."' /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function responses(){
    include_once 'response.class.php';
    return $this->get_dependents('response');
  }
}

?>