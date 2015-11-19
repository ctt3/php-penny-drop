<?php

class Charity extends ModelRecord{

  public static function display_create_form(){
    echo "<form action='../../Controllers/charity_controller.class.php?action=save' method='post'>";
    echo "Name: <input type='text' name='name' /><br />";
    echo "Description: <textarea name='description'></textarea><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    echo "<form action='../../Controllers/charity_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
    echo "Name: <input type='text' name='name' value=".$this->name." /><br />";
    echo "Description: <textarea name='description'>".$this->description."</textarea><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function donations(){
    include_once 'donation.class.php';
    return $this->get_dependents('donation');
  }
}

?>