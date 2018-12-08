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

    <script>
        gapi.load('auth2', function() {
            auth2 = gapi.auth2.init({
            client_id: 'CLIENT_ID.apps.googleusercontent.com',
            fetch_basic_profile: false,
            scope: 'profile'
        });

        // Sign the user in, and then retrieve their ID.
        auth2.signIn().then(function() {
            console.log(auth2.currentUser.get().getId());
        });
    });
    </script>

</body>