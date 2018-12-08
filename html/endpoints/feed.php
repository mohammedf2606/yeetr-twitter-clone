<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    die("{\"status\":0,\"content\":\"Not authorised\"}");
  }
  $user = getUserBySID();
  $uid = $user['id'];
  $follows = $db->query("SELECT * FROM follows WHERE user1='$uid'") or die("{\"status\":0,\"content\":\"Failed to fetch following\"}");
  $following = array();
  array_push($uid);
  while ($follow = $follows->fetch_assoc()) {
    array_push($following, strval($follow['user2']));
  }
  $query = "('".implode("','", $following)."')";
  $yeets = $db->query("SELECT * FROM yeets WHERE uid IN $query ORDER BY time DESC") or die("{\"status\":0,\"content\":\"Failed to fetch yeets\"}");
  $body = array();
  $body['status'] = 1;
  $body['content'] = array();
  $time = time();
  while ($yeet = $yeets->fetch_assoc()) {
    $new_yeet = array();
    $new_yeet['id'] = $yeet['yid'];
    $new_yeet['user'] = $yeet['uid']; // we could use the user profile here too?
    $new_yeet['time'] = $time - intval($yeet['time']);
    $new_yeet['body'] = $yeet['body'];
    array_push($body['content'], $new_yeet);
  }
  die(json_encode($body));
?>