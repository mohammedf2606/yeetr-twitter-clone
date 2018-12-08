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
    <p id = "feed">
        <div>
            <img style="vertical-align:top" src="<?php echo $user['pic']; ?>">
            <b class = "name"><?php echo $user['name']; ?></b>
            <label class = "handle"> Handle </label>
            <label class = "seperator"> . </label>
            <label class = "time"> Time </label>
        </div>
        <label class = "yeet"> Yeet </label></p>
    <script>
        var timeSent = 0;
        var currentTime = 0;
        var timeSince = currentTime - timeSent;
        // for each (var yeet in listOfYeets) {
        //     document.getElementById('feed').write(
        //         <div>
        //             <img style="vertical-align:top" src=" <?php echo $user['pic']; ?>">
        //             <b class = "name"><?php echo $user['name']; ?></b>
        //             <label class = "handle"> Handle </label>
        //         </div>
        //     <label class = "yeet"> Yeet </label>);
        // }
    </script>
  </body>
</html>
