<!DOCTYPE HTML>
<html lang="de">
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
</head>

<body class="theme-light" data-highlight="highlight-red" data-gradient="body-default">

<div id="preloader"><div class="spinner-border color-highlight" role="status"></div></div>

<div id="page">

    <div class="page-content pb-0">

        <div class="card" data-card-height="cover">

            <div class="card-center text-center">
                <!-- shows in light mode-->
                <div class="show-on-theme-light">
                    <h1 class="color-black font-30 font-700 mt-3">HERZlich willkommen</h1>
                    <p class="color-black opacity-50">ALLTAGO ist ihr Blutdruck-Tagebuch<br>und Ratgeber rund um Ihre Gesundheit mit Hinblick auf ihr Herz.</p>

                    <p class="boxed-text-xl font-14 font-400 line-height-l opacity-70 color-black">
                        Um ALLTAGO nutzen zu können benötigen Sie einen sicheren Zugang - schließlich handelt es sich um vertrauliche Daten.<br><br>Dieser ist Zugang kostenfrei.<br><br>Ihre Daten werden nicht an Dritte weitergegeben, das ist unser Versprechen an Sie.
                    </p>
                </div>
                <a href="#" data-menu="menu-signup" class="btn btn-m font-900 text-uppercase rounded-l btn-center-xl mb-3 mt-5 bg-highlight">Sie haben noch keinen Zugang?<br>Erstellen Sie hier einen kostenfrei</a>
                <a href="#" data-menu="menu-signin" class="color-theme font-500 opacity-50">Sie haben bereits einen Zugang? Hier anmelden</a>
            </div>
            <div class="card-overlay bg-theme opacity-85"></div>
            <div class="card-overlay-infinite preload-img" data-src="{{ URL::asset('mobile-ios/images/pictures/_bg-infinite.jpg') }}"></div>
        </div>

    </div>

    <div id="menu-signin" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h1 class="text-uppercase font-900 mb-0">Einloggen</h1>
            <p class="font-11  mt-n1 mb-2">
                Hallo und willkommen zurück, bitte loggen Sie sich ein.
            </p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <a href="#" data-menu="menu-forgot" class="font-10">Passwort vergessen?</a>
                    </div>
                    <div class="col-6">
                        <!--<a data-menu="menu-signup" href="#" class="float-end font-10">Create Account</a>
                        <div class="clearfix"></div>-->
                    </div>
                </div>
                <!--<a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green-dark mt-4 mb-3" onclick="login()">LOGIN</a>-->

                <button type="submit" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green-dark mt-4 mb-3">
                    {{ __('Login') }}
                </button>

            </form>
        </div>
    </div>

    <div id="menu-signup" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h1 class="text-uppercase font-900 mb-0">Registrieren</h1>
            <p class="font-11  mt-n1 mb-0">
                Hallo und Willkommen bei uns. Bitte erstellen Sie sich hier einen Zugang, völlig kostenfrei.<br><br>
            </p>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-user"></i>
                <input type="name" class="form-control validate-name" id="txtNeuerAnsprechpartnerVorname" placeholder="Vorname" value="Tester">
                <label for="txtNeuerAnsprechpartnerVorname" class="color-blue-dark">Vorname</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(erforderlich)</em>
            </div>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-at"></i>
                <input type="email" class="form-control validate-email" id="txtNeuerAnsprechpartnerEmail" placeholder="E-Mail Adresse" value="tester@teste.de">
                <label for="txtNeuerAnsprechpartnerEmail" class="color-blue-dark">E-Mail Adresse</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(erforderlich)</em>
            </div>

            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control validate-password" id="txtNeuerAnsprechpartnerPasswort" placeholder="Passwort" value="12345">
                <label for="txtNeuerAnsprechpartnerPasswort" class="color-blue-dark">Passwort</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(erforderlich)</em>
            </div>
           <!-- <p class="text-center pb-0 mb-n1 pt-1">
                <a href="#" data-menu="menu-signin" class="text-center font-11 color-gray-dark">Already Registered? Sign In Here.</a>
            </p> -->
            <a href="#" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-blue-dark mt-4 mb-3" onclick="benutzerAnlegen()">Registrierung abschließen</a>
        </div>
    </div>

    <div id="menu-forgot" class="menu menu-box-bottom menu-box-detached rounded-m"
         data-menu-effect="menu-parallax">
        <div class="me-3 ms-3 mt-4">
            <h2 class="text-uppercase font-900 mb-0">Passwort vergessen?</h2>
            <p class="font-11 mb-3">
                Kein Problem, geben Sie hier bitte Ihre E-Mail Adresse ein und Sie erhalten sofort ein neues Passwort.
            </p>
            <div class="input-style no-borders has-icon validate-field mb-4">
                <i class="fa fa-at"></i>
                <input type="email" class="form-control validate-email" id="form1a4" placeholder="E-Mail Adresse">
                <label for="form1a4" class="color-blue-dark">E-Mail Adresse</label>
                <i class="fa fa-times disabled invalid color-red-dark"></i>
                <i class="fa fa-check disabled valid color-green-dark"></i>
                <em>(erforderlich)</em>
            </div>
            <a href="#" class="btn btn-full btn-m shadow-l rounded-s bg-highlight text-uppercase font-900 mb-3">Neues Passwort zusenden</a>
        </div>
    </div>



</div>


<script src="{{ URL::asset('mobile-ios/assets/libs/jquery/jquery-3.6.3.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('mobile-ios/assets/libs/toastify/toastify.js') }}"></script>


<script type="text/javascript" src="{{ URL::asset('mobile-ios/scripts/custom.js') }}"></script>


<script>
    function benutzerAnlegen() {
        var email = $('#txtNeuerAnsprechpartnerEmail').val().trim();
        var vorname = $('#txtNeuerAnsprechpartnerVorname').val().trim();
        var passwort = $('#txtNeuerAnsprechpartnerPasswort').val().trim();

        if (vorname == "") {
            Toastify({
                text: "Bitte geben Sie Ihren Vornamen an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (email == "") {
            Toastify({
                text: "Bitte geben Sie eine E-Mail Adresse an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }
        if (validateEmail(email)) {
        } else {
            Toastify({
                text: "Bitte geben Sie eine gültige E-Mail Adresse an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

        if (passwort == "") {
            Toastify({
                text: "Bitte geben Sie ein Passwort an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

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

        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('user.anlegen') }}",
            data: {'vorname': vorname,
                   'passwort': passwort,
                   'email': email },
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
                        text: "Herzlich willkommen :)",
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


    function login() {
        var username = $('#txtLoginUsername').val().trim();
        var password = $('#txtLoginPassword').val().trim();

        if (username == "") {
            Toastify({
                text: "Bitte geben Sie Ihre E-Mail Adresse an.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }


        if (password == "") {
            Toastify({
                text: "Bitte geben Sie Ihr Passwort ein.",className:"info",duration: 5000,position:"center",stopOnFocus: true,
                style: {
                    background:"#FA896B"
                }
            }).showToast();
            return false;
        }

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

        $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{ route('login') }}",
            data: {'email': username,
                   'password': password },
            success: function(data) {
                console.log(data);
                if(data.ergebnis == "fehler") {
                    Swal.fire({
                        title: 'Fehler',
                        text: data.text2,
                        type: 'error',
                        icon: 'error',
                        confirmButtonColor: '#6ADA7D'
                    });
                } else {
                    alert("W");
                    Toastify({
                        text: "Herzlich willkommen :)",
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



    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

</script>
</body>
