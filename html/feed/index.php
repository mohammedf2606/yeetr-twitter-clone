<head>
    <title>YEET FEED</title>
    <style>
    body {
        background-color:#FFF1D2;
    }
    </style>
    <meta name="google-signin-scope" content="profile email">
    <script src="https://apis.google.com/js/platform.js?onload=init" async defer>
    
        function init() {
            gapi.load('auth2', function() { // Ready. });
        }

    </script>
    <meta name="google-signin-client_id" content="258775497785-n1gqf6u0q55et082h1roo46v6ci8c5up.apps.googleusercontent.com">
</head>

<body>

    <script>
        gapi.auth2.init()
        if (auth2.isSignedIn.get()) {
            var profile = auth2.currentUser.get().getBasicProfile();
            console.log('ID: ' + profile.getId());
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log('Image URL: ' + profile.getImageUrl());
            console.log('Email: ' + profile.getEmail());
        } else {
            console.log('Fail');
        }
        
    </script>

</body>