<?php

class User extends ModelRecord{

  public static function display_create_form(){
    echo "<form action='../../Controllers/user_controller.class.php?action=save' method='post'>";
    echo "Name: <input type='text' name='name' /><br />";
    echo "Username: <input type='text' name='username' /><br />";
    echo "Password: <input type='password' name='password' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    echo "<form action='../../Controllers/user_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
    echo "Name: <input type='text' name='name' value=".$this->name." /><br />";
    echo "Username: <input type='text' name='username' value=".$this->username." /><br />";
    echo "Password: <input type='password' name='password' value=".$this->password." /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function donations(){
    include_once 'donation.class.php';
    return $this->get_dependents('donation');
  }

  public function surveys(){
    include_once 'user_survey.class.php';
    return $this->get_dependents('user_survey');
  }
}

?>