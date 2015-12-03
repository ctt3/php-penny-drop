<?php
session_start();

if (is_null($_SESSION["user_id"])) {
  echo '<button id="log_in" class="btn btn-primary" onclick="load_modal(\'/assets/layouts/login_modal.php\')">Login</button>';
}else {
  echo '<button id="log_out" class="btn btn-warning" onclick="logout()">Logout</button>';
}

?>