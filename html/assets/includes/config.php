<?php
  include("secret.php");
  // basic database connection
  $db_username = 'hackkings'; // MySQL username
  $db_password = $sec_db_password; // MySQL password, pull from secret.php so sensitive data won't be published.
  $db_hostname = 'localhost'; // MySQL host
  $db_name = 'hack'; // MySQL datbase name
  $db = mysqli_connect($db_hostname, $db_username, $db_password, $db_name) or die("{\"status\":0,\"content\":\"Failed to connect to database\"}"); // connect or error

  // google
  $client_id = '258775497785-n1gqf6u0q55et082h1roo46v6ci8c5up.apps.googleusercontent.com';
  $client_secret = $sec_client_secret;

  // site basics
  $conf_name = 'YEeTr';
  $conf_refresh = false;

  // basic function
  function isLoggedIn() {
    session_start();
    return validToken($_SESSION['sid']);
  }
  function validToken($t) {
    global $db;
    $token = $db->real_escape_string($t);
    $q = $db->query("SELECT * FROM sessions WHERE sid='$token' AND state=1");
    return mysqli_num_rows($q) > 0;
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
  function getUserBySID() {
    global $db;
    $user = array();
    $token = $db->real_escape_string($_SESSION['sid']);
    if (!isLoggedIn()) {
      return $user; // in theory, this should never be used
    }
    $session_rows = $db->query("SELECT * FROM sessions WHERE sid='$token'");
    $session_row = $session_rows->fetch_assoc();
    $uid = strval($session_row['uid']);
    $user_rows = $db->query("SELECT * FROM users WHERE uid='$uid'");
    $user_row = $user_rows->fetch_assoc();
    $user['pic'] = $user_row['pic'];
    $user['bio'] = $user_row['bio'];
    $user['name'] = $user_row['name'];
    $user['last'] = $user_row['last_seen'];
    $user['id'] = $uid;
    return $user;
  }
  function getUserByUID($id) {
    global $db;
    $user = array();
    if (!userExists($id)) {
      return $user; // in theory, this should never be used
    }
    $uid = $db->real_escape_string($id);
    $user_rows = $db->query("SELECT * FROM users WHERE uid='$uid'");
    $user_row = $user_rows->fetch_assoc();
    $user['pic'] = $user_row['pic'];
    $user['bio'] = $user_row['bio'];
    $user['name'] = $user_row['name'];
    $user['last'] = $user_row['last_seen'];
    $user['id'] = $uid;
    return $user;
  }
  function userExists($id) {
    global $db;
    $uid = $db->real_escape_string($id);
    $user_check = $db->query("SELECT * FROM users WHERE uid='$uid'");
    return mysqli_num_rows($user_check) > 0;
  }
  function follows($x, $y) {
    global $db;
    $u1 = $db->real_escape_string($x);
    $u2 = $db->real_escape_string($y);
    $follow_check = $db->query("SELECT * FROM follows WHERE user1='$u1' AND user2='$u2'") or die("{\"status\":0,\"content\":\"Following failed\"}");
    return mysqli_num_rows($follow_check) > 0;
  }
?>