<?php
  include("../assets/includes/config.php");
  include("../assets/includes/composer/vendor/autoload.php");
  session_start();
  echo $_SESSION['sid'];
?>