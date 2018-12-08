<?php
  include("../assets/includes/config.php");
  if (isset($_POST['body'])) {
    if (!isLoggedIn()) {
      die("{\"status\":0,\"content\":\"Not authorised\"}");
    }
    $user = getUserBySID();
    $uid = $user['id'];
    $body = $db->real_escape_string($_POST['body']);
    if (strlen($body) > 0) {
      $yid = '';
      while (true) {
        $yid = generateRandomString(16);
        $yeet_check = $db->query("SELECT * FROM yeets WHERE yid='$yid'") or die("{\"status\":0,\"content\":\"Yeeting failed\"}");
        if (mysqli_num_rows($yeet_check) == 0) {
          break;
        }
      }
      $timestamp = strval(time());
      $db->query("UPDATE users SET last_seen=$timestamp WHERE uid='$uid'") or die("{\"status\":0,\"content\":\"Yeeting failed\"}");
      $db->query("INSERT INTO yeets (yid, uid, time, body) VALUES ('$yid', '$uid', $timestamp, '$body')") or die("{\"status\":0,\"content\":\"Yeeting failed\"}");
      die("{\"status\":1,\"content\":\"$yid\"}");
    } else {
      die("{\"status\":0,\"content\":\"Empty content\"}");
    }
  } else {
    die("{\"status\":0,\"content\":\"Empty content\"}");
  }
?>