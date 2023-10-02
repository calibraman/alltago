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

        <div class="timeline-body timeline-body-center">
            <div class="timeline-deco"></div>

            <div class="timeline-item">
                <i class="far fa-map bg-blue-dark shadow-l timeline-icon"></i>
                <div class="timeline-item-content rounded-s shadow-l">
                    <h5 class="font-300 text-center">
                        Stop saying pink is the new black! Pink is just pink! Seriously! <a href="#">#funnyRant</a>
                    </h5>
                    <div class="mt-4 text-center">
                        <a href="#" class="icon icon-xxs rounded-circle bg-red-dark "><i class="fa fa-heart"></i></a>
                        <a href="#" class="icon icon-xxs rounded-circle bg-blue-dark me-3 ms-3"><i class="fa fa-sync"></i></a>
                        <a href="#" class="icon icon-xxs rounded-circle bg-green-dark"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fa fa-globe bg-yellow-dark shadow-l timeline-icon"></i>
                <div class="timeline-item-content rounded-s shadow-l">
                    <h5 class="font-300 text-center">
                        Heading to a PhotoShoot on Mars with <a href="#">@Elon Musk</a>. This will be fun!
                    </h5>
                    <p class="text-center color-theme mt-3 mb-0 pb-0 font-10"><i class="fa fa-map-pin me-3 font-11"></i>Posted from Mars. No, Realy!</p>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fab fa-facebook-f bg-facebook shadow-l timeline-icon"></i>
                <div class="timeline-item-content-full rounded-s shadow-l">
                    <img data-src="images/pictures/9w.jpg" alt="img" src="images/empty.png" class="preload-img img-fluid">
                    <h5 class="font-300 text-center mt-3">
                        Our first Photo on Google Plus. We're adding stuff here too now!
                    </h5>
                    <a href="#" class="btn btn-m btn-center-l rounded-s bg-facebook text-uppercase font-700">Follow on Facebook</a>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fab fa-pinterest-p bg-pinterest shadow-l timeline-icon"></i>
                <div class="timeline-item-content rounded-s shadow-l">
                    <h5 class="font-300 text-center">
                        Just updated our Facebook Page. You can visit it <a href="#">on our Page</a>.
                    </h5>
                    <a href="#" class="mt-4 mb-2 btn btn-m btn-center-l rounded-s bg-pinterest text-uppercase font-700">Pinned from Pinterest</a>
                </div>
            </div>

            <div class="timeline-item">
                <i class="fab fa-twitter bg-twitter shadow-l timeline-icon"></i>
                <div class="timeline-item-content rounded-s shadow-l">
                    <h5 class="font-300 text-center">
                        Twitter is struggling to get users. We're considering moving over to Google Plus. <a href="#">#feedback #needed</a>
                    </h5>
                    <p class="text-center mt-4 mb-0 pb-0">
                        <a href="#" class="text-center font-400">Follow us @iEnabled via Twitter for iOS</a>
                    </p>
                </div>
            </div>
        </div>

        <div class="footer card card-style">
            <a href="#" class="footer-title"><span class="color-highlight">StickyMobile</span></a>
            <p class="footer-text"><span>Made with <i class="fa fa-heart color-highlight font-16 ps-2 pe-2"></i> by Enabled</span><br><br>Powered by the best Mobile Website Developer on Envato Market. Elite Quality. Elite Products.</p>
            <div class="text-center mb-3">
                <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="icon icon-xs rounded-sm shadow-l me-1 bg-phone"><i class="fa fa-phone"></i></a>
                <a href="#" data-menu="menu-share" class="icon icon-xs rounded-sm me-1 shadow-l bg-red-dark"><i class="fa fa-share-alt"></i></a>
                <a href="#" class="back-to-top icon icon-xs rounded-sm shadow-l bg-dark-light"><i class="fa fa-angle-up"></i></a>
            </div>
            <p class="footer-copyright">Copyright &copy; Enabled <span id="copyright-year">2017</span>. All Rights Reserved.</p>
            <p class="footer-links"><a href="#" class="color-highlight">Privacy Policy</a> | <a href="#" class="color-highlight">Terms and Conditions</a> | <a href="#" class="back-to-top color-highlight"> Back to Top</a></p>
            <div class="clear"></div>
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