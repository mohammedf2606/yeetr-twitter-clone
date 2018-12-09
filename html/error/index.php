<?php
  include("../assets/includes/config.php");
?>
<html>
  <head>
    <title>Error - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <h1>page not found!</h1>
    <a href="../">Click here to return to the homepage</a>
  </body>
</html>
