<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    die("{\"status\":0,\"content\":\"Not authorised\"}");
  }
  $user = getUserBySID();
  $uid = $user['id'];
  $follows = $db->query("SELECT * FROM follows WHERE user1='$uid'") or die("{\"status\":0,\"content\":\"Failed to fetch following\"}");
  $following = array();
  array_push($following, $uid);
  while ($follow = $follows->fetch_assoc()) {
    array_push($following, strval($follow['user2']));
  }
  $user_cache = array();
  $query = "('".implode("','", $following)."')";
  $yeets = $db->query("SELECT * FROM yeets WHERE uid IN $query ORDER BY time DESC") or die("{\"status\":0,\"content\":\"Failed to fetch yeets\"}");
  $body = array();
  $body['status'] = 1;
  $body['content'] = array();
  $time = time();
  while ($yeet = $yeets->fetch_assoc()) {
    $new_yeet = array();
    $new_yeet['id'] = $yeet['yid'];
    $id = $yeet['uid'];
    if (!array_key_exists($id, $user_cache)) {
      $yeeters = $db->query("SELECT * FROM users WHERE uid='$id'");
      $yeeter = $yeeters->fetch_assoc();
      $new_yeeter = array();
      $new_yeeter['id'] = $id;
      $new_yeeter['pic'] = $yeeter['pic'];
      $new_yeeter['name'] = htmlspecialchars($yeeter['name']);
      $user_cache[$id] = $new_yeeter;
    }
    $new_yeet['user'] = $user_cache[$id]; // we could use the user profile here too?
    $new_yeet['time'] = $time - intval($yeet['time']);
    $new_yeet['body'] = htmlspecialchars($yeet['body']);
    array_push($body['content'], $new_yeet);
  }
  die(json_encode($body));
?>