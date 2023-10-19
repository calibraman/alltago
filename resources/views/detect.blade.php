<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>StickyMobile BootStrap</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/styles/style.css') }}">
    <link href="{{ URL::asset('mobile-ios/assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('mobile-ios/assets/libs/toastify/toastify.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
    <style>

    </style>
</head>


<body>


    <script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>



    <script>


        $(document).ready(function() {
            var userAgent = navigator.userAgent;

            alert ("*" + userAgent + "*");

            // Prüfen, ob der Benutzer ein iOS-Gerät verwendet
            if (userAgent == "webviewgold") {
                // Der Benutzer verwendet die App
                window.location.href = "https://www.alltago.de/splash";
            } else if (/Android/.test(userAgent)) {
                // Der Benutzer verwendet ein Android-Gerät
                window.location.href = "https://www.alltago.app";
            }  else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                // Der Benutzer verwendet ein iOS-Gerät
                window.location.href = "https://www.alltago.app";
            } else {
                // Der Benutzer verwendet weder iOS noch Android
                window.location.href = "https://www.alltago.app";
            }

        })


    </script>


</body>
