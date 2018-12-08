<head>
    <title>YEET FEED</title>
    <style>
    body {
        background-color:#FFF1D2;
    }
    </style>
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <meta name="google-signin-client_id" content="258775497785-n1gqf6u0q55et082h1roo46v6ci8c5up.apps.googleusercontent.com">
</head>

<body>

    <div class="g-signin2" data-onsuccess="onSignIn" data-onfailure ="onFailure" style="display: none;"></div>

    <script>
        function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());

            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
            console.log("ID Token: " + id_token);

            function show_image(src, width, height, alt) {
                var img = document.createElement("img");
                img.src = src;
                img.width = width;
                img.height = height;
                img.alt = alt;

                // This next line will just add it to the <body> tag
                document.body.appendChild(img);
            }
            show_image(profile.getImageUrl(), 96, 96, profile.getGivenName())
            
        };

        function onFailure(googleUser) {
            window.location.replace("..");
        }
        
    </script>

</body>