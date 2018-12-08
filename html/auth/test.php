<?php
  include("../assets/includes/config.php");
  session_start();
  echo $_SESSION['sid'];
  $token = $db->real_escape_string($_SESSION['sid']);
  $q = $db->query("SELECT * FROM sessions WHERE sid='$token' AND status=1");
  echo $q;
  echo mysqli_num_rows($q) > 0;
?>