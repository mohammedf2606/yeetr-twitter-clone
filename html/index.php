<head>
    <title>YEET</title>
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

    <img src="/assets/img/logo.gif" alt="YEET"> <!-- Source: cooltext -->

<!--
<a href="https://google.com"><img src="logo1.gif" alt="YEET"></a>
-->
    <div class="g-signin2" data-onsuccess="onSignIn"></div> <!-- Login button -->

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
            window.location.replace("/feed");
        };
        
    </script>

</body>
