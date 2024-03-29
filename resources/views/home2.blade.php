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
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <title>ALLTAGO</title>
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


<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="header header-fixed header-logo-center">
        <a href="index.html" class="header-title"><?php echo($anrede); ?></a>
        <!--<a href="#" data-back-button class="header-icon header-icon-1"><i class="fas fa-arrow-left"></i></a>-->
        <!--<a href="#" data-toggle-theme class="header-icon header-icon-4"><i class="fas fa-lightbulb"></i></a>-->
        <?php
        if (empty(Auth::user()->profilbild)) {
            echo ('');
        } else {
            echo ('<img src="intern/pictures/users/'.Auth::user()->profilbild.'" alt="" class="header-icon header-icon-4 img-thumbnail rounded-circle" style="width:50px">');
        }
        ?>
    </div>


    <div id="footer-bar" class="footer-bar-1">
        <!--<a href="index.html"><i class="fa fa-home"></i><span>Home</span></a>-->
        <!--<a href="index-components.html"><i class="fa-solid fa-chart-line"></i><span>Statistik</span></a>-->
        <!--<a href="home2"><i class="fa-solid fa-droplet"></i><span>Messungen</span></a>-->
        <a href="home3"><i class="fa-solid fa-book"></i><span>Wochenbuch</span></a>
        <a href="home2" class="active-nav"><i class="fa-solid fa-book"></i><span>Tagebuch</span></a>
        <a href="#" onclick="zeigeNeueMessungModal()"><i class="fa-solid fa-plus"></i><span>Neue Messung</span></a>
        <a href="einstellungen"><i class="fa fa-cog"></i><span>Einstellungen</span></a>
        <!--<a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Einstellungen</span></a>-->
    </div>

    <div class="page-content header-clear-medium">


        <div id="eventContainer">
            <!-- Hier werden die Events dynamisch hinzugefügt -->
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


<!-- Neue Messung Eintragen -->
<div id="modalNeueMessungEintragen" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Neue Messung eintragen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                Zeitpunkt:
                <div class="input-style has-borders no-icon mb-5">
                    <input
                        type="datetime-local"
                        id="txtNeueMessungDatum"
                        name="txtNeueMessungDatum"
                        value="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i'); ?>"
                        min="2022-06-07T00:00"
                        max="2024-06-14T00:00"
                    />
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        SYS:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtNeueMessungSys" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                    <div class="col">
                        DIA:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtNeueMessungDia" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                    <div class="col">
                        Puls:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtNeueMessungPuls" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-red-light mt-4 mb-3" data-bs-dismiss="modal">Abbrechen</a>
                <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green-dark mt-4 mb-3" onclick="neueMessungEintragen()">Messung eintragen</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Messung Bearbeiten -->
<div id="modalNeueMessungBearbeiten" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Messung bearbeiten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                Zeitpunkt:
                <div class="input-style has-borders no-icon mb-5">
                    <input
                        type="datetime-local"
                        id="txtMessungBearbeitenDatum"
                        name="txtMessungBearbeitenDatum"
                        value="<?php echo date('Y-m-d'); ?>T<?php echo date('H:i'); ?>"
                        min="2022-06-07T00:00"
                        max="2024-06-14T00:00"
                    />
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        SYS:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtMessungBearbeitenSys" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                    <div class="col">
                        DIA:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtMessungBearbeitenDia" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                    <div class="col">
                        Puls:
                        <div class="input-style has-borders no-icon validate-field mb-4">
                            <input type="tel" class="form-control validate-text" id="txtMessungBearbeitenPuls" placeholder="">
                            <em>*</em>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-red-light mt-4 mb-3" onclick="messungLoeschen()">Messung Löschen</a>
                <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green-dark mt-4 mb-3" onclick="messungBearbeitenEintragen()">Speichern</a>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/toastify/toastify.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/chart/chart.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/custom.js') }}"></script>


<script>
    // Variable, um den aktuellen Offset zu speichern
    var letztesDatum = '';
    var aktuelleMessungID = 0;
    var footerAngezeigt = false;

    $(document).ready(function() {
        // Lade die ersten Events beim Start der Seite
        $('#eventContainer').html('');
        loadMoreEvents();

    })


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        statusCode: {
            /*   401: function(){
                   location.href = "./";
               },
               419: function(){
                   location.href = "./";
               },
           405: function(){
               location.href = "./";
           }*/
        }
    })

    // Funktion zum Abrufen und Anzeigen der Events
    function loadMoreEvents() {
        // AJAX-Aufruf, um Daten vom PHP-Skript abzurufen
        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('user.holeFeed2') }}",
            data: {'letztesDatum':letztesDatum},
            success: function (response) {
                // Wenn Daten erfolgreich abgerufen wurden
                if (response.events.trim() !== "") {
                    $('#eventContainer').append(response.events);
                    letztesDatum = response.letztesDatum; // Inkrementiere den Offset für die nächste Ladung
                } else {
                    // Keine weiteren Events gefunden
                    //$('#eventContainer').append('<p>Keine weiteren Events gefunden.</p>');
                }
                // Prüfen ob es eine Messung gibt, Erstaufruf oder es wird der footer eingefügt
                if ($('#eventContainer').html() == "") {
                    $('#eventContainer').append('<div class="card card-style" style="background-color: #7EB9AB;display: flex;justify-content: center; align-items: center;" onclick="zeigeNeueMessungModal()">' +
                        '<img src="mobile-ios/images/pictures/herz_mit_stetoskop.jpg" alt="" style="max-width: 30%;height: auto">' +
                        '<br>' +
                        '<div class="text-center text-white mb-3">Tragen Sie den ersten Messwert ein.<br>' +
                        'Klicken Sie hier oder unten im Menü auf "Neue Messung".</div>' +
                        '<div class="clear"></div>' +
                        '</div>');
                } else {
                    if (footerAngezeigt == false) {
                        footerAngezeigt = true;
                        $('#eventContainer').append('<div class="footer card card-style">' +
                            '<a href="#" class="footer-title"><span class="color-highlight">ALLTAGO</span></a>' +
                            '<p class="footer-text"><span>Entwickelt mit<i class="fa fa-heart color-highlight font-16 ps-2 pe-2"></i></span><br><br>ALLTAGO kann keine Erkrankungen erkennen, diagnostizieren oder behandlen.<br>Sprechen Sie immer mit Ihrem Arzt.</p>' +
                            '<p class="footer-links"><a href="#" class="color-highlight">Privacy Policy</a> | <a href="#" class="color-highlight">Terms and Conditions</a> | <a href="#" class="back-to-top color-highlight"> Zurück nach oben</a></p>' +
                            '<div class="clear"></div>' +
                            '</div>');
                    }
                }
            },
            error: function () {
                // Fehlerbehandlung, wenn Daten nicht abgerufen werden können
                // console.log('Fehler beim Abrufen der Events.');
            }
        });
    }

    // Funktion zum Überprüfen, ob der Benutzer ans Ende der Seite gescrollt hat
    function checkScroll() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            loadMoreEvents();
        }
    }

    // Überwache das Scrollen des Benutzers
    $(window).on('scroll', checkScroll);


</script>


<script>

    $('#txtNeueMessungSys').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    $('#txtNeueMessungDia').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    $('#txtNeueMessungPuls').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });

    $('#txtNeueMessungSys').on('input', function() {
        var len = $('#txtNeueMessungSys').val().length;
        if  (len == 3) $('#txtNeueMessungDia').focus();
    })

    function zeigeNeueMessungModal(){
        $('#txtNeueMessungDatum').val('');
        $('#txtNeueMessungSys').val('');
        $('#txtNeueMessungDia').val('');
        $('#txtNeueMessungPuls').val('');
        $('#modalNeueMessungEintragen').modal('toggle');

    }

    function neueMessungEintragen() {
        var txtNeueMessungDatum = $('#txtNeueMessungDatum').val().trim();
        var txtNeueMessungSys = $('#txtNeueMessungSys').val().trim();
        var txtNeueMessungDia = $('#txtNeueMessungDia').val().trim();
        var txtNeueMessungPuls = $('#txtNeueMessungPuls').val().trim();

        if (txtNeueMessungDatum == "") {
            Toastify({
                text: "Bitte wählen Sie ein Datum aus.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtNeueMessungSys == "") {
            Toastify({
                text: "Bitte geben Sie den Systolischen Blutdruck an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtNeueMessungDia == "") {
            Toastify({
                text: "Bitte geben Sie den Diastolischen Blutdruck an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtNeueMessungPuls == "") {
            Toastify({
                text: "Bitte geben Sie den Puls an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('user.messungEintragen') }}",
            data: {'txtNeueMessungDatum': txtNeueMessungDatum,
                'txtNeueMessungSys': txtNeueMessungSys,
                'txtNeueMessungDia': txtNeueMessungDia ,
                'txtNeueMessungPuls': txtNeueMessungPuls },
            success: function(data) {
                if(data.ergebnis == "fehler") {
                    Swal.fire({
                        title: 'Fehler',
                        text: data.text2,
                        type: 'error',
                        icon: 'error',
                        confirmButtonColor: '#6ADA7D'
                    });
                } else {
                    letztesDatum = '';
                    $('#eventContainer').html('');
                    loadMoreEvents();
                    $('#modalNeueMessungEintragen').modal('toggle');
                    Toastify({
                        text: "Die Messung wurde erfolgreich eingetragen.",
                        className: "info",
                        duration: 5000,
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: "#6ADA7D"
                        }
                    }).showToast();
                }
            }
        });
    }

</script>


<script>

    $('#txtMessungBearbeitenSys').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    $('#txtMessungBearbeitenDia').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });
    $('#txtMessungBearbeitenPuls').keypress(function (e) {
        var charCode = (e.which) ? e.which : event.keyCode
        if (String.fromCharCode(charCode).match(/[^0-9]/g))
            return false;
    });



    $('#txtMessungBearbeitenSys').on('input', function() {
        var len = $('#txtMessungBearbeitenSys').val().length;
        if  (len == 3) $('#txtMessungBearbeitenDia').focus();
    })


    function zeigeMessungBearbeitenModal(messungID,datum,sys,dia,puls){
        aktuelleMessungID = messungID;
        $('#txtMessungBearbeitenDatum').val(datum);
        $('#txtMessungBearbeitenSys').val(sys);
        $('#txtMessungBearbeitenDia').val(dia);
        $('#txtMessungBearbeitenPuls').val(puls);
        $('#modalNeueMessungBearbeiten').modal('toggle');
    }


    function messungBearbeitenEintragen() {
        var txtMessungBearbeitenDatum = $('#txtMessungBearbeitenDatum').val().trim();
        var txtMessungBearbeitenSys = $('#txtMessungBearbeitenSys').val().trim();
        var txtMessungBearbeitenDia = $('#txtMessungBearbeitenDia').val().trim();
        var txtMessungBearbeitenPuls = $('#txtMessungBearbeitenPuls').val().trim();

        if (txtMessungBearbeitenDatum == "") {
            Toastify({
                text: "Bitte wählen Sie ein Datum aus.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtMessungBearbeitenSys == "") {
            Toastify({
                text: "Bitte geben Sie den Systolischen Blutdruck an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtMessungBearbeitenDia == "") {
            Toastify({
                text: "Bitte geben Sie den Diastolischen Blutdruck an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (txtMessungBearbeitenPuls == "") {
            Toastify({
                text: "Bitte geben Sie den Puls an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('user.messungBearbeiten') }}",
            data: { 'aktuelleMessungID': aktuelleMessungID,
                    'txtMessungBearbeitenDatum': txtMessungBearbeitenDatum,
                    'txtMessungBearbeitenSys': txtMessungBearbeitenSys,
                    'txtMessungBearbeitenDia': txtMessungBearbeitenDia ,
                    'txtMessungBearbeitenPuls': txtMessungBearbeitenPuls },
            success: function(data) {
                if(data.ergebnis == "fehler") {
                    Swal.fire({
                        title: 'Fehler',
                        text: data.text2,
                        type: 'error',
                        icon: 'error',
                        confirmButtonColor: '#6ADA7D'
                    });
                } else {
                    letztesDatum = '';
                    $('#eventContainer').html('');
                    loadMoreEvents();
                    $('#modalNeueMessungBearbeiten').modal('toggle');
                    Toastify({
                        text: "Die Messung wurde erfolgreich bearbeitet.",
                        className: "info",
                        duration: 5000,
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: "#6ADA7D"
                        }
                    }).showToast();
                }
            }
        });
    }


</script>

<script>
    function messungLoeschen() {
        Swal.fire({
            icon: 'question',
            title: "",
            text: "Möchten Sie diese Messung wirklich löschen?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Ja, Messung löschen',
            cancelButtonText: 'Abbrechen',
            confirmButtonColor: '#6ADA7D',
            cancelButtonColor: '#FA896B',
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:"{{ route('user.messungLoeschen') }}",
                    data: {'aktuelleMessungID':aktuelleMessungID},
                    success:function(response) {
                        $('#modalNeueMessungBearbeiten').modal('toggle');
                        if (response.ergebnis == "fehler") {
                            Swal.fire({
                                title: 'Fehler',
                                html: response.text2,
                                type: 'error',
                                icon: 'error',
                                confirmButtonColor: '#6ADA7D'
                            });
                        } else {
                            letztesDatum = '';
                            $('#eventContainer').html('');
                            loadMoreEvents();
                            Swal.fire({
                                title: '',
                                html: response.text1,
                                type: 'success',
                                icon: 'success',
                                confirmButtonColor: '#6ADA7D'
                            });
                        }
                    }
                });

            }
        })
    }

    for (var i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);
        var value = localStorage.getItem(key);

        console.log('Key:', key, 'Value:', value);

        if (key == "username") usernameValue = value;
        if (key == "password") passwordValue = value;
    }
</script>



</body>
