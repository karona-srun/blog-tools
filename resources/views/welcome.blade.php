<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta name="description" content="">
    <meta name="author" content="Karona Srun">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Vue SPA Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="apple-touch-icon" href="favicon.ico" sizes="180x180">
    <link rel="icon" href="favicon.ico" sizes="32x32" type="image/png">
    <link rel="icon" href="favicon.ico" sizes="16x16" type="image/png">
    {{-- <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json"> --}}
    <link rel="mask-icon" href="favicon.ico" color="#7952b3">
    <link rel="icon" href="favicon.ico">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Yomogi&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script>
        $( document ).ready(function() {
            window.fbAsyncInit = function() {
                FB.init({
                    appId: {{ config('services.facebook.client_id') }},
                    cookie: true, // enable cookies to allow the server to access the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v11.0' // use graph api version 2.8
                });
                
            };
            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v11.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        });
    </script>
</body>

</html>
