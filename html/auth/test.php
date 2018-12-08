<?php
  include("../assets/includes/config.php");
  include("../assets/includes/composer/vendor/autoload.php");
  echo $_SESSION['sid'];
  echo isLoggedIn();
?>