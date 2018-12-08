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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../assets/css/master.css<?php if ($conf_refresh) { echo "?t=".strval(time()); } ?>">

</head>

<body>

    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->
    <img src="<?php echo $user['pic']; ?>">
    <b class="name"><?php echo $user['name']; ?></b>
    <label class="handle">Handle</label>

    <textarea placeholder="Type to Yeet!" id="yeetInput" rows="10" cols="80"></textarea>
    <p></p>
    <button type="button" onclick="submitYeet">YEET!</button>

    <script>

        function submitYeet() {
            var textInput = $('#yeetInput').val();
            if (textInput != "") {
                console.log(textInput);
                $.ajax({
                type: "POST",
                url: "../endpoints/yeet.php",
                data: "body=" + escape(textInput),
                success: function(data) {
                    close()  
                }
            });
            } else {
                console.log("no input found :(");
            }
        }
    </script>

</body>