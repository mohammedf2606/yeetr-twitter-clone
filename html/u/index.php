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
  $follows = false;
  $user = getUserByUID($load);
  $currentUser = "";
  if ($authed) {
    $u = getUserBySID();
    $currentUser = $u['id'];
    $follows = follows($currentUser, $load);
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
      <a href="http://yeetr.me/yeet/"><button id="newYeet"> New Yeet :) </button></a>
    </center>
    <p></p>

    <script>
      $(function() {
        loadYeets();
      });
      setInterval(function() {
        loadYeets();
      }, 2000);
      function fToggle(caller) {
        $.ajax({
          type: "GET",
          url: "../endpoints/follow.php",
          data: "target=<?php echo $load; ?>",
          success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status == 1) {
              if (obj.content == "Followed") {
                caller.html = "Unfollow";
              } else {
                caller.html = "Follow";
              }
            }
          }
        });
      }
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
    <table width="100%">
      <tr>
        <td valign="top" width="15%">
          <img width="100%" src="<?php echo $user['pic']; ?>">
          <br>
          <h3><?php echo $user['name']; ?></h3>
          <br>
          <em><?php echo $user['bio']?></em>
<?php
  if ($currentUser == $load) {
?>
          
<?php
  } else if ($authed) {
?>
          <button id="follow" onclick="fToggle(this)"><?php if ($follows) { echo "Unfollow"; } else { echo "Follow"; } ?></button>
<?php
  }
?>
        </td>
        <td valign="top">
          <table border="1px" width="100%" id="yeets">
          </table>
        </td>
      </tr>
    </table>
  </body>
</html>
