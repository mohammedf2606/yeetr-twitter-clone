<?php
  include("../assets/includes/config.php");
  include("../assets/includes/composer/vendor/autoload.php");
  session_start();
  if (isset($_POST['token'])) {
    $token = $_POST['token'];
    $client = new Google_Client(['client_id' => $client_id]);  // Specify the CLIENT_ID of the app that accesses the backend
    $payload = $client->verifyIdToken($token);
    if ($payload) {
      // now we know the token is valid, we can start getting information from it
      $user_id = strval($payload['sub']);
      $timestamp = strval(time());
      $pp = $db->real_escape_string(strval($payload['picture']));
      if (!userExists($user_id)) {
        $name = $db->real_escape_string(strval($payload['name']));
        $db->query("INSERT INTO users (uid, name, bio, web, reg, last_seen, pic) VALUES ('$user_id', '$name', 'I\'m new to Yeetr!', '', $timestamp, $timestamp, '$pp')") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      } else {
        $db->query("UPDATE users SET last_seen=$timestamp, pic='$pp' WHERE uid='$user_id'") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
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
      $db->query("INSERT INTO sessions (sid, time, uid, state) VALUES ('$sid', $timestamp, '$user_id', 1)") or die("{\"status\":0,\"content\":\"Session creation failed\"}");
      $_SESSION['sid'] = $sid;
      die("{\"status\":1,\"content\":\"Session created\"}");
    } else {
      die("{\"status\":0,\"content\":\"Token invalid\"}");
    }
  } else {
    die("{\"status\":0,\"content\":\"Token not found\"}");
  }
?>