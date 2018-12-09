<?php
  include("../assets/includes/config.php");
  $accounts = array();
  if (!isset($_GET['s'])) {
    header('Location: http://yeetr.me/feed/');
    die();
  } else {
    $search = "%".strtolower($db->real_escape_string(urldecode($_GET['s'])))."%";
    echo $search;
    if (strlen($search) == 0) {
      header('Location: http://yeetr.me/feed/');
      die();
    } else {
      $results = $db->query("SELECT * FROM users WHERE LOWER(name) LIKE '$search'");
      while ($user = $results->fetch_assoc()) {
        $u = array();
        $u['id'] = $user['uid'];
        $u['bio'] = $user['bio'];
        $u['pic'] = $user['pic'];
        $u['name'] = $user['name'];
        array_push($accounts, $u);
      }
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
    <a href="http://yeetr.me/feed"><img src="/assets/img/logo.gif" alt="YEET"></a><!-- Source: cooltext -->
    <div class="rfloat">
      Search:
      <br>
      <input id="search" type="text" placeholder="Search users" size=100>
      <button onclick="notsearch()"> Search! </button>
    </div>
    <center>
      <a href="http://yeetr.me/yeet/"><button> New Yeet :) </button></a>
      <a href="http://yeetr.me/u/"+ <?php echo $user[id] ?>><button style="float:right;"> Profile </button></a>
    </center>
    <br>
    <script>
      function notsearch() {
        window.location = "http://yeetr.me/search/" + encodeURI($('#search').val());
      }
    </script>
    <table border="1px" width="100%" id="yeets">
<?php
  foreach ($accounts as $account) {
    $yeetHtml = "<tr><td width=\"96px\">";
    $yeetHtml .= "<a href=\"http://yeetr.me/u/". $account['id'] . "\"><img style=\"vertical-align:top\" src=\"" . $account['pic'] . "\"></a></td>";
    $yeetHtml .= "<td width=\"20%\"><a href=\"http://yeetr.me/u/" . $account['id'] . "\"><b class=\"name\">" . $account['name'] . "</b></a><br>";
    $yeetHtml .= "<label class=\"handle\">" . $account['id'] . "</label><br>";
    $yeetHtml .= "<label class=\"yeet\">" . $account['bio'] . "</label></td></tr>";
  }
?>
    </table>
  </body>
</html>
