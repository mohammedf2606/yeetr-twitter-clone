<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    die("{\"status\":0,\"content\":\"Not authorised\"}");
  }
  $user = getUserBySID();
  $uid = $user['id'];
  $db->query("UPDATE sessions SET state=2 WHERE uid='$uid' AND state=1") or die("{\"status\":0,\"content\":\"Session deletion failed\"}");
  session_destroy();
  die("{\"status\":1,\"content\":\"Session deleted\"}");
?>