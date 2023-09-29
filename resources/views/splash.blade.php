<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>StickyMobile BootStrap</title>
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/styles/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/styles/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i|Source+Sans+Pro:300,300i,400,400i,600,600i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('mobile-ios/fonts/css/fontawesome-all.min.css') }}">
    <link rel="manifest" href="_manifest.json" data-pwa-version="set_in_manifest_and_pwa_js">
    <link rel="apple-touch-icon" sizes="180x180" href="app/icons/icon-192x192.png">
</head>

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="page-content pb-0">

        <div class="card" data-card-height="cover">

            <div class="card-center text-center">
                <!-- shows in light mode-->
                <div class="show-on-theme-light">
                    <h1 class="color-black font-40 font-800 mt-3">HERZlich willkommen</h1>
                    <p class="color-black opacity-50">ALLTAGO ist ihr Blutdruck-Tagebuch und Ratgeber rund um Ihre Gesundheit mit Hinblick auf ihr Herz.</p>

                    <p class="boxed-text-xl font-14 font-400 line-height-l opacity-70 color-black">
                        Um ALLTAGO nutzen zu können benötigen Sie einen sicheren Zugang - schließlich handelt es sich um vertrauliche Daten.<br><br>Dieser ist Zugang komplett kostenfrei.<br><br>Ihre Daten werden nicht an Dritte weitergegeben, das ist unser Versprechen an Sie.
                    </p>
                </div>
                <!-- shows in dark mode-->
                <div class="show-on-theme-dark">
                    <h1 class="color-white font-40 mt-3">Welcome</h1>
                    <p class="color-white opacity-50">StickyMobile - The Best Mobile Kit</p>

                    <p class="boxed-text-xl font-14 line-height-l color-white">
                        StickyMobile is the best Selling Mobile Web Kit on the Envato Marketplaces, blazing fast and with full PWA, RTL and Dark Mode Support.
                    </p>
                </div>
                <a href="#" data-menu="menu-signin" class="btn btn-m font-900 text-uppercase rounded-l btn-center-l mb-3 mt-5 bg-highlight">Sie haben bereits einen Zugang? Hier anmelden</a>
                <a href="#" data-menu="menu-signup" class="color-theme font-500 opacity-50">Sie haben noch keinen Zugang?<br>Erstellen Sie hier einen komplett kostenfrei.</a>
            </div>
            <div class="card-overlay bg-theme opacity-85"></div>
            <div class="card-overlay-infinite preload-img" data-src="{{ URL::asset('mobile-ios/images/pictures/_bg-infinite.jpg') }}"></div>
        </div>

    </div>

    <div id="menu-signin" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h1 class="text-uppercase font-900 mb-0">LOGIN</h1>
            <p class="font-11  mt-n1 mb-2">
                Hello, stranger! Please enter your credentials below.
            </p>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="name" class="form-control validate-name" id="form1a" placeholder="Name">
                <label for="form1a" class="color-blue-dark">Name</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="password" class="form-control validate-text" id="form3a" placeholder="Password">
                <label for="form3a" class="color-blue-dark">Password</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <div class="row">
                <div class="col-6">
                    <a href="#" data-menu="menu-forgot" class="font-10">Forgot Password?</a>
                </div>
                <div class="col-6">
                    <a data-menu="menu-signup" href="#" class="float-end font-10">Create Account</a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <a href="#" data-menu="menu-signup" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green-dark mt-4 mb-3">LOGIN</a>
        </div>
    </div>

    <div id="menu-signup" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h1 class="text-uppercase font-900 mb-0">Register</h1>
            <p class="font-11  mt-n1 mb-0">
                Don't have an account? Register below.
            </p>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="name" class="form-control validate-name" id="form1ab" placeholder="Name">
                <label for="form1ab" class="color-blue-dark">Name</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-at"></i>
                <input type="email" class="form-control validate-email" id="form1aa" placeholder="Name">
                <label for="form1aa" class="color-blue-dark">Name</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control validate-password" id="form3a" placeholder="Password">
                <label for="form3a" class="color-blue-dark">Password</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <p class="text-center pb-0 mb-n1 pt-1">
                <a href="#" data-menu="menu-signin" class="text-center font-11 color-gray-dark">Already Registered? Sign In Here.</a>
            </p>
            <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-blue-dark mt-4 mb-3">Register</a>
        </div>
    </div>

    <div id="menu-forgot" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h2 class="text-uppercase font-900 mb-0">Forgot Password?</h2>
            <p class="font-11 mb-3">
                Let's get you back into your account. Enter your email to reset.
            </p>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="email" class="form-control validate-email" id="form1a4" placeholder="Email">
                <label for="form1a4" class="color-blue-dark">Email</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(required)</em>
            </div>
            <a href="#" class="btn btn-full btn-m shadow-l rounded-s bg-highlight text-uppercase font-900 mb-3">SEND RECOVERY EMAIL</a>
        </div>
    </div>



</div>

<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/custom.js') }}"></script>
</body>
