<?php

class Response extends ModelRecord{

  public static function display_create_form(){
    // displays html form with blank fields
    echo "<form action='../../Controllers/response_controller.class.php?action=save' method='post'>";
    echo "User Survey ID: <input type='text' name='user_surveyid' /><br />";
    echo "Question ID: <input type='text' name='questionid' /><br />";
    echo "Response: <textarea name='response'></textarea><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    // displays html form with field values from object
    echo "<form action='../../Controllers/response_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
    echo "User Survey ID: <input type='text' name='user_surveyid' value='".$this->surveyid."' /><br />";
    echo "Question ID: <input type='text' name='questionid' value='".$this->questionid."' /><br />";
    echo "Response: <textarea name='response'>".$this->response."</textarea><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

}

?>