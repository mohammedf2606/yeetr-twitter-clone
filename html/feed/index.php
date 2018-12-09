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
  </head>
  <body>
    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <center>
        <button id = "newYeet" onclick = "goToYeet()"> New Yeet :) </button>
    </center>
    <script>
        function goToYeet() {
            window.location.replace("../yeet");
        }
    </script>
    <p id = "feed">
        <table border="1px" width="100%">
          <tr>
            <td width="96px">
              <img style="vertical-align:top" src="<?php echo $user['pic']; ?>">
            </td>
            <td width="20%">
              <b class = "name"><?php echo $user['name']; ?></b>
              <br>
              <label class = "handle"> Handle </label>
              <label class = "time"> Time </label>
            </td>
            <td>
              <label class ="yeet"> Yeet </label>
            </td>
          </tr>
        </table>
  </body>
</html>
