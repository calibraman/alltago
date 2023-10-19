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


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>

    <style type="text/css">
        img {
            display: block;
            max-width: 60%;
        }
        .preview {
            text-align: center;
            overflow: hidden;
            width: 120px;
            height: 120px;
            margin: 10px;
            border: 1px solid red;
        }
        input{
            margin-top:20px;
        }
        .section{
            margin-top:150px;
            background:#fff;
            padding:50px 30px;
        }
        .modal-lg{
            max-width: 900px !important;
        }

        .img-thumbnail{max-width:100%;height:auto;padding:.55rem;background-color:var(--vz-body-bg);border:1px solid var(--vz-border-color);border-radius:.25rem}
    </style>

</head>


<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="header header-fixed header-logo-center">
        <a href="index.html" class="header-title"><?php echo($anrede); ?> {{ Auth::user()->vorname }}</a>
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
        <a href="home2"><i class="fa-solid fa-book"></i><span>Tagebuch</span></a>
        <a href="#" onclick="zeigeNeueMessungModal()"><i class="fa-solid fa-plus"></i><span>Neue Messung</span></a>
        <a href="einstellungen" class="active-nav"><i class="fa fa-cog"></i><span>Einstellungen</span></a>
        <!--<a href="#" data-menu="menu-settings"><i class="fa fa-cog"></i><span>Einstellungen</span></a>-->
    </div>

    <div class="page-content header-clear-medium">

        <div class="card card-style contact-form">
            <div class="content">
                <h3>Profilfoto</h3>
                <?php
                if (empty(Auth::user()->profilbild)) {
                } else {
                //    echo ('<img src="{{ URL::asset(\'intern/pictures/users/'.Auth::user()->profilbild.'" alt="" class="img-thumbnail rounded-circle" style="width:100px">');
                }
                ?>
                <span class="text-muted">Bitte wählen Sie ein Foto aus oder erstellen Sie eines auf einem Smartphone/Tablet mit der Kamera:</span><br>
                <input type="file" name="image" class="image" style="margin-top:8px">
            </div>
        </div>

        <div class="card card-style contact-form">
            <div class="content">
                <h3>Ihre Angaben</h3>
                <fieldset>
                    <div class="form-field form-name">
                        <label class="contactNameField color-theme" for="txtVorname">Vorname:</label>
                        <input type="text" name="txtVorname" value="<?php echo (Auth::user()->vorname); ?>" class="round-small" id="txtVorname" />
                    </div>
                    <div class="form-field form-name">
                        <label class="contactNameField color-theme" for="txtNachname">Nachname:</label>
                        <input type="text" name="txtNachname" value="<?php echo (Auth::user()->nachname); ?>" class="round-small" id="txtNachname" />
                    </div>
                    <br>
                    Geburtstag:
                    <div class="input-style has-borders">
                        <input class="round-small"
                            type="date"
                            id="dateGeburtstag"
                            name="dateGeburtstag"
                            value="<?php echo (Auth::user()->geburtstag); ?>"
                            style="margin-top:8px"
                        />
                    </div>
                    Wenn Sie ihr Geburtstdatum uns mitteilen, können genauere Berechnungen erstellt werden. <br>
                    <div class="form-button">
                        <input type="submit" class="btn bg-success text-uppercase font-900 btn-m btn-full rounded-sm  shadow-xl contactSubmitButton" value="Angaben speichern" onclick="speichereEinstellungen()" />
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="card card-style contact-form">
            <div class="content">
                <h3>Passwort ändern</h3>
                    Sie können hier das aktuelle Passwort ändern.<br>
                    <div class="form-field form-name">
                        <label class="contactNameField color-theme" for="txtNeuesPasswort">Neues Passwort:</label>
                        <input type="password" name="txtNeuesPasswort" value="" class="round-small" id="txtNeuesPasswort" />
                    </div>
                    <div class="form-button">
                        <input type="submit" class="btn bg-success text-uppercase font-900 btn-m btn-full rounded-sm  shadow-xl contactSubmitButton" value="Passwort ändern" onclick="passwortAendern()" />
                    </div>
                </fieldset>
            </div>
        </div>

        <div class="card card-style contact-form">
            <div class="content">
                <h3>Ausloggen</h3>
                    Sie können sich sicher hier ausloggen und erst bei erneutem Einloggen haben Sie wieder Zugriff auf ALLTAGO.<br>
                    <div class="form-button">
                        <input type="submit" class="btn bg-warning text-uppercase font-900 btn-m btn-full rounded-sm  shadow-xl contactSubmitButton" value="Ausloggen" onclick="ausloggen()" />
                    </div>
                </fieldset>
            </div>
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



<!-- Bildupload Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-container">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="modal-title" id="modalLabel">Bitte wählen Sie den Bereich aus:</h5>
                            <img id="image">
                        </div>
                        <div class="col-md-4">
                            <h5 class="modal-title">Vorschau:</h5>
                            <div class="preview"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-label="Close">Abbrechen</button>
                <button type="button" class="btn btn-success" id="crop">Speichern</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/toastify/toastify.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>


<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/custom.js') }}"></script>


<script>
    $(document).ready(function() {
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

    function speichereEinstellungen() {
        var txtVorname = $('#txtVorname').val().trim();
        var txtNachname = $('#txtNachname').val().trim();
        var dateGeburtstag = $('#dateGeburtstag').val().trim();

        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('user.einstellungenSpeichern') }}",
            data: {'txtVorname': txtVorname,
                   'txtNachname': txtNachname,
                   'dateGeburtstag': dateGeburtstag },
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
                    Toastify({
                        text: "Die Daten wurde erfolgreich aktualisiert.",
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

    function ausloggen() {

        Swal.fire({
            icon: 'question',
            title: "",
            text: "Möchten Sie wirklich ausloggen?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Ja, ausloggen',
            cancelButtonText: 'Abbrechen',
            confirmButtonColor: '#6ADA7D',
            cancelButtonColor: '#FA896B',
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:"{{ route('user.logout') }}",
                    data: {},
                    success:function(response) {
                        window.location.replace(response.url);

                    }
                });
            }
        })
    }

</script>
<script>

    function passwortAendern() {

        var txtNeuesPasswort = $('#txtNeuesPasswort').val().trim();
        if (txtNeuesPasswort == "") {
            Toastify({
                text: "Bitte wählen Sie ein neues Passwort ein.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        const length = txtNeuesPasswort.length;
        if (length < 5) {
            Toastify({
                text: "Das Passwort muss mindestens 5 Zeichen lang sein.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }


        Swal.fire({
            icon: 'question',
            title: "",
            text: "Möchten Sie wirklich das Passwort ändern?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Ja, Passwort ändern',
            cancelButtonText: 'Abbrechen',
            confirmButtonColor: '#6ADA7D',
            cancelButtonColor: '#FA896B',
        }).then(function(result) {
            if(result.value) {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:"{{ route('user.passwortAendern') }}",
                    data: {'txtNeuesPasswort': txtNeuesPasswort},
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
                            Toastify({
                                text: "Das Passwort wurde erfolgreich geändert.",
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
        })
    }

</script>

<script>
    var $modal = $('#modal');
    var image = document.getElementById('image');
    var cropper;

    $("body").on("change", ".image", function(e){
        var files = e.target.files;
        var done = function (url) {
            image.src = url;
            $modal.modal('show');
        };

        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];
            if ((files[0]['type'] != 'image/jpeg') && (files[0]['type'] != 'image/png')) {
                alert("Keine gültige Bilddatei");
                return false;
            }
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 3,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    $("#crop").click(function(){
        let canvas = cropper.getCroppedCanvas({
            width: 420,
            height: 420,
        });

        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url:"{{ route('user.crop-userimage-upload') }}",
                    data: {'image': base64data},
                    success: function(data){
                        //$modal.modal('hide');
                        location.reload();
                    }
                });
            }
        });
    });
</script>
<!--Picure Upload js-->


</body>
