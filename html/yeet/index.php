<?php
  include("../assets/includes/config.php");
  if (!isLoggedIn()) {
    header('Location: http://yeetr.me/');
    die();
  }
  $user = getUserBySID();
?>

<head>
    <title>Send a Yeet - <?php echo $conf_name; ?></title>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">

</head>

<body>

    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <img src="<?php echo $user['pic']; ?>">
    <b><?php echo $user['name']; ?></b>
    <h1> Handle </h1>
    
    <textarea placeholder="Type to Yeet!" id="yeetInput" rows="10" cols="80"></textarea>
    <p></p>
    <button type="button" onclick="submitYeet()">YEET!</button>

    <script>
        function submitYeet() {
            var textInput = document.getElementById("yeetInput").value;
            
            console.log(textInput);
        }
    </script>

</body>