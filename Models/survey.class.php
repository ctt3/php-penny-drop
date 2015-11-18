<?php

class Survey extends ModelRecord{

  public static function display_create_form(){
    echo "<form action='../../Controllers/survey_controller.class.php?action=save' method='post'>";
    echo "Name: <input type='text' name='name' /><br />";
    echo "Description: <textarea name='description' rows='10' columns='30'></textarea><br />";
    echo "Number of Surveys Available: <input type='text' name='available_surveys' /><br />";
    echo "Amount Earnable per Survey: <input type='text' name='amount_earnable' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    echo "<form action='../../Controllers/survey_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
    echo "Name: <input type='text' name='name' value=".$this->name." /><br />";
    echo "Description: <textarea name='description' rows='10' columns='30'>".$this->description."</textarea><br />";
    echo "Number of Surveys Available: <input type='text' name='available_surveys' value=".$this->available_surveys." /><br />";
    echo "Amount Earnable per Survey: <input type='text' name='amount_earnable' value=".$this->amount_earnable." /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }
}

?>