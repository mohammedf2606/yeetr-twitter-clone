<?php
  include("assets/includes/config.php");
  if (!isLoggedIn()) {
    header('Location: http://yeetr.me/');
    die();
  }
?>
 <html>
  <head>
    <title>Feed - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="<?php echo $client_id; ?>">
  </head>
  <body>
    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <img src="">
    <b> Full Name </b>
    <h1> Handle </h1>
    <script>
        var timeSent = 0;
        var currentTime = 0;
        var timeSince = currentTime - timeSent;
    </script>
  </body>
</html>
