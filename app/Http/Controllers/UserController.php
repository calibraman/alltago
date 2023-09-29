<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class UserController extends Controller
{


    public function userAnlegen(Request $request)
    {

        $pdo = DB::connection()->getPdo();

        $vorname = trim($request->vorname);
        $email = trim($request->email);
        $passwortLesbar = trim($request->passwort);

        $passwortLesbar = $this->generierePasswort(8, 3, 5, true);
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
        if ($anrede == "Frau") {
            $apAnrede = "Sehr geehrte Frau " . $nachname . ",";
        } elseif ($anrede == "Herr") {
            $apAnrede = "Sehr geehrter Herr " .$nachname . ",";
        }

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
                                                                            <img width="160.954157782516" style="border:0;width:160.954157782516px;height:auto;max-width:100%;display:block" alt="Logo" src="https://dim.mcusercontent.com/cs/ce6b72c1c5d60036ec96a0f3b/images/86e8594c-f53f-22a6-39c7-f39291674310.png?w=161&dpr=2" class="">
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceSpacing-24" valign="top">
                                                                        <div class="mceText" style="font-size:16px;text-align:center;width:100%">
                                                                            <h1>Willkommen bei TELEFLOW</h1>
                                                                            <p class="last-child">
                                                                                Sie können sich nun auf<br><br><a href="https://teleflow.de">https://teleflow.de</a><br><br>einloggen mit folgenden Angaben:
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
        $mailer = new MailerController();
        // $mailer->sendeEmail('Willkommen bei TELEFLOW',$emailInhalt,$email);


        return ['success'=>''];
    }

}