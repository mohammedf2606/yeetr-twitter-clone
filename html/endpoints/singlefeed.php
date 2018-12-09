<?php
  include("../assets/includes/config.php");
  if (!isset($_GET['user'])) {
    die("{\"status\":0,\"content\":\"No user specified\"}");
  }
  $uid = $db->real_escape_string($_GET['user']);
  if (!userExists($uid)) {
    die("{\"status\":0,\"content\":\"User doesn't exist\"}");
  }
  $user_cache = array();
  $yeets = $db->query("SELECT * FROM yeets WHERE uid='$uid'") or die("{\"status\":0,\"content\":\"Failed to fetch yeets\"}");
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
      $new_yeeter['name'] = $yeeter['name'];
      $user_cache[$id] = $new_yeeter;
    }
    $new_yeet['user'] = $user_cache[$id]; // we could use the user profile here too?
    $new_yeet['time'] = $time - intval($yeet['time']);
    $new_yeet['body'] = $yeet['body'];
    array_push($body['content'], $new_yeet);
  }
  die(json_encode($body));
?>