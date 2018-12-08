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
  $conf_name = 'Yeetr';
  $conf_refresh = false;

  // basic function
  function validToken($t) {
    global $db
    $token = $db->real_escape_string($t);
    $q = $db->query("SELECT * FROM sessions WHERE sid='$token' AND status=1");
    return mysqli_num_rows($q) > 0;
  }
?>