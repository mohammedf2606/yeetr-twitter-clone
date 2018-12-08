<?php
  include("../assets/includes/config.php");
  if (isset($_GET['target'])) {
    if (!isLoggedIn()) {
      die("{\"status\":0,\"content\":\"Not authorised\"}");
    }
    $user = getUserBySID();
    $uid = $user['id'];
    $tid = $db->real_escape_string($_GET['target']);
    if ($uid == $tid) {
      die("{\"status\":0,\"content\":\"You can't follow yourself\"}");
    }
    $timestamp = strval(time());
    $db->query("UPDATE users SET last_seen=$timestamp WHERE uid='$uid'") or die("{\"status\":0,\"content\":\"Following failed0\"}");
    $user_check = $db->query("SELECT * FROM users WHERE uid='$tid'") or die("{\"status\":0,\"content\":\"Following failed1\"}");
    if (mysqli_num_rows($user_check) == 0) {
      die("{\"status\":0,\"content\":\"Invalid target\"}");
    } else {
      $follow_check = $db->query("SELECT * FROM follows WHERE user1='$uid' AND user2='$tid'") or die("{\"status\":0,\"content\":\"Following failed2\"}");
      if (mysqli_num_rows($follow_check) == 0) {
        $db->query("INSERT INTO follows (user1, user2) VALUES ('$uid', '$tid')") or die("{\"status\":0,\"content\":\"Following failed\"}");
        die("{\"status\":1,\"content\":\"Followed\"}");
      } else {
        $follow = $follow_check->fetch_assoc();
        $fid = $follow['fid'];
        $db->query("DELETE FROM follows WHERE fid='$fid'") or die("{\"status\":0,\"content\":\"Following failed\"}");
        die("{\"status\":1,\"content\":\"Unfollowed\"}");
      }
    }
  } else {
    die("{\"status\":0,\"content\":\"No target specified\"}");
  }
?>