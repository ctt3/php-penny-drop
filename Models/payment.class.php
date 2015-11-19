<?php

class Payment extends ModelRecord{
  public static function display_create_form(){
    // displays html form with blank fields
    echo "<form action='../../Controllers/payment_controller.class.php?action=save' method='post'>";
    echo "Donation ID: <input type='text' name='donationid' /><br />";
    echo "Amount Payable: <input type='text' name='amount' /><br />";
    echo "<input type='submit' value='Save' />";
    echo "</form>";
  }

  public function display_edit_form(){
    // displays html form with field values from object
    echo "<form action='../../Controllers/payment_controller.class.php?action=update' method='post'>";
    echo "<input type='hidden' name='id' value=".$this->id." />";
    echo "Donation ID: <input type='text' name='donationid' value='".$this->donationid."' /><br />";
    echo "Amount Payable: <input type='text' name='amount' value='".$this->amount."' /><br />";
    echo "<input type='submit' value='Update' />";
    echo "</form>";
  }
}

?>