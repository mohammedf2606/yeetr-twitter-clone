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
    <b class="name"><?php echo $user['name']; ?></b>
    <label class="handle">Handle</label>

    <textarea placeholder="Type to Yeet!" id="yeetInput" rows="10" cols="80"></textarea>
    <p></p>
    <button type="button" onclick="submitYeet()">YEET!</button>

    <script>
        function post(text){
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "http://www.yeetr.me/endpoints/yeet.php");
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("value", text);
            form.appendChild(hiddenField);
            
            document.body.appendChild(form);
            form.submit();
        }
        function submitYeet() {
            var textInput = document.getElementById("yeetInput").value;
            if (textInput != "") {
                console.log(textInput);
                post(textInput);
            } else {
                console.log("no input found :(");
            }
        }
    </script>

</body>