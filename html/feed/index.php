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
    <title>Feed - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <center>
      <button id="newYeet" onclick="goToYeet()"> New Yeet :) </button>
    </center>
    <script>
      function goToYeet() {
        window.location.replace("../yeet");
      }
      function loadYeets() {
        $.ajax({
          type: "GET",
          url: "../endpoints/feed.php",
          data: "",
          success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status == 1) {
              $("#yeets tr").remove();
              $.each(obj.content.posts, function(index, value) {
                var yeetHtml = "<tr><td width=\"96px\">";
                yeetHtml += "<img style=\"vertical-align:top\" src=\"<?php echo value.user.pic; ?>\"></td>";
                yeetHtml += "<td width=\"20%\"><b class=\"name\"><?php echo value.user.name; ?></b><br>";
                yeetHtml += "<label class=\"handle\"><?php echo value.user.id; ?></label>";
                yeetHtml += "<label class=\"time\"><?php echo "Posted ".strval(value.user.time)." seconds ago"; ?></label></td><td>";
                yeetHtml += "<label class=\"yeet\"> <?php echo value.body; ?></label></td></tr>";
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
