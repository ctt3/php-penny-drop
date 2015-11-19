<?php

class Donation extends ModelRecord{
  public static function display_create_form(){
    // displays html form with blank fields
    echo "<form action='../../Controllers/donation_controller.class.php?action=save' method='post'>";
  	echo "User ID: <input type='text' name='userid' /><br />";
  	echo "Charity ID: <input type='text' name='charityid' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' /><br />";
  	echo "Amount Payable: <input type='text' name='amount' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    // displays html form with field values from object
    echo "<form action='../../Controllers/donation_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
  	echo "User ID: <input type='text' name='userid' value='".$this->userid."' /><br />";
  	echo "Charity ID: <input type='text' name='charityid' value='".$this->charityid."' /><br />";
  	echo "Survey ID: <input type='text' name='surveyid' value='".$this->surveyid."' /><br />";
  	echo "Amount Payable: <input type='text' name='amount' value='".$this->amount."' /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }

  public function payments(){
    // returns payment objects related to this donation object
    include_once 'payment.class.php';
    return $this->get_dependents('payment');
  }
}

?>