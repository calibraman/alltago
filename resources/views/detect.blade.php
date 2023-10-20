<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <title></title>
</head>


<body>

GET:
<?php
foreach ($_GET as $key => $value) {
    echo "Parameter: " . $key . ", Wert: " . $value . "<br>";
}
?>

    <script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>



    <script>


        $(document).ready(function() {
            var userAgent = navigator.userAgent;

            // alert ("*" + userAgent + "*");

            // Prüfen, ob der Benutzer ein iOS-Gerät verwendet
            if (userAgent == "webviewgold") {
                // Der Benutzer verwendet die App
              //  window.location.href = "https://www.alltago.de/splash";
            } else if (/Android/.test(userAgent)) {
                // Der Benutzer verwendet ein Android-Gerät
              //  window.location.href = "https://www.alltago.app";
            }  else if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                // Der Benutzer verwendet ein iOS-Gerät
              //  window.location.href = "https://www.alltago.app";
            } else {
                // Der Benutzer verwendet weder iOS noch Android
            //    window.location.href = "https://www.alltago.app";
            }

          //  window.location.href = "https://www.alltago.de/splash";
        })


    </script>


</body>
