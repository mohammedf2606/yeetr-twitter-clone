<head>
    <title>YEET FEED</title>
    <style>
    body {
        background-color:#FFF1D2;
    }
    </style>
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js">
    
        function init() {
            gapi.load('auth2', function() { // Ready. });
        }

    </script>
    <meta name="google-signin-client_id" content="258775497785-n1gqf6u0q55et082h1roo46v6ci8c5up.apps.googleusercontent.com">
</head>

<body>
    <a href="www.yeetr.com/feed"><img src="../assets/img/logo.gif" alt="YEET"></a>
    <p></p>

    <script>
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
            client_id: '258775497785-n1gqf6u0q55et082h1roo46v6ci8c5up.apps.googleusercontent.com',
            //fetch_basic_profile: false,
            //scope: 'profile'
        });
        

        function show_image(src, width, height, alt) {
            var img = document.createElement("img");
            img.src = src;
            img.width = width;
            img.height = height;
            img.alt = alt;
            // This next line will just add it to the <body> tag
            document.body.appendChild(img);
        }


        // Sign the user in, and then retrieve their ID.
        auth2.signIn().then(function() {
            var user = auth2.currentUser.get()
            console.log(user);
            console.log(user.getId());
            show_image(user.w3.Paa, 96, 96, "Profile photo");
        });
    });
    </script>

</body>