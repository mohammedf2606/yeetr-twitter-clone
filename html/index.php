<?php
  include("assets/includes/config.php");

  if (isLoggedIn()) {
    header('Location: http://yeetr.me/feed');
    die();
  }
?>
 <html>
  <head>
    <title>Home - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="<?php echo $client_id; ?>">
  </head>
  <body>
    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <div class="g-signin2" data-onsuccess="onSignIn"></div> <!-- Login button -->
    <script>
      function onSignIn(googleUser) {
        var xhr = new XMLHttpRequest();
        var id_token = googleUser.getAuthResponse().id_token;
        xhr.open('POST', 'http://yeetr.me/auth/');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('token=' + id_token);
        xhr.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            location.reload(true);
          }
        };


      };
    </script>
  </body>
</html>