<?php
  include("../assets/includes/config.php");
  include("../assets/includes/composer/vendor/autoload.php");
  session_start();
  if (isset($_POST['token'])) {
    $token = $_POST['token'];
    $client = new Google_Client(['client_id' => $client_id]);  // Specify the CLIENT_ID of the app that accesses the backend
    $payload = $client->verifyIdToken($id_token);
    if ($payload) {
      // now we know the token is valid, we can start getting information from it
      $user_id = strval($payload['sub']);
      $user_check = $db->query("SELECT * FROM users WHERE uid='$user_id'");
      $timestamp = strval(time());
      if (mysqli_num_rows($user_check) == 0) {
        $name = $db->real_escape_string(strval($payload['name']));
        $db->query("INSERT INTO users (uid, name, bio, web, reg, last_seen) VALUES ('$user_id', '$name', 'I\'m new to Yeetr!', '', $timestamp, $timestamp)") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      } else {
        $db->query("UPDATE users SET last_seen=$timestamp WHERE uid='$user_id'") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      }
      $sid = '';
      while (true) {
        $sid = generateRandomString(32);
        $session_check = $db->query("SELECT * FROM sessions WHERE sid='$sid'") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
        if (mysqli_num_rows($session_check) == 0) {
          break;
        }
      }
      $db->query("UPDATE sessions SET state=2 WHERE uid='$user_id' AND state=1") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      $db->query("INSERT INTO sessions (sid, time, uid, state) VALUES ('$sid', $time, '$user_id', 1)") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      $_SESSION['sid'] = $sid;
      die("{\"status\":1,\"content\":\"Session created\"}");
    } else {
      die("{\"status\":0,\"content\":\"Token invalid\"}");
    }
  } else {
    die("{\"status\":0,\"content\":\"Token not found\"}");
  }
  function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }
?>