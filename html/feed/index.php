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
    <a href="http://yeetr.me/feed"><img src="/assets/img/logo.gif" alt="YEET"></a><!-- Source: cooltext -->
    <form>
      Search:<br>
      <input type="text"  name="search" placeholder="Search users" size=100>      
      <button id = "search" onclick="search()"> Search! </button>
    </form>
    <center>
      <button id="newYeet" onclick="goToYeet()"> New Yeet :) </button>
    </center>
    <script>
      function search() {
        console.log("Searching" + );
      }
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
          url: "../endpoints/feed.php",
          data: "",
          success: function(data) {
            var obj = JSON.parse(data);
            if (obj.status == 1) {
              $("#yeets tr").remove();
              $.each(obj.content, function(index, value) {
                var yeetHtml = "<tr><td width=\"96px\">";
                yeetHtml += "<a href=\"http://www.yeetr.me/u/"+ value.user.id +"\"><img style=\"vertical-align:top\" src=\"" + value.user.pic + "\"></a></td>";
                yeetHtml += "<td width=\"20%\"><a href=\"http://www.yeetr.me/u/"+ value.user.id +"\"><b class=\"name\">" + value.user.name + "</b></a><br>";
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
