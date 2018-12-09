<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    header('Location: http://yeetr.me/');
    die();
  }
  $user = getUserBySID();
?>
<html>
  <head>
    <title>Send a Yeet - <?php echo $conf_name; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
  </head>
  <body>
    <a href="http://yeetr.me/feed"><img src="/assets/img/logo.gif" alt="YEET"></a> <!-- Source: cooltext -->
    <p><img src="<?php echo $user['pic']; ?>"></p>
    <p><b class="name"><?php echo $user['name']; ?></b></p>
    <p></p>
    <textarea placeholder="Type to Yeet!" id="yeetInput" rows="10" cols="80"></textarea>
    <p></p>
    <button id="yeet" type="button" onclick="submitYeet()">YEET!</button>
    <a href="http://yeetr.me/yeet/"><button type="button">cancel :(</button></a>
    <script>
      function submitYeet() {
        document.getElementById("yeet").disabled = true;
        var textInput = $('#yeetInput').val();
        if (textInput != "") {
          $.ajax({
            type: "POST",
            url: "../endpoints/yeet.php",
            data: "body=" + escape(textInput),
            success: function(data) {
              alert('Yeeted this ;-)');
              window.location.replace("../feed");
            }
          });
        } else {
          alert("no input found :(");
        }
        document.getElementById("yeet").disabled = false;
      }
    </script>
  </body>
</html>