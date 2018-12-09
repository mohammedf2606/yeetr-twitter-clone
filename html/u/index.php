<?php
  include("../assets/includes/config.php");
  $load = '';
  $authed = isLoggedIn();
  if (isset($_GET['u'])) {
    if (userExists($_GET['u'])) {
      $load = $db->real_escape_string($_GET['u']);
    } else {
      header('Location: http://yeetr.me/error/');
      die();
    }
  } else {
    if ($authed) {
      $user = getUserBySID();
      header('Location: http://yeetr.me/u/'.$user['id']);
      die();
    } else {
      header('Location: http://yeetr.me/error/');
      die();
    }
  }
?>
<html>
  <head>
    <title>Feed - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <a href="http://yeetr.me/feed"><img src="/assets/img/logo.gif" alt="YEET"></a> <!-- Source: cooltext -->
    <center>
      <button id="newYeet" onclick="goToYeet()"> New Yeet :) </button>
    </center>
    <p></p>

    <script>

      console.log("hello" + "<?php echo $user['bio']; ?>");

      function goToYeet() {
        window.location.replace("../yeet");
      }
      $(function() {
        loadYeets();
      });
      setInterval(function() {
        loadYeets();
	  }, 2000);
      function loadYeets() {
        $.ajax({
          type: "GET",
          url: "../endpoints/singlefeed.php",
          data: "user=<?php echo $load; ?>",
          success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status == 1) {
              $("#yeets tr").remove();
              $.each(obj.content, function(index, value) {
                var yeetHtml = "<tr><td width=\"96px\">";
                yeetHtml += "<img style=\"vertical-align:top\" src=\"" + value.user.pic + "\"></td>";
                yeetHtml += "<td width=\"20%\"><b class=\"name\">" + value.user.name + "</b><br>";
                yeetHtml += "<label class=\"handle\">" + value.user.id + "</label><br>";
                yeetHtml += "<label class=\"time\">Posted " + value.time + " seconds ago</label></td><td>";
                yeetHtml += "<label class=\"yeet\">" + value.body + "</label></td></tr>";
                $("#yeets").append(yeetHtml);
              });
            }
          }
        });
      }
    </script>
    <table border="1px" width="100%" id="yeets">
    </table>
  </body>
</html>
