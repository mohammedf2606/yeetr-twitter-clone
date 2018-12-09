<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    die("{\"status\":0,\"content\":\"Not authorised\"}");
  }
  $user = getUserBySID();
  $uid = $user['id'];
  if (isset($_POST['name']) && isset($_POST['bio'])) {
    $n = $db->real_escape_string($_POST['name']);
    $b = $db->real_escape_string($_POST['bio']);
    if (strlen($n) > 32 || strlen($b) > 512) {
      die("{\"status\":0,\"content\":\"Names must be under 32 characters, and bios must be under 512!\"}");
    }
    $db->query("UPDATE users SET bio='$b', name='$n' WHERE uid='$uid'") or die("{\"status\":0,\"content\":\"Failed to update profile\"}");
    die("{\"status\":1,\"content\":\"Updated\"}");
  } else {
    die("{\"status\":0,\"content\":\"Both fields must be filled\"}");
  }
?>