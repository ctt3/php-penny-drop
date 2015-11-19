<?php

class UserSurvey extends ModelRecord{
  public static function display_create_form(){
    // displays html form with blank fields
    echo "<form action='../../Controllers/user_survey_controller.class.php?action=save' method='post'>";
  	echo "User ID: <input type='text' name='userid' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' /><br />";
  	echo "Completion Date: <input type='text' name='completion_date' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    // displays html form with field values from object
    echo "<form action='../../Controllers/user_survey_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
  	echo "User ID: <input type='text' name='userid' value='".$this->userid."' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' value='".$this->surveyid."' /><br />";
  	echo "Completion Date: <input type='text' name='completion_date' value='".$this->completion_date."' /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function responses(){
    // returns response objects related to this user_survey object
    include_once 'response.class.php';
    return $this->get_dependents('response');
  }
}

?>