<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function generierePasswort($passwordlength = 8,
                                      $numNonAlpha = 0,
                                      $numNumberChars = 0,
                                      $useCapitalLetter = false ) {

        $numberChars = '123456789';
        $specialChars = '!$@';
        $secureChars = 'abcdefghjkmnpqrstuvwxyzQWERTZUIOPASDFGHJKLYXCVBNM';
        $stack = '';

        // Stack für Password-Erzeugung füllen
        $stack = $secureChars;

        if ( $useCapitalLetter == true )
            $stack .= strtoupper ( $secureChars );

        $count = $passwordlength - $numNonAlpha - $numNumberChars;
        $temp = str_shuffle ( $stack );
        $stack = substr ( $temp , 0 , $count );

        if ( $numNonAlpha > 0 ) {
            $temp = str_shuffle ( $specialChars );
            $stack .= substr ( $temp , 0 , $numNonAlpha );
        }

        if ( $numNumberChars > 0 ) {
            $temp = str_shuffle ( $numberChars );
            $stack .= substr ( $temp , 0 , $numNumberChars );
        }


        // Stack durchwürfeln
        $stack = str_shuffle ( $stack );

        // Rückgabe des erzeugten Passwort
        return $stack;

    }

    public function logout(Request $request)
    {

        if (Auth::check()) {
            // Benutzer ausloggen
            Auth::logout();
        }

        // Optional: Sitzungsinformationen löschen
        session()->flush();

        // Weiterleitung zu einer anderen Seite, z.B. zur Startseite
        $zielUrl = route('splash');

        // Geben Sie die URL zurück
        return response()->json(['url' => $zielUrl]);

    }


    public function userAnlegen(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $vorname = trim($request->vorname);
        $email = trim($request->email);
        $passwortLesbar = trim($request->passwort);

       // $passwortLesbar = $this->generierePasswort(8, 3, 5, true);
        $passwort = Hash::make($passwortLesbar);


        // Ermittlung ob der Benutzer bzw. E-Mail Adresse besteht
        try {
            $stmt = $pdo->prepare("SELECT
                                        id
                                    FROM
                                        users
                                    WHERE
                                        email = '".$email."'");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Die E-Mail Adresse existiert schon, haben Sie ihr Passwort vergessen? Dann können Sie es sich ein Neues zusenden lassen."));
            }
        } catch (\PDOException $e) {
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Die vorhandenen E-Mail Adresseon konnten nicht ermittelt werden.<br><br>" . $e->getMessage()));
        }




        try {
            $stmt = $pdo->prepare("INSERT INTO `users` (
                                                    `id` ,
                                                    `vorname` ,
                                                    `password`,
                                                    `email`
                                                  ) VALUES (
                                                    NULL ,
                                                    :vorname,
                                                    :passwort,
                                                    :email
                                          )");
            $stmt->bindParam(":passwort",$passwort);
            $stmt->bindParam(":vorname",$vorname);
            $stmt->bindParam(":email",$email);
            $stmt->execute();
            $ansprechpartnerID = $pdo->lastInsertId();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler' , 'text1' => "Fehler" , 'text2' => "Der Benutzer konnte nicht angelegt werden.<br><br>".$e->getMessage()));
        }





        // E-Mail versenden
        // ANREDE basteln
        $apAnrede = "Sehr geehrte Damen und Herren,";
      /*  if ($anrede == "Frau") {
            $apAnrede = "Sehr geehrte Frau " . $nachname . ",";
        } elseif ($anrede == "Herr") {
            $apAnrede = "Sehr geehrter Herr " .$nachname . ",";
        }*/

        // Job anlegen
        /*
        $abzuarbeiten_am_ts = time() + 900; // 15 Minuten
        $abzuarbeiten_am = date('Y-m-d H:i:s', $abzuarbeiten_am_ts);
        $status = 0;
        try {
            $stmt = $this->pdo_janus->prepare("INSERT INTO `" . MYSQL_DABA_BACKEND_JANUS . "`.`jobs` (
																									 `ID`,
																									 `sonID`,
																									 `erstellt_durch`,
																									 `erstellt_am`,
																									 `empfaenger_email`,
																									 `job`,
																									 `abzuarbeiten_am`,
																									 `abzuarbeiten_am_ts`,
																									 `dummy1`,
																									 `dummy2`,
																									 `dummy3`,
																									 `status`)
																								 VALUES
																									 (NULL,
																									 NULL,
																									 :benutzerID,
																									 NOW(),
																									 :empfaengerEmail,
																									 'delphi_neuer_benutzer_email_senden',
																									 :abzuarbeiten_am,
																									 :abzuarbeiten_am_ts,
																									 :dummy1,
																									 :dummy2,
																									 :dummy3,
																									 :status)");

            $stmt->bindParam(":benutzerID", $_SESSION['benutzer']['janus_benutzerID']);
            $stmt->bindParam(":empfaengerEmail", $benutzername);
            $stmt->bindParam(":abzuarbeiten_am", $abzuarbeiten_am);
            $stmt->bindParam(":abzuarbeiten_am_ts", $abzuarbeiten_am_ts);
            $stmt->bindParam(":dummy1", $apAnrede);
            $stmt->bindParam(":dummy2", $benutzername);
            $stmt->bindParam(":dummy3", $apPassword);
            $stmt->bindParam(":status", $status);

            $stmt->execute();
            //$objEvent->eventEintragen("DELPHI-Benutzer Anmeldeinformationen - E-Mail ", "Der Job zum Senden der DELPHI-Benutzer Anmeldeinformationen E-Mail wurde angelegt.", $kundeID, $_SESSION['benutzer']['benutzerID'], false, null, date('Y-m-d H:i:s'));


        } catch (Exception $e) {
            $objEmail->sendeFehler('Der Job zum versenden der DELPHI-Benutzer Anmeldeinformationen E-Mail '.$benutzername.' konnte nicht angelegt werden. DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS');
            //return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Der Job zum versenden der DELPHI-Benutzer Anmeldeinformationen E-Mail konnte nicht angelegt werden.<br><br>" . $e->getMessage()));
        }
        return json_encode(array('ergebnis' => 'erfolgreich' , 'text1' => "Erfolgreich" , 'text2' => "Der Ansprechpartner wurde erfolgreich angelegt." , 'text3' => $ansprechpartnerID));
*/




        $emailInhalt = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 15]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>*|MC:MC_SUBJECT|*</title>
    <style>
    img {
        -ms-interpolation-mode: bicubic;
    }

    table, td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }

    .mceStandardButton, .mceStandardButton td, .mceStandardButton td a {
        mso-hide: all !important;
    }

    p, a, li, td, blockquote {
        mso-line-height-rule: exactly;
    }

    p, a, li, td, body, table, blockquote {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    @media only screen and (max-width: 480px) {
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: none !important;
        }
    }

    .mcnPreviewText {
        display: none !important;
    }

    .bodyCell {
        margin: 0 auto;
        padding: 0;
        width: 100%;
    }

    .ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font {
        line-height: 100%;
    }

    .ReadMsgBody {
        width: 100%;
    }

    .ExternalClass {
        width: 100%;
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    body {
        height: 100%;
        margin: 0px;
        padding: 0px;
        width: 100%;
        background-color: rgb(255, 255, 255);
    }

    p {
        margin: 0px;
        padding: 0px;
    }

    table {
        border-collapse: collapse;
    }

    td, p, a {
        word-break: break-word;
    }

    h1, h2, h3, h4, h5, h6 {
        display: block;
        margin: 0px;
        padding: 0px;
    }

    img, a img {
        border: 0px;
        height: auto;
        outline: none;
        text-decoration: none;
    }

    @media only screen and (max-width: 480px) {
        body {
            width: 100% !important;
            min-width: 100% !important;
        }

        img {
            height: auto !important;
        }

        .mceColumn {
            display: block !important;
            width: 100% !important;
        }

        .mceSpacing-24 {
            padding-right: 12px !important;
            padding-left: 12px !important;
        }

        .mceFooterSection .mceText, .mceFooterSection .mceText p, .mceFooterSection span {
            font-size: 16px !important;
            line-height: 150% !important;
        }

        .mceText, .mceText p {
            font-size: 16px !important;
            line-height: 150% !important;
        }

        h1 {
            font-size: 36px !important;
            line-height: 125% !important;
        }
    }

    body {
        background-color: rgb(244, 244, 244);
    }

    .mceText h1, .mceText h2, .mceText h3, .mceText h4 {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText, .mceLabel {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText h1, .mceText h2, .mceText h3, .mceText h4 {
        color: rgb(0, 0, 0);
    }

    .mceText, .mceLabel {
        color: rgb(0, 0, 0);
    }

    .mceSpacing-12 label {
        margin-bottom: 12px;
    }

    .mceSpacing-12 input {
        margin-bottom: 12px;
    }

    .mceSpacing-12 .mceInput + .mceErrorMessage {
        margin-top: -6px;
    }

    .mceSpacing-24 h1 {
        margin-bottom: 24px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 p {
        margin-bottom: 24px;
    }

    .mceSpacing-24 p:last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 label {
        margin-bottom: 24px;
    }

    .mceSpacing-24 input {
        margin-bottom: 24px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .mceInput + .mceErrorMessage {
        margin-top: -12px;
    }

    .mceInput {
        background-color: transparent;
        border: 2px solid rgb(208, 208, 208);
        width: 60%;
        color: rgb(77, 77, 77);
        display: block;
    }

    .mceInput[type="radio"], .mceInput[type="checkbox"] {
        float: left;
        margin-right: 12px;
        display: inline;
        width: auto !important;
    }

    .mceLabel > .mceInput {
        margin-bottom: 0px;
        margin-top: 2px;
    }

    .mceLabel {
        display: block;
    }

    .mceText h1 {
        font-size: 31.248px;
        font-weight: 700;
    }

    .mceText p {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText p {
        font-size: 16px;
    }

    .mceText p {
        color: rgb(0, 0, 0);
    }

    .mceText h1 {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText h1 {
        font-size: 31px;
    }

    .mceText h1 {
        color: rgb(0, 0, 0);
    }
    </style>
</head>
<body>
    <!---->
    <center>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color: rgb(244, 244, 244);">
            <tbody>
                <tr>
                    <td id="root" class="bodyCell" align="center" valign="top">
                        <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="660" style="width:660px;"><tr><td><![endif]-->
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px" role="presentation">
                            <tbody>
                                <tr class="mceRow">
                                    <td style="background-position:center;background-repeat:no-repeat;background-size:cover" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:#ffffff;background-position:center;background-repeat:no-repeat;background-size:cover" class="mceColumn" valign="top" colspan="12" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceSpacing-24" align="center" valign="top">
                                                                        <a href="https://www.telefusion.de" style="display:block" target="_blank">
                                                                            <img width="160.954157782516" style="border:0;width:160.954157782516px;height:auto;max-width:100%;display:block" alt="Logo" src="https://alltago.de/mobile-ios/images/pictures/logo.png" class="">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceSpacing-24" valign="top">
                                                                        <div class="mceText" style="font-size:16px;text-align:center;width:100%">
                                                                            <h1>Willkommen bei ALLTAGO</h1>
                                                                            <p class="last-child">
                                                                                Sie können sich nun in die ALLTAGO-App mit folgenden Angaben einloggen:
                                                                                <br>
                                                                                <br>Benutzer: '.$email.'
                                                                                <br>Passwort: '.$passwortLesbar.'
                                                                                <br>
                                                                                <br>
                                                                                <b>Bitte ändern Sie das Passwort umgehend nach dem ersten einloggen ab.</b>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
    <center>
        <br>
        <br>
        <br>
        <br>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="canspamBarWrapper" style="background-color:#FFFFFF; border-top:1px solid #E5E5E5;">
            <tr>
                <td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
                    <table border="0" cellpadding="0" cellspacing="0" id="canspamBar">
                        <tr>
                            <td align="center" valign="top" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:5px; padding-left:20px; text-align:center;">
                                                                        Bitte antworten Sie nicht auf diese E-Mail. Sie wurde automatisch erstellt.

                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <style type="text/css">
        @media only screen and (max-width: 480px) {
            table#canspamBar td {
                font-size: 14px !important;
            }

            table#canspamBar td a {
                display: block !important;
                margin-top: 10px !important;
            }
        }
        </style>
    </center>
</body>
</html>
';
    //    $mailer = new MailerController();
        // $mailer->sendeEmail('Willkommen bei TELEFLOW',$emailInhalt,$email);


        return ['success'=>''];
    }



    public function benutzerPasswortZuruecksetzen(Request $request) {

        $pdo = DB::connection()->getPdo();

        $email = trim($request->txtNeuesPasswortUsername);

        $benutzerID = null;

        // Ermittlung ob der Benutzer bzw. E-Mail Adresse besteht
        try {
            $stmt = $pdo->prepare("SELECT
                                        id
                                    FROM
                                        users
                                    WHERE
                                        email = '".$email."'");
            $stmt->execute();
            while ($row = $stmt->fetch()) {
                $benutzerID = $row['id'];
            }
        } catch (\PDOException $e) {
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Die vorhandenen E-Mail Adresseon konnten nicht ermittelt werden.<br><br>" . $e->getMessage()));
        }

        if (!empty($benutzerID)) {
            $passwortLesbar = $this->generierePasswort(8, 3, 5, true);
            $passwort = Hash::make($passwortLesbar);
            try {
                $stmt = $pdo->prepare("UPDATE `users` SET
                                            `password` = :passwort
                                   WHERE id = :benutzerID");
                $stmt->bindParam(":benutzerID",$benutzerID);
                $stmt->bindParam(":passwort",$passwort);
                $stmt->execute();
                //$objEvent = new event();
                //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
                //$objEvent = null;
                //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
            } catch(\PDOException $e){
                //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
                return json_encode(array('ergebnis' => 'fehler' , 'text1' => "Fehler" , 'text2' => "Das Passwort konnte nicht zurückgesetzt werden.<br><br>".$e->getMessage()));
            }


            $emailInhalt = '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <!--[if gte mso 15]>
    <xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>*|MC:MC_SUBJECT|*</title>
    <style>
    img {
        -ms-interpolation-mode: bicubic;
    }

    table, td {
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }

    .mceStandardButton, .mceStandardButton td, .mceStandardButton td a {
        mso-hide: all !important;
    }

    p, a, li, td, blockquote {
        mso-line-height-rule: exactly;
    }

    p, a, li, td, body, table, blockquote {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    @media only screen and (max-width: 480px) {
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: none !important;
        }
    }

    .mcnPreviewText {
        display: none !important;
    }

    .bodyCell {
        margin: 0 auto;
        padding: 0;
        width: 100%;
    }

    .ExternalClass, .ExternalClass p, .ExternalClass td, .ExternalClass div, .ExternalClass span, .ExternalClass font {
        line-height: 100%;
    }

    .ReadMsgBody {
        width: 100%;
    }

    .ExternalClass {
        width: 100%;
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    body {
        height: 100%;
        margin: 0px;
        padding: 0px;
        width: 100%;
        background-color: rgb(255, 255, 255);
    }

    p {
        margin: 0px;
        padding: 0px;
    }

    table {
        border-collapse: collapse;
    }

    td, p, a {
        word-break: break-word;
    }

    h1, h2, h3, h4, h5, h6 {
        display: block;
        margin: 0px;
        padding: 0px;
    }

    img, a img {
        border: 0px;
        height: auto;
        outline: none;
        text-decoration: none;
    }

    @media only screen and (max-width: 480px) {
        body {
            width: 100% !important;
            min-width: 100% !important;
        }

        img {
            height: auto !important;
        }

        .mceColumn {
            display: block !important;
            width: 100% !important;
        }

        .mceSpacing-24 {
            padding-right: 12px !important;
            padding-left: 12px !important;
        }

        .mceFooterSection .mceText, .mceFooterSection .mceText p, .mceFooterSection span {
            font-size: 16px !important;
            line-height: 150% !important;
        }

        .mceText, .mceText p {
            font-size: 16px !important;
            line-height: 150% !important;
        }

        h1 {
            font-size: 36px !important;
            line-height: 125% !important;
        }
    }

    body {
        background-color: rgb(244, 244, 244);
    }

    .mceText h1, .mceText h2, .mceText h3, .mceText h4 {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText, .mceLabel {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText h1, .mceText h2, .mceText h3, .mceText h4 {
        color: rgb(0, 0, 0);
    }

    .mceText, .mceLabel {
        color: rgb(0, 0, 0);
    }

    .mceSpacing-12 label {
        margin-bottom: 12px;
    }

    .mceSpacing-12 input {
        margin-bottom: 12px;
    }

    .mceSpacing-12 .mceInput + .mceErrorMessage {
        margin-top: -6px;
    }

    .mceSpacing-24 h1 {
        margin-bottom: 24px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 p {
        margin-bottom: 24px;
    }

    .mceSpacing-24 p:last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 label {
        margin-bottom: 24px;
    }

    .mceSpacing-24 input {
        margin-bottom: 24px;
    }

    .mceSpacing-24 .last-child {
        margin-bottom: 0px;
    }

    .mceSpacing-24 .mceInput + .mceErrorMessage {
        margin-top: -12px;
    }

    .mceInput {
        background-color: transparent;
        border: 2px solid rgb(208, 208, 208);
        width: 60%;
        color: rgb(77, 77, 77);
        display: block;
    }

    .mceInput[type="radio"], .mceInput[type="checkbox"] {
        float: left;
        margin-right: 12px;
        display: inline;
        width: auto !important;
    }

    .mceLabel > .mceInput {
        margin-bottom: 0px;
        margin-top: 2px;
    }

    .mceLabel {
        display: block;
    }

    .mceText h1 {
        font-size: 31.248px;
        font-weight: 700;
    }

    .mceText p {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText p {
        font-size: 16px;
    }

    .mceText p {
        color: rgb(0, 0, 0);
    }

    .mceText h1 {
        font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
    }

    .mceText h1 {
        font-size: 31px;
    }

    .mceText h1 {
        color: rgb(0, 0, 0);
    }
    </style>
</head>
<body>
    <!---->
    <center>
        <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color: rgb(244, 244, 244);">
            <tbody>
                <tr>
                    <td id="root" class="bodyCell" align="center" valign="top">
                        <!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="660" style="width:660px;"><tr><td><![endif]-->
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px" role="presentation">
                            <tbody>
                                <tr class="mceRow">
                                    <td style="background-position:center;background-repeat:no-repeat;background-size:cover" valign="top">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
                                            <tbody>
                                                <tr>
                                                    <td style="background-color:#ffffff;background-position:center;background-repeat:no-repeat;background-size:cover" class="mceColumn" valign="top" colspan="12" width="100%">
                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceSpacing-24" align="center" valign="top">

                                                                            <img width="160.954157782516" style="border:0;width:160.954157782516px;height:auto;max-width:100%;display:block" alt="Logo" src="https://alltago.de/mobile-ios/images/pictures/logo.png" class="">

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceSpacing-24" valign="top">
                                                                        <div class="mceText" style="font-size:16px;text-align:center;width:100%">
                                                                            <h1>Willkommen bei ALLTAGO</h1>
                                                                            <p class="last-child">
                                                                                <br>
                                                                                Sie erhalten diese E-Mail, da für Sie ein neues Passwort beantragt wurde.
                                                                                <br>
                                                                                <br>
                                                                                Sie können sich nun mit folgenden Angaben in der ALLTAGO-App einloggen:
                                                                                <br>
                                                                                <br>Benutzer: '.$email.'
                                                                                <br>Passwort: '.$passwortLesbar.'
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                                <br>
                                                                            </p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
    <center>
        <br>
        <br>
        <br>
        <br>
        <table border="0" cellpadding="0" cellspacing="0" width="100%" id="canspamBarWrapper" style="background-color:#FFFFFF; border-top:1px solid #E5E5E5;">
            <tr>
                <td align="center" valign="top" style="padding-top:20px; padding-bottom:20px;">
                    <table border="0" cellpadding="0" cellspacing="0" id="canspamBar">
                        <tr>
                            <td align="center" valign="top" style="color:#606060; font-family:Helvetica, Arial, sans-serif; font-size:11px; line-height:150%; padding-right:20px; padding-bottom:5px; padding-left:20px; text-align:center;">
                                                                        Bitte antworten Sie nicht auf diese E-Mail. Sie wurde automatisch erstellt.
                                <br>
                                <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <style type="text/css">
        @media only screen and (max-width: 480px) {
            table#canspamBar td {
                font-size: 14px !important;
            }

            table#canspamBar td a {
                display: block !important;
                margin-top: 10px !important;
            }
        }
        </style>
    </center>
</body>
</html>
';
            $mailer = new MailerController();
            $arrErgebnis = $mailer->sendeEmail('Ihr neues Passwort bei ALLTAGO',$emailInhalt,$email);

        } else {
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Die E-Mail Adresse konnte nicht gefunden werden."));
        }


        return json_encode(array('ergebnis' => 'erfolgreich', 'text1' => "", 'text2' => ""));


    }






    public function benutzerPasswortAendern(Request $request) {

        $pdo = DB::connection()->getPdo();

        $txtNeuesPasswort = trim($request->txtNeuesPasswort);
        $benutzerID = Auth::user()->id;

        $passwortLesbar = $txtNeuesPasswort;
        $passwort = Hash::make($passwortLesbar);
        try {
            $stmt = $pdo->prepare("UPDATE `users` SET
                                            `password` = :passwort
                                   WHERE id = :benutzerID");
            $stmt->bindParam(":benutzerID",$benutzerID);
            $stmt->bindParam(":passwort",$passwort);
            $stmt->execute();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler' , 'text1' => "Fehler" , 'text2' => "Das Passwort konnte nicht zurückgesetzt werden.<br><br>".$e->getMessage()));
        }

        return json_encode(array('ergebnis' => 'erfolgreich' , 'text1' => "Fehler" , 'text2' => "Das Passwort wurde erfolgreich geändert."));


    }





    public function einstellungenSpeichern(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $txtVorname = trim($request->txtVorname);
        $txtNachname = trim($request->txtNachname);
        $dateGeburtstag = trim($request->dateGeburtstag);

        if (empty($dateGeburtstag)) $dateGeburtstag = null;

        $benutzerID =  Auth::user()->id;

        try {
            $stmt = $pdo->prepare("UPDATE `users` SET
                                        `vorname` = :vorname,
                                        `nachname` = :nachname,
                                        `geburtstag` = :geburtstag
                                   WHERE id = :benutzerID");
            $stmt->bindParam(":vorname",$txtVorname);
            $stmt->bindParam(":nachname",$txtNachname);
            $stmt->bindParam(":geburtstag",$dateGeburtstag);
            $stmt->bindParam(":benutzerID",$benutzerID);
            $stmt->execute();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Es ist ein Fehler beim Eintragen der Einstellungen aufgetreten.<br><br>" . $e->getMessage()));
        }


        return json_encode(array('ergebnis' => 'erfolgreich', 'text1' => "Die Einstellungen wurde erfolgreich aktualisiert."));

    }


    public function messungEintragen(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $txtNeueMessungDatum = trim($request->txtNeueMessungDatum);
        $txtNeueMessungSys = trim($request->txtNeueMessungSys);
        $txtNeueMessungDia = trim($request->txtNeueMessungDia);
        $txtNeueMessungPuls = trim($request->txtNeueMessungPuls);

        $benutzerID =  Auth::user()->id;

        $tageszeit = '';
        $stunden = substr($txtNeueMessungDatum,11,2);

        $tageszeit = 'morgen';
        if ($stunden >= 5 ) $tageszeit = 'morgen';
        if ($stunden >= 12 ) $tageszeit = 'mittag';
        if ($stunden >= 17 ) $tageszeit = 'abend';

        $hypertonie = 0;
        if ($txtNeueMessungSys >= 130 && $txtNeueMessungSys <= 139) $hypertonie = 1;
        if ($txtNeueMessungDia >= 80 && $txtNeueMessungDia <= 89) $hypertonie = 1;

        if ($txtNeueMessungSys >= 140) $hypertonie = 2;
        if ($txtNeueMessungDia >= 90) $hypertonie = 2;

        $mad = $txtNeueMessungDia + 1/3 * ($txtNeueMessungSys - $txtNeueMessungDia);

        $pulsdruck = $txtNeueMessungSys - $txtNeueMessungDia;


        $datumFeed = substr($txtNeueMessungDatum,0,10);


        setlocale(LC_TIME, 'de_DE');
        date_default_timezone_set('Europe/Berlin');
        $kalenderwoche = strftime("%V", strtotime($datumFeed));


        try {
            $stmt = $pdo->prepare("INSERT INTO `messungen` (
                                                    `messungID` ,
                                                    `userID` ,
                                                    `datum`,
                                                    `datumFeed`,
                                                    `sys`,
                                                    `dia`,
                                                    `mad`,
                                                    `puls`,
                                                    `pulsdruck`,
                                                    `hypertonie`,
                                                    `tageszeit`,
                                                    `kalenderwoche`,
                                                    `eingetragenAm`
                                                  ) VALUES (
                                                    NULL ,
                                                    :userID,
                                                    :datum,
                                                    :datumFeed,
                                                    :sys,
                                                    :dia,
                                                    :mad,
                                                    :puls,
                                                    :pulsdruck,
                                                    :hypertonie,
                                                    :tageszeit,
                                                    :kalenderwoche,
                                                    NOW()
                                          )");
            $stmt->bindParam(":userID",$benutzerID);
            $stmt->bindParam(":datum",$txtNeueMessungDatum);
            $stmt->bindParam(":datumFeed",$datumFeed);
            $stmt->bindParam(":sys",$txtNeueMessungSys);
            $stmt->bindParam(":dia",$txtNeueMessungDia);
            $stmt->bindParam(":mad",$mad);
            $stmt->bindParam(":puls",$txtNeueMessungPuls);
            $stmt->bindParam(":pulsdruck",$pulsdruck);
            $stmt->bindParam(":tageszeit",$tageszeit);
            $stmt->bindParam(":kalenderwoche",$kalenderwoche);
            $stmt->bindParam(":hypertonie",$hypertonie);
            $stmt->execute();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Es ist ein Fehler beim Eintragen der Messung aufgetreten.<br><br>" . $e->getMessage()));
        }


        return json_encode(array('ergebnis' => 'erfolgreich', 'text1' => "Die Messung wurde erfolgreich eingetragen."));

    }


    public function messungBearbeiten(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $messungID = trim($request->aktuelleMessungID);
        $txtNeueMessungDatum = trim($request->txtMessungBearbeitenDatum);
        $txtNeueMessungSys = trim($request->txtMessungBearbeitenSys);
        $txtNeueMessungDia = trim($request->txtMessungBearbeitenDia);
        $txtNeueMessungPuls = trim($request->txtMessungBearbeitenPuls);

        $benutzerID =  Auth::user()->id;

        $tageszeit = '';
        $stunden = substr($txtNeueMessungDatum,11,2);

        $tageszeit = 'morgen';
        if ($stunden >= 5 ) $tageszeit = 'morgen';
        if ($stunden >= 12 ) $tageszeit = 'mittag';
        if ($stunden >= 17 ) $tageszeit = 'abend';

        $hypertonie = 0;
        if ($txtNeueMessungSys >= 130 && $txtNeueMessungSys <= 139) $hypertonie = 1;
        if ($txtNeueMessungDia >= 80 && $txtNeueMessungDia <= 89) $hypertonie = 1;

        if ($txtNeueMessungSys >= 140) $hypertonie = 2;
        if ($txtNeueMessungDia >= 90) $hypertonie = 2;

        $mad = $txtNeueMessungDia + 1/3 * ($txtNeueMessungSys - $txtNeueMessungDia);

        $pulsdruck = $txtNeueMessungSys - $txtNeueMessungDia;


        $datumFeed = substr($txtNeueMessungDatum,0,10);


        try {
            $stmt = $pdo->prepare("UPDATE `messungen` SET
                                                    `datum` = :datum,
                                                    `datumFeed` = :datumFeed,
                                                    `sys` = :sys,
                                                    `dia` = :dia,
                                                    `mad` = :mad,
                                                    `puls` = :puls,
                                                    `pulsdruck` = :pulsdruck,
                                                    `hypertonie` = :hypertonie,
                                                    `tageszeit` = :tageszeit,
                                                    `eingetragenAm` = NOW()
                                          WHERE messungID = :messungID
                                          AND userID = :userID");
            $stmt->bindParam(":messungID",$messungID);
            $stmt->bindParam(":userID",$benutzerID);
            $stmt->bindParam(":datum",$txtNeueMessungDatum);
            $stmt->bindParam(":datumFeed",$datumFeed);
            $stmt->bindParam(":sys",$txtNeueMessungSys);
            $stmt->bindParam(":dia",$txtNeueMessungDia);
            $stmt->bindParam(":mad",$mad);
            $stmt->bindParam(":puls",$txtNeueMessungPuls);
            $stmt->bindParam(":pulsdruck",$pulsdruck);
            $stmt->bindParam(":tageszeit",$tageszeit);
            $stmt->bindParam(":hypertonie",$hypertonie);
            $stmt->execute();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Es ist ein Fehler beim Eintragen der Messung aufgetreten.<br><br>" . $e->getMessage()));
        }


        return json_encode(array('ergebnis' => 'erfolgreich', 'text1' => "Die Messung wurde erfolgreich eingetragen."));

    }



    public function messungLoeschen(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $messungID = trim($request->aktuelleMessungID);

        $benutzerID =  Auth::user()->id;

        try {
            $stmt = $pdo->prepare("DELETE FROM `messungen`
                                          WHERE messungID = :messungID
                                          AND userID = :userID");
            $stmt->bindParam(":messungID",$messungID);
            $stmt->bindParam(":userID",$benutzerID);
            $stmt->execute();
            //$objEvent = new event();
            //$arr = $objEvent->eventEintragen("Ansprechpartner", "Ein neuer Ansprechpartner (\"".$nachname.", ".$vorname."\") wurde angelegt". $text_add .".", $kundeID, $_SESSION['benutzer']['benutzerID'], false);
            //$objEvent = null;
            //$objKunden->updateKundenLetztesUpdateDatum($kundeID);
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler', 'text1' => "Fehler", 'text2' => "Es ist ein Fehler beim Löschen der Messung aufgetreten.<br><br>" . $e->getMessage()));
        }


        return json_encode(array('ergebnis' => 'erfolgreich', 'text1' => "Die Messung wurde erfolgreich gelöscht."));

    }


    function holeFeed(Request $request) {
        $pdo = DB::connection()->getPdo();

        $benutzerID = Auth::user()->id;

        $sqlLimit = '';
        if(isset($request->lim) && !empty($request->lim)) $sqlLimit = ' LIMIT '.$request->offset.','.$request->lim;

        $objAllgemein = new AllgemeinController();

        $events = '';

        $query=$pdo->prepare("SELECT
                                    *
                                FROM
                                    messungen
                                 WHERE
                                     messungen.userID = ".$benutzerID." ORDER BY messungen.datum DESC ".$sqlLimit);
        $query->execute();
        $letztesDatum = '';



        while($r=$query->fetch(\PDO::FETCH_BOTH)) {

            // Anzahl der Messungen ermitteln
            $anzahlMessungen = 0;
            $query_anzahl=$pdo->prepare("SELECT
                                            count(messungen.messungID) as anzahl
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".substr($r['datum'],0,10)."%'");
            $query_anzahl->execute();
            while($r_anzahl=$query_anzahl->fetch(\PDO::FETCH_BOTH)) {
                $anzahlMessungen = $r_anzahl['anzahl'];
            }


            // Summe von Hypertonie errechnen
            $summeHypertonie = 0;
            $query_summe=$pdo->prepare("SELECT
                                            sum(messungen.hypertonie) as summe
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".substr($r['datum'],0,10)."%'");
            $query_summe->execute();
            while($r_summe=$query_summe->fetch(\PDO::FETCH_BOTH)) {
                $summeHypertonie = $r_summe['summe'];
            }

            // Berechnung des Durchschnitts
            $durchschnitt = $summeHypertonie / $anzahlMessungen;



            $iconTageszeit = '';
            if ($r['tageszeit'] == 'morgen') $iconTageszeit = '<i class="fa-solid fa-mug-saucer"></i>&nbsp;&nbsp;Morgens um ';
            if ($r['tageszeit'] == 'mittag') $iconTageszeit = '<i class="fa-solid fa-cloud-sun"></i></i>&nbsp;&nbsp;Mittags um ';
            if ($r['tageszeit'] == 'abend') $iconTageszeit = '<i class="fa-solid fa-bed"></i>&nbsp;&nbsp;Abends um ';

            $iconInformation = '';
            $farbe = '';
            $beschreibung = '';
            if ($r['hypertonie'] == 0) {
                $farbe = 'green';
                $iconInformation = '<i class="fa fa-check color-'.$farbe.'-dark font-11"></i>';
                $beschreibung = 'Optimaler Blutdruck';
            }
            if ($r['hypertonie'] == 1) {
                $farbe = 'yellow';
                $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbe.'-dark font-11"></i>';
                $beschreibung = 'Milde Hypertonie (Grad 1)';
            }
            if ($r['hypertonie'] == 2) {
                $farbe = 'red';
                $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbe.'-dark font-11"></i>';
                $beschreibung = 'Hypertonie (Grad 2)';
            }

            /*
            $events .= '<div class="acitivity-item py-3 d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="avatar-xs acitivity-avatar">
                                                <div class="avatar-title rounded-circle bg-soft-info text-info">
                                                    <img src="'.$_ENV['APP_URL'].'/intern/pictures/users/'.$r['erstellt_profilbild'].'" alt="" class="avatar-xs rounded-circle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="mb-1">'. $r['firma'].'</h5>
                                            <h6 class="mb-1">'. $r['rubrik'].'</h6>
                                            <p class="text-muted mb-2">'. $r['aktion'].'</p>
                                            <small class="mb-0 text-muted">'.$objAllgemein->sqldate2date($r['zeitstempel']).' (vor '.$objAllgemein->humanTiming($r['zeitstempel']).')</small>
                                        </div>
                                    </div>
            ';*/

            if (!empty($letztesDatum)) {
                if ($letztesDatum != substr($r['datum'],0,10)) {
                /*    $events.= ' <div class="timeline-item">
                                <i style="font-size:10px" class="far  bg-blue-dark shadow-l timeline-icon">'. substr($r['datum'],0,10).'</i>
                                <div class="timeline-item-content rounded-s shadow-l">
                                    <h5 class="font-300 text-center">
                                        '. $r['datum'].'<br>'. $r['tageszeit'].'<br><br>SYS:'. $r['sys'].'<br>DIA:'. $r['dia'].'<br>Puls:'. $r['puls'].'
                                    </h5>
                                </div>
                            </div>';
*/





                    $durchschnittHTML = '<p></p>
                                            <div class="alert mb-4 rounded-s bg-red-dark" role="alert">
                                                <span class="alert-icon"><i class="fa fa-exclamation font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                <strong class="alert-icon-text">Der Blutdruck war erhöht an diesem Tag.</strong>
                                            </div>     ';

                    if ($durchschnitt < 1.5) {
                        $durchschnittHTML = '<p></p>
                                                <div class="alert mb-4 rounded-s bg-yellow-dark" role="alert">
                                                    <span class="alert-icon"><i class="fa fa-exclamation font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                    <strong class="alert-icon-text">Der Blutdruck war leicht erhöht an diesem Tag.</strong>
                                                </div>     ';
                    }

                    if ($durchschnitt < 1) {
                        $durchschnittHTML = '<p></p>
                                                <div class="alert mb-4 rounded-s bg-green-dark p-3" role="alert">
                                                    <span class="alert-icon"><i class="fa fa-check font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                    <strong class="alert-icon-text">Der Blutdruck war optimal an diesem Tag.</strong>
                                                </div>    ';
                    }



                    $events .= $durchschnittHTML;


                /*    $events.= '     <div class="timeline-item-content rounded-s shadow-l">
                                    <h5 class="font-300 text-center">
                                        <i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).'<br>
                                    </h5>
                                </div>
                                ';*/
                    $events .= '<div class="card card-style mb-3 ">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="align-self-start">
                                                <h4 class="mb-0 font-18">'.$iconTageszeit. substr($r['datum'],11,5).' Uhr<br></h4>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$r['sys'].'/'.$r['dia'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$r['puls'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$r['mad'].'</span>
                                            </div>
                                            <div class="align-self-start ms-auto ps-3">
                                                <span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
                                                    '.$iconInformation.'
                                                </span>
                                            </div>
                                        </div>
                                        <div class="divider mt-2 mb-2"></div>
                                        <div class="d-flex">
                                            <div class="align-self-center">
                                                <span class="font-12 color-theme opacity-70 font-500">'.$beschreibung.'</span>
                                            </div>
                                            <div class="align-self-center ms-auto">
                                                <span class="font-12 color-theme opacity-30 font-500"><i class="fa-regular fa-pen-to-square"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-overlay bg-'.$farbe.'-dark opacity-30"></div>
                                </div>';

                } else {

                 /*   $events.= ' <div class="timeline-item">
                                <div class="card rounded-s shadow-l m-3">
                                    <h5 class="font-300 text-center">
                                        '. $r['datum'].'<br>'. $r['tageszeit'].'<br><br>SYS:'. $r['sys'].'<br>DIA:'. $r['dia'].'<br>Puls:'. $r['puls'].'
                                    </h5>
                                </div>
                            </div>';
                    */


                    $events .= '<div class="card card-style mb-3">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="align-self-start">
                                                <h4 class="mb-0 font-18">'.$iconTageszeit. substr($r['datum'],11,5).' Uhr<br></h4>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$r['sys'].'/'.$r['dia'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$r['puls'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$r['mad'].'</span>
                                            </div>
                                            <div class="align-self-start ms-auto ps-3">
                                                <span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
                                                    '.$iconInformation.'
                                                </span>
                                            </div>
                                        </div>
                                        <div class="divider mt-2 mb-2"></div>
                                        <div class="d-flex">
                                            <div class="align-self-center">
                                                <span class="font-12 color-theme opacity-70 font-500">'.$beschreibung.'</span>
                                            </div>
                                            <div class="align-self-center ms-auto">
                                                <span class="font-12 color-theme opacity-30 font-500"><i class="fa-regular fa-pen-to-square"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-overlay bg-'.$farbe.'-dark opacity-30"></div>
                                </div>';
                }

            } else {
              /*  $events.= '     <div class="timeline-item-content rounded-s shadow-l">
                                    <h5 class="font-300 text-center">
                                        <i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).'<br>
                                    </h5>
                                </div>
                                ';
*/



                $durchschnittHTML = '<p></p>
                                            <div class="alert mb-4 rounded-s bg-red-dark" role="alert">
                                                <span class="alert-icon"><i class="fa fa-exclamation font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                <strong class="alert-icon-text">Der Blutdruck war erhöht an diesem Tag.</strong>
                                            </div>     ';

                if ($durchschnitt < 1.5) {
                    $durchschnittHTML = '<p></p>
                                                <div class="alert mb-4 rounded-s bg-yellow-dark" role="alert">
                                                    <span class="alert-icon"><i class="fa fa-exclamation font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                    <strong class="alert-icon-text">Der Blutdruck war leicht erhöht an diesem Tag.</strong>
                                                </div>     ';
                }

                if ($durchschnitt < 1) {
                    $durchschnittHTML = '<p></p>
                                                <div class="alert mb-4 rounded-s bg-green-dark p-3" role="alert">
                                                    <span class="alert-icon"><i class="fa fa-check font-18"></i></span>
                                                <h4 class="text-uppercase color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$objAllgemein->sqldate2date($r['datum']).' Anzahl:'.$anzahlMessungen.' Summe:'.$summeHypertonie.' Schnitt:'.$durchschnitt.'</h4>
                                                    <strong class="alert-icon-text">Der Blutdruck war optimal an diesem Tag.</strong>
                                                </div>    ';
                }



                $events .= $durchschnittHTML;


                $events .= '<div class="card card-style mb-3">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="align-self-start">
                                                <h4 class="mb-0 font-18">'.$iconTageszeit. substr($r['datum'],11,5).' Uhr<br></h4>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$r['sys'].'/'.$r['dia'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$r['puls'].'</span><br>
                                                <span class="font-12 color-theme font-500"><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$r['mad'].'</span>
                                            </div>
                                            <div class="align-self-start ms-auto ps-3">
                                                <span class="icon icon-xxs rounded-xl bg-white color-brown-dark">
                                                    '.$iconInformation.'
                                                </span>
                                            </div>
                                        </div>
                                        <div class="divider mt-2 mb-2"></div>
                                        <div class="d-flex">
                                            <div class="align-self-center">
                                                <span class="font-12 color-theme opacity-70 font-500">'.$beschreibung.'</span>
                                            </div>
                                            <div class="align-self-center ms-auto">
                                                <span class="font-12 color-theme opacity-30 font-500"><i class="fa-regular fa-pen-to-square"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-overlay bg-'.$farbe.'-dark opacity-30"></div>
                                </div>';
            }


            $letztesDatum = substr($r['datum'],0,10);

        }


        return ['success'=>'','events'=>$events];
    }



    function holeFeed2(Request $request) {
        $pdo = DB::connection()->getPdo();

        $benutzerID = Auth::user()->id;

        $limitTage = 4;
        $events = '';

        $objAllgemein = new AllgemeinController();

        $sqlWHERE = '';
        if (!empty($request->letztesDatum)) $sqlWHERE =' AND datumFeed < \''.$request->letztesDatum.'\' ';

        $arrTage = array();
        $query=$pdo->prepare("SELECT
                                    DISTINCT(datumFeed)
                                FROM
                                    messungen
                                 WHERE
                                     messungen.userID = ".$benutzerID."
                                ".$sqlWHERE."
                                 ORDER BY messungen.datumFeed DESC LIMIT ".$limitTage);
        $query->execute();
        while($r=$query->fetch(\PDO::FETCH_BOTH)) {
            array_push($arrTage,$r['datumFeed']);
        }


       // var_dump($arrTage);
        $letztesDatum = end($arrTage);

        if (count($arrTage) == 0) {
            return ['success'=>'','events'=>$events,'letztesDatum'=>$letztesDatum];
        } else {
            foreach ($arrTage as $tag) {


                // Anzahl der Messungen ermitteln
                $anzahlMessungen = 0;
                $query_anzahl=$pdo->prepare("SELECT
                                            count(messungen.messungID) as anzahl
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".$tag."%'");
                $query_anzahl->execute();
                while($r_anzahl=$query_anzahl->fetch(\PDO::FETCH_BOTH)) {
                    $anzahlMessungen = $r_anzahl['anzahl'];
                }


                // Summe von Hypertonie errechnen
                $summeHypertonie = 0;
                $query_summe=$pdo->prepare("SELECT
                                            sum(messungen.hypertonie) as summe
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".$tag."%'");
                $query_summe->execute();
                while($r_summe=$query_summe->fetch(\PDO::FETCH_BOTH)) {
                    $summeHypertonie = $r_summe['summe'];
                }

                // Berechnung des Durchschnitts
                $durchschnitt = $summeHypertonie / $anzahlMessungen;


                $farbeHeader = 'danger';
                $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
                $beschreibung = 'Hypertonie an diesem Tag im Durchschnitt.';
                if ($durchschnitt < 1.5) {
                    $farbeHeader = 'warning';
                    $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
                    $beschreibung = 'Milde Hypertonie an diesem Tag im Durchschnitt.';
                }
                if ($durchschnitt < 1) {
                    $farbeHeader = 'success';
                    $iconInformation = '<i class="fa fa-check color-'.$farbeHeader.'-dark font-11"></i>';
                    $beschreibung = 'Optimaler Blutdruck an diesem Tag im Durschnitt.';
                }

                $timestamp = strtotime($tag);
                $wochentag = date("l", $timestamp);
                if ($wochentag == 'Monday') $wochentag = 'Montag';
                if ($wochentag == 'Tuesday') $wochentag = 'Dienstag';
                if ($wochentag == 'Wednesday') $wochentag = 'Mittwoch';
                if ($wochentag == 'Thursday') $wochentag = 'Donnerstag';
                if ($wochentag == 'Friday') $wochentag = 'Freitag';
                if ($wochentag == 'Saturday') $wochentag = 'Samstag';
                if ($wochentag == 'Sunday') $wochentag = 'Sonntag';

                $events .= '<div class="calendar bg-theme shadow-xl rounded-m">
                                <div class="cal-footer">
                                    <h6 class="cal-sub-title uppercase bold bg-'.$farbeHeader.' color-white"><i class="fa-solid fa-calendar-days"></i>&nbsp;&nbsp;'.$wochentag.', '.$objAllgemein->sqldate2date($tag).'</h6>
                                    <span class="cal-message mt-3 mb-3">
                                        <strong class="">'.$beschreibung.'</strong>
                                    </span>
                                    <div class="divider mb-0"></div>';


                // Messungen selektieren
                $query=$pdo->prepare("SELECT
                                    *
                                FROM
                                    messungen
                                 WHERE
                                     datumFeed = '".$tag."' AND
                                     messungen.userID = ".$benutzerID." ORDER BY messungen.datum DESC");
                $query->execute();
                while($r=$query->fetch(\PDO::FETCH_BOTH)) {
                    $iconTageszeit = '';
                    if ($r['tageszeit'] == 'morgen') $iconTageszeit = '<i class="fa-solid fa-mug-saucer"></i>&nbsp;&nbsp;Morgens';
                    if ($r['tageszeit'] == 'mittag') $iconTageszeit = '<i class="fa-solid fa-cloud-sun"></i></i>&nbsp;&nbsp;Mittags';
                    if ($r['tageszeit'] == 'abend') $iconTageszeit = '<i class="fa-solid fa-bed"></i>&nbsp;&nbsp;Abends';



                    $iconInformation = '';
                    $farbe = '';
                    $beschreibung = '';
                    if ($r['hypertonie'] == 0) {
                        $farbe = '#DCEDCC';
                        $iconInformation = '<i class="fa fa-check color-'.$farbe.'-dark font-11"></i>';
                        $beschreibung = 'Optimaler Blutdruck';
                    }
                    if ($r['hypertonie'] == 1) {
                        $farbe = '#FCEBCA';
                        $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbe.'-dark font-11"></i>';
                        $beschreibung = 'Milde Hypertonie';
                    }
                    if ($r['hypertonie'] == 2) {
                        $farbe = '#FFC7BB';
                        $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbe.'-dark font-11"></i>';
                        $beschreibung = 'Hypertonie';
                    }

                    $events .= ' <div class="cal-schedule " style="background-color:'.$farbe.'">
                                <em>'.$iconTageszeit.'<br>'.substr($r['datum'],11,5).' Uhr<br><div class="text-muted" onclick="zeigeMessungBearbeitenModal(\''.$r['messungID'].'\',\''.$r['datum'].'\',\''.$r['sys'].'\',\''.$r['dia'].'\',\''.$r['puls'].'\')"><i class="fa-regular fa-pen-to-square mt-4"></i>&nbsp;&nbsp;Bearbeiten</div></em>

                                <strong class="d-block mb-n2"><i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$r['sys'].'/'.$r['dia'].'</strong>
                                <span><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$r['mad'].'</span>
                                <strong class="d-block mb-n2"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$r['puls'].'</strong>
                                <span><i class="fa-solid fa-heart-pulse"></i>&nbsp;Pulsdruck: '.$r['pulsdruck'].'</span>
                            </div>';


                }


                $events .= '</div>
                    </div>';


            }
        }


        return ['success'=>'','events'=>$events,'letztesDatum'=>$letztesDatum ];
    }


    function holeFeedWochenbuch(Request $request) {
        $pdo = DB::connection()->getPdo();

        $benutzerID = Auth::user()->id;

        $limitTage = 60;
        $events = '';
        $erstesDatum = '';
        $letztesDatum = '';
        $letzteKalenderwoche = '';
        $info = '';
        $detailTagesEintraege = '';
        $arrStatistikWochentage = array();
        $arrStatistikSys = array();
        $arrStatistikDia = array();
        $arrStatistikPuls = array();

        $objAllgemein = new AllgemeinController();

        setlocale(LC_TIME, 'de_DE');
        date_default_timezone_set('Europe/Berlin');


        $sqlWHERE = '';
        if (!empty($request->letzteKalenderwoche)) $sqlWHERE =' AND kalenderwoche < \''.$request->letzteKalenderwoche.'\' ';


        // Tage ermitteln
        $arrTage = array();
        $kalenderwoche = '';
        $query=$pdo->prepare("SELECT
                                    DISTINCT(datumFeed)
                                FROM
                                    messungen
                                 WHERE
                                     messungen.userID = ".$benutzerID."
                                ".$sqlWHERE."
                                 ORDER BY messungen.datumFeed DESC LIMIT ".$limitTage);
        $query->execute();
        while($r=$query->fetch(\PDO::FETCH_BOTH)) {
            if (empty($kalenderwoche)) {
                // Erster Aufruf
                $kalenderwoche = strftime("%V", strtotime($r['datumFeed']));
                array_push($arrTage,$r['datumFeed']);
            } else {
                if ($kalenderwoche == strftime("%V", strtotime($r['datumFeed']))) {
                    // Gleiche Kalenderwoche
                    array_push($arrTage,$r['datumFeed']);
                } else {
                   // Andere Kalendewoche
                }
            }
        }
        //print_r($arrTage);
        /////////////////////////////

        if (count($arrTage) == 0) return ['success'=>'','events'=>$events,'kalenderwoche'=>$kalenderwoche];

        // Datum-Array sortieren
        $arrTage = array_reverse($arrTage);
        reset($arrTage);
        $erstesDatum = (current($arrTage)!==false) ? current($arrTage) : null;
        end($arrTage);
        $letztesDatum = (current($arrTage)!==false) ? current($arrTage) : null;

        $sqlDatum = '';
        foreach ($arrTage as $datum) {
            $sqlDatum .= "'".$datum."',";
        }
        $sqlDatum = substr($sqlDatum, 0, -1);

        // Durschnittswerte selektieren
        $query=$pdo->prepare("SELECT
                                    AVG(sys) AS sys,
                                    AVG(dia) AS dia,
                                    AVG(mad) AS mad,
                                    AVG(pulsdruck) AS pulsdruck,
                                    AVG(puls) AS puls
                                FROM messungen
                                WHERE
                                     messungen.userID = ".$benutzerID."
                                     AND datumFeed IN (".$sqlDatum.")
                                     ");
        $query->execute();
        while($r=$query->fetch(\PDO::FETCH_BOTH)) {
            $durchschnittSys = (int) $r['sys'];
            $durchschnittDia = (int) $r['dia'];
            $durchschnittMAD = (int) $r['mad'];
            $durchschnittPuls = (int) $r['puls'];
            $durchschnittPulsdruck = (int) $r['pulsdruck'];
        }



        // Summe von Hypertonie errechnen
        $summeHypertonie = 0;
        $query_summe=$pdo->prepare("SELECT
                                        sum(messungen.hypertonie) as summe
                                    FROM
                                        messungen
                                     WHERE
                                         messungen.userID = ".$benutzerID."
                                         AND datumFeed IN (".$sqlDatum.")");
        $query_summe->execute();
        while($r_summe=$query_summe->fetch(\PDO::FETCH_BOTH)) {
            $summeHypertonie = $r_summe['summe'];
        }

        // Anzahl der Messungen ermitteln
        $anzahlMessungen = 0;
        $query_anzahl=$pdo->prepare("SELECT
                                            count(messungen.messungID) as anzahl
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                         AND datumFeed IN (".$sqlDatum.")");
        $query_anzahl->execute();
        while($r_anzahl=$query_anzahl->fetch(\PDO::FETCH_BOTH)) {
            $anzahlMessungen = $r_anzahl['anzahl'];
        }

        // Berechnung des Durchschnitts
        $durchschnitt = $summeHypertonie / $anzahlMessungen;






        // Festlegen der Werte
        $farbeHeader = 'danger';
        $farbwert = '#FFC7BB';
        $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
        $beschreibung = 'Hypertonie';
        if ($durchschnitt < 1.5) {
            $farbeHeader = 'warning';
            $farbwert = '#FCECCB';
            $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
            $beschreibung = 'Milde Hypertonie';
        }
        if ($durchschnitt < 1) {
            $farbeHeader = 'success';
            $farbwert = '#DCEDCC';
            $iconInformation = '<i class="fa fa-check color-'.$farbeHeader.'-dark font-11"></i>';
            $beschreibung = 'Optimaler Blutdruck';
        }
        //////////////////////////////











        // Start Detail-Einträge

        $detailTagesEintraege = '
            <div class="mb-0">
                <button class="btn accordion-btn no-effect"  data-bs-toggle="collapse" data-bs-target="#kw'.$kalenderwoche.'">
                    <i class="fa fa-chevron-down font-10 accordion-icon"></i>
                    Details&nbsp;&nbsp;
                </button>

                <div id="kw'.$kalenderwoche.'" class="collapse"  data-bs-parent="#accordion-1">';

        foreach ($arrTage as $tag) {


            // Anzahl der Messungen ermitteln
            $anzahlMessungen = 0;
            $query_anzahl=$pdo->prepare("SELECT
                                            count(messungen.messungID) as anzahl
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".$tag."%'");
            $query_anzahl->execute();
            while($r_anzahl=$query_anzahl->fetch(\PDO::FETCH_BOTH)) {
                $anzahlMessungen = $r_anzahl['anzahl'];
            }


            // Summe von Hypertonie errechnen
            $summeHypertonie = 0;
            $query_summe=$pdo->prepare("SELECT
                                            sum(messungen.hypertonie) as summe
                                        FROM
                                            messungen
                                         WHERE
                                             messungen.userID = ".$benutzerID."
                                             AND messungen.datum like '".$tag."%'");
            $query_summe->execute();
            while($r_summe=$query_summe->fetch(\PDO::FETCH_BOTH)) {
                $summeHypertonie = $r_summe['summe'];
            }

            // Berechnung des Durchschnitts
            $durchschnitt = $summeHypertonie / $anzahlMessungen;


            $farbeHeader = 'danger';
            $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
            $beschreibung = 'Hypertonie an diesem Tag im Durchschnitt.';
            if ($durchschnitt < 1.5) {
                $farbeHeader = 'warning';
                $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbeHeader.'-dark font-11"></i>';
                $beschreibung = 'Milde Hypertonie an diesem Tag im Durchschnitt.';
            }
            if ($durchschnitt < 1) {
                $farbeHeader = 'success';
                $iconInformation = '<i class="fa fa-check color-'.$farbeHeader.'-dark font-11"></i>';
                $beschreibung = 'Optimaler Blutdruck an diesem Tag im Durschnitt.';
            }

            $timestamp = strtotime($tag);
            $wochentag = date("l", $timestamp);
            if ($wochentag == 'Monday') $wochentag = 'Montag';
            if ($wochentag == 'Tuesday') $wochentag = 'Dienstag';
            if ($wochentag == 'Wednesday') $wochentag = 'Mittwoch';
            if ($wochentag == 'Thursday') $wochentag = 'Donnerstag';
            if ($wochentag == 'Friday') $wochentag = 'Freitag';
            if ($wochentag == 'Saturday') $wochentag = 'Samstag';
            if ($wochentag == 'Sunday') $wochentag = 'Sonntag';



            // Durschnittswerte für Statistik errechnen für diesen Tag
            // Durschnittswerte selektieren
            $query=$pdo->prepare("SELECT
                                    AVG(sys) AS sys,
                                    AVG(dia) AS dia,
                                    AVG(puls) AS puls
                                FROM messungen
                                WHERE
                                     datumFeed = '".$tag."' AND
                                     messungen.userID = ".$benutzerID);
            $query->execute();
            while($r=$query->fetch(\PDO::FETCH_BOTH)) {
                $durchschnittSysStatistik = (int) $r['sys'];
                $durchschnittDiaStatistik = (int) $r['dia'];
                $durchschnittPulsStatistik = (int) $r['puls'];
            }
            array_push($arrStatistikWochentage,$wochentag);
            array_push($arrStatistikSys,$durchschnittSysStatistik);
            array_push($arrStatistikDia,$durchschnittDiaStatistik);
            array_push($arrStatistikPuls,$durchschnittPulsStatistik);



            // Messungen selektieren
            $query=$pdo->prepare("SELECT
                                    *
                                FROM
                                    messungen
                                 WHERE
                                     datumFeed = '".$tag."' AND
                                     messungen.userID = ".$benutzerID." ORDER BY messungen.datum DESC");
            $query->execute();
            while($r=$query->fetch(\PDO::FETCH_BOTH)) {
                $iconTageszeit = '';
                if ($r['tageszeit'] == 'morgen') $iconTageszeit = '<i class="fa-solid fa-mug-saucer"></i>&nbsp;&nbsp;Morgens';
                if ($r['tageszeit'] == 'mittag') $iconTageszeit = '<i class="fa-solid fa-cloud-sun"></i></i>&nbsp;&nbsp;Mittags';
                if ($r['tageszeit'] == 'abend') $iconTageszeit = '<i class="fa-solid fa-bed"></i>&nbsp;&nbsp;Abends';



                $iconInformation = '';
                $farbe = '';
                $beschreibung = '';
                if ($r['hypertonie'] == 0) {
                    $farbe = '#DCEDCC';
                    $iconInformation = '<i class="fa fa-check color-'.$farbe.'-dark font-11"></i>';
                    $beschreibung = 'Optimaler Blutdruck';
                }
                if ($r['hypertonie'] == 1) {
                    $farbe = '#FCEBCA';
                    $iconInformation = '<i class="fa-solid fa-exclamation color-'.$farbe.'-dark font-11"></i>';
                    $beschreibung = 'Milde Hypertonie';
                }
                if ($r['hypertonie'] == 2) {
                    $farbe = '#FFC7BB';
                    $iconInformation = '<i class="fa-solid fa-triangle-exclamation color-'.$farbe.'-dark font-11"></i>';
                    $beschreibung = 'Hypertonie';
                }

                $detailTagesEintraege .= ' <div class="cal-schedule " style="background-color:'.$farbe.'">
                                <em>'.$wochentag.'<br>'.$iconTageszeit.'<br>'.substr($r['datum'],11,5).' Uhr<br></em>

                                <strong class="d-block mb-n2"><i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$r['sys'].'/'.$r['dia'].'</strong>
                                <span><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$r['mad'].'</span>
                                <strong class="d-block mb-n2"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$r['puls'].'</strong>
                                <span><i class="fa-solid fa-heart-pulse"></i>&nbsp;Pulsdruck: '.$r['pulsdruck'].'</span>
                            </div>';
            }
        }
        $detailTagesEintraege .= '
                        </div>
                    </div>';
        /////////////////////////



















        $events = '<div class="card card-style">
            <div class="content">
                <h2 class="text-center">Kalenderwoche '.$kalenderwoche.'</h2>
                <p class="text-center mt-n2 mb-1 font-11 color-highlight">Messungen von '.$objAllgemein->sqldate2date($erstesDatum).' bis '.$objAllgemein->sqldate2date($letztesDatum).'</p>
                <div class="chart-container" style="width:100%; height:300px;">
                    <canvas class="graph" id="line-chart'.$kalenderwoche.'"/></canvas>
                </div>
            </div><div class="cal-schedule " style="background-color:'.$farbwert.'">
                <em>Durchschnittswerte<br>dieser der Woche</em>

                <strong class="d-block mb-n2">
                '.$beschreibung.'<br>
                <i class="fa-solid fa-stethoscope"></i>&nbsp;Messung: '.$durchschnittSys.'/'.$durchschnittDia.'</strong>
                <span><i class="fa-solid fa-rotate-right"></i></i>&nbsp;Mittlerer arterieller Druck: '.$durchschnittMAD.'</span>
                <strong class="d-block mb-n2"><i class="fa-solid fa-heart-pulse"></i>&nbsp;Puls: '.$durchschnittPuls.'</strong>
                <span><i class="fa-solid fa-heart-pulse"></i>&nbsp;Pulsdruck: '.$durchschnittPulsdruck.'</span>
            </div>
            '.$detailTagesEintraege.'
        </div>';





        return ['success'=>'','events'=>$events,'kalenderwoche'=>$kalenderwoche ,'info' => $info, 'arrStatistikSys' => $arrStatistikSys, 'arrStatistikDia' => $arrStatistikDia, 'arrStatistikPuls' => $arrStatistikPuls, 'arrStatistikWochentage' => $arrStatistikWochentage];






    }



    public function uploadCropImage(Request $request)
    {

       // $objEvent = new EventController();

        $pdo = DB::connection()->getPdo();

        $userID = Auth::user()->id;

        $folderPath = public_path('intern/pictures/users/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $zufallszahl = mt_rand(100000,999999);
        $imageName = uniqid().$zufallszahl.'.'. $image_type;

        $imageFullPath = $folderPath.$imageName;

        file_put_contents($imageFullPath, $image_base64);
        try {
            $query=$pdo->prepare("UPDATE users set profilbild = :imageName where id = :benutzerID");
            $query->bindParam(":imageName", $imageName);
            $query->bindParam(":benutzerID", $userID);
            $query->execute();
        } catch (\PDOException $e) {
            return json_encode(['error'=>'Das Bild konnte nicht in die Datenbank geschrieben werden.']);
        } catch (Exception $e) {
            return json_encode(['error'=>'Das Bild konnte nicht in die Datenbank geschrieben werden.']);
        }

       // $arrEvent = $objEvent->eventEintragen('Benutzer','Das Profilfoto von "'.$benutzerName.'" wurde geändert.',$kundeID);


        return json_encode(['success'=>'']);
    }

}
