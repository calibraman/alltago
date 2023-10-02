<?php
$anrede = 'Hallo';
if (date('G') > 5) $anrede = 'Guten Morgen';
if (date('G') >= 8) $anrede = 'Guten Tag';
if (date('G') >= 17) $anrede = 'Guten Abend';

?>


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

    <div class="header header-fixed header-logo-center">
        <a href="index.html" class="header-title"><?php echo($anrede); ?>, {{ Auth::user()->vorname }}</a>
        <!--<a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>-->
        <a href="#" data-toggle-theme class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>
    </div>

    <div id="footer-bar" class="footer-bar-1">
        <!--<a href="index.html"><i class="fa fa-home"></i><span>Home</span></a>-->
        <a href="index-components.html"><i class="fa-solid fa-chart-line"></i><span>Statistik</span></a>
        <a href="home" ><i class="fa-solid fa-book"></i><span>Tagebuch</span></a>
        <a href="home2" class="active-nav"><i class="fa-solid fa-droplet"></i><span>Blutwerte</span></a>
        <a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Einstellunen</span></a>
    </div>

    <div class="page-content header-clear-medium">

        <div class="card card-style mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="align-self-start">
                        <h4 class="mb-0 font-18">Introduction to Event</h4>
                        <span class="font-11"><i class="fa fa-map-marker font-10 pe-1"></i> Home, California</span>
                    </div>
                    <div class="align-self-start ms-auto ps-3">
						<span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
							<i class="fa fa-check color-green-dark font-11"></i>
						</span>
                    </div>
                </div>
                <div class="divider mt-2 mb-2"></div>
                <div class="d-flex">
                    <div class="align-self-center">
                        <span class="font-12 color-theme opacity-70 font-500"><i class="far fa-clock font-11 pe-1"></i> 07:30 AM - 08:00 AM</span>
                    </div>
                    <div class="align-self-center ms-auto">
                        <span class="font-12 color-theme opacity-30 font-500"><i class="far fa-car font-11 pe-1"></i> 25 min by car</span>
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-green-dark opacity-50"></div>
        </div>

        <div class="card card-style mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="align-self-start">
                        <h4 class="mb-0 font-18">King of The Hill</h4>
                        <span class="font-11"><i class="fa fa-map-marker font-10 pe-1"></i> Gold's Gym, California</span>
                    </div>
                    <div class="align-self-start ms-auto ps-3">
						<span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
							<i class="fa fa-mountain color-red-dark font-11"></i>
						</span>
                    </div>
                </div>
                <div class="divider mt-2 mb-2"></div>
                <div class="d-flex">
                    <div class="align-self-center">
                        <span class="font-12 color-theme opacity-70 font-500"><i class="far fa-clock font-11 pe-1"></i> 09:00 AM - 11:00 AM</span>
                    </div>
                    <div class="align-self-center ms-auto">
                        <span class="font-12 color-theme opacity-30 font-500"><i class="fa fa-moon font-11 pe-1"></i> Do not Disturb</span>
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-red-dark opacity-30"></div>
        </div>

        <div class="card card-style mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="align-self-start">
                        <h4 class="mb-0 font-18">Team Deathmatch</h4>
                        <span class="font-11"><i class="fa fa-map-marker font-10 pe-1"></i> Home, California</span>
                    </div>
                    <div class="align-self-start ms-auto ps-3">
						<span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
							<i class="fa fa-skull color-teal-dark font-11"></i>
						</span>
                    </div>
                </div>
                <div class="divider mt-2 mb-2"></div>
                <div class="d-flex">
                    <div class="align-self-center">
                        <span class="font-12 color-theme opacity-70 font-500"><i class="far fa-clock font-11 pe-1"></i> 11:00 AM - 11:30 AM</span>
                    </div>
                    <div class="align-self-center ms-auto">
                        <span class="font-12 color-theme opacity-30 font-500"><i class="fa fa-link font-11 pe-1"></i> Check Paperwork</span>
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-teal-dark opacity-40"></div>
        </div>

        <div class="card card-style mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="align-self-start">
                        <h4 class="mb-0 font-18">Score Count & Report</h4>
                        <span class="font-11"><i class="fa fa-map-marker font-10 pe-1"></i> Starbucks, South Avenue</span>
                    </div>
                    <div class="align-self-start ms-auto ps-3">
						<span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
							<i class="fa fa-coffee color-brown-dark font-11"></i>
						</span>
                    </div>
                </div>
                <div class="divider mt-2 mb-2"></div>
                <div class="d-flex">
                    <div class="align-self-center">
                        <span class="font-12 color-theme opacity-70 font-500"><i class="far fa-clock font-11 pe-1"></i> 12:30 AM - 2:45 PM</span>
                    </div>
                    <div class="align-self-center ms-auto">
                        <img src="images/pictures/faces/4s.png" width="30" class="rounded-circle ms-n3 border border-brown-dark border-xs">
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-brown-dark opacity-40"></div>
        </div>



    </div>
    <!-- End of Page Content-->
    <!-- All Menus, Action Sheets, Modals, Notifications, Toasts, Snackbars get Placed outside the <div class="page-content"> -->
    <div id="menu-settings" class="menu menu-box-bottom menu-box-detached">
        <div class="menu-title mt-0 pt-0"><h1>Settings</h1><p class="color-highlight">Flexible and Easy to Use</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="list-group list-custom-small">
                <a href="#" data-toggle-theme data-trigger-switch="switch-dark-mode" class="pb-2 ms-n1">
                    <i class="fa font-12 fa-moon rounded-s bg-highlight color-white me-3"></i>
                    <span>Dark Mode</span>
                    <div class="custom-control scale-switch ios-switch">
                        <input data-toggle-theme type="checkbox" class="ios-input" id="switch-dark-mode">
                        <label class="custom-control-label" for="switch-dark-mode"></label>
                    </div>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            <div class="list-group list-custom-large">
                <a data-menu="menu-highlights" href="#">
                    <i class="fa font-14 fa-tint bg-green-dark rounded-s"></i>
                    <span>Page Highlight</span>
                    <strong>16 Colors Highlights Included</strong>
                    <span class="badge bg-highlight color-white">HOT</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a data-menu="menu-backgrounds" href="#" class="border-0">
                    <i class="fa font-14 fa-cog bg-blue-dark rounded-s"></i>
                    <span>Background Color</span>
                    <strong>10 Page Gradients Included</strong>
                    <span class="badge bg-highlight color-white">NEW</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Menu Settings Highlights-->
    <div id="menu-highlights" class="menu menu-box-bottom menu-box-detached">
        <div class="menu-title"><h1>Highlights</h1><p class="color-highlight">Any Element can have a Highlight Color</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="highlight-changer">
                <a href="#" data-change-highlight="blue"><i class="fa fa-circle color-blue-dark"></i><span class="color-blue-light">Default</span></a>
                <a href="#" data-change-highlight="red"><i class="fa fa-circle color-red-dark"></i><span class="color-red-light">Red</span></a>
                <a href="#" data-change-highlight="orange"><i class="fa fa-circle color-orange-dark"></i><span class="color-orange-light">Orange</span></a>
                <a href="#" data-change-highlight="pink2"><i class="fa fa-circle color-pink2-dark"></i><span class="color-pink-dark">Pink</span></a>
                <a href="#" data-change-highlight="magenta"><i class="fa fa-circle color-magenta-dark"></i><span class="color-magenta-light">Purple</span></a>
                <a href="#" data-change-highlight="aqua"><i class="fa fa-circle color-aqua-dark"></i><span class="color-aqua-light">Aqua</span></a>
                <a href="#" data-change-highlight="teal"><i class="fa fa-circle color-teal-dark"></i><span class="color-teal-light">Teal</span></a>
                <a href="#" data-change-highlight="mint"><i class="fa fa-circle color-mint-dark"></i><span class="color-mint-light">Mint</span></a>
                <a href="#" data-change-highlight="green"><i class="fa fa-circle color-green-light"></i><span class="color-green-light">Green</span></a>
                <a href="#" data-change-highlight="grass"><i class="fa fa-circle color-green-dark"></i><span class="color-green-dark">Grass</span></a>
                <a href="#" data-change-highlight="sunny"><i class="fa fa-circle color-yellow-light"></i><span class="color-yellow-light">Sunny</span></a>
                <a href="#" data-change-highlight="yellow"><i class="fa fa-circle color-yellow-dark"></i><span class="color-yellow-light">Goldish</span></a>
                <a href="#" data-change-highlight="brown"><i class="fa fa-circle color-brown-dark"></i><span class="color-brown-light">Wood</span></a>
                <a href="#" data-change-highlight="night"><i class="fa fa-circle color-dark-dark"></i><span class="color-dark-light">Night</span></a>
                <a href="#" data-change-highlight="dark"><i class="fa fa-circle color-dark-light"></i><span class="color-dark-light">Dark</span></a>
                <div class="clearfix"></div>
            </div>
            <a href="#" data-menu="menu-settings" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
        </div>
    </div>
    <!-- Menu Settings Backgrounds-->
    <div id="menu-backgrounds" class="menu menu-box-bottom menu-box-detached">
        <div class="menu-title"><h1>Backgrounds</h1><p class="color-highlight">Change Page Color Behind Content Boxes</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="divider divider-margins mb-n2"></div>
        <div class="content">
            <div class="background-changer">
                <a href="#" data-change-background="default"><i class="bg-theme"></i><span class="color-dark-dark">Default</span></a>
                <a href="#" data-change-background="plum"><i class="body-plum"></i><span class="color-plum-dark">Plum</span></a>
                <a href="#" data-change-background="magenta"><i class="body-magenta"></i><span class="color-dark-dark">Magenta</span></a>
                <a href="#" data-change-background="dark"><i class="body-dark"></i><span class="color-dark-dark">Dark</span></a>
                <a href="#" data-change-background="violet"><i class="body-violet"></i><span class="color-violet-dark">Violet</span></a>
                <a href="#" data-change-background="red"><i class="body-red"></i><span class="color-red-dark">Red</span></a>
                <a href="#" data-change-background="green"><i class="body-green"></i><span class="color-green-dark">Green</span></a>
                <a href="#" data-change-background="sky"><i class="body-sky"></i><span class="color-sky-dark">Sky</span></a>
                <a href="#" data-change-background="orange"><i class="body-orange"></i><span class="color-orange-dark">Orange</span></a>
                <a href="#" data-change-background="yellow"><i class="body-yellow"></i><span class="color-yellow-dark">Yellow</span></a>
                <div class="clearfix"></div>
            </div>
            <a href="#" data-menu="menu-settings" class="mb-3 btn btn-full btn-m rounded-sm bg-highlight shadow-xl text-uppercase font-900 mt-4">Back to Settings</a>
        </div>
    </div>
    <!-- Menu Share -->
    <div id="menu-share" class="menu menu-box-bottom menu-box-detached">
        <div class="menu-title mt-n1"><h1>Share the Love</h1><p class="color-highlight">Just Tap the Social Icon. We'll add the Link</p><a href="#" class="close-menu"><i class="fa fa-times"></i></a></div>
        <div class="content mb-0">
            <div class="divider mb-0"></div>
            <div class="list-group list-custom-small list-icon-0">
                <a href="auto_generated" class="shareToFacebook external-link">
                    <i class="font-18 fab fa-facebook-square color-facebook"></i>
                    <span class="font-13">Facebook</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="auto_generated" class="shareToTwitter external-link">
                    <i class="font-18 fab fa-twitter-square color-twitter"></i>
                    <span class="font-13">Twitter</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="auto_generated" class="shareToLinkedIn external-link">
                    <i class="font-18 fab fa-linkedin color-linkedin"></i>
                    <span class="font-13">LinkedIn</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="auto_generated" class="shareToWhatsApp external-link">
                    <i class="font-18 fab fa-whatsapp-square color-whatsapp"></i>
                    <span class="font-13">WhatsApp</span>
                    <i class="fa fa-angle-right"></i>
                </a>
                <a href="auto_generated" class="shareToMail external-link border-0">
                    <i class="font-18 fa fa-envelope-square color-mail"></i>
                    <span class="font-13">Email</span>
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>


</div>

<script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/toastify/toastify.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/custom.js') }}"></script>
</body>
