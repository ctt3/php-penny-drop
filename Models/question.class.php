<?php

class Question extends ModelRecord{
  public static function display_create_form(){
    echo "<form action='../../Controllers/question_controller.class.php?action=save' method='post'>";
  	echo "Survey ID: <input type='text' name='surveyid' /><br />";
    echo "Question: <textarea name='question'></textarea><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    echo "<form action='../../Controllers/question_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
  	echo "Survey ID: <input type='text' name='surveyid' value='".$this->surveyid."' /><br />";
    echo "Question: <textarea name='question'>".$this->question."</textarea><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function responses(){
    include_once 'response.class.php';
    return $this->get_dependents('response');
  }
}
?>