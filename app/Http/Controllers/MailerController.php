<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use DB;

class MailerController extends Controller
{

    public function sendeEmail($betreff,$inhalt,$an,$cc = null,$bcc = null,$anhaenge = null,$pdo = null,$kundeID = null) {
        require ("../vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions


        try {
            $mail= new PHPMailer();
            $mail->SMTPDebug  = 0;
            $mail->CharSet ="UTF-8";
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';
            $mail->Host       = 'mail.your-server.de';
            $mail->Port       = '25';
            $mail->Username   = 'info@teleflow.de';
            $mail->Password   = '9Q3xJz2jt4GUb0JZ';
            $mail->From       = 'info@teleflow.de';
            $mail->FromName   = 'TELEFLOW';
            $mail->IsHTML(true);
            $mail->SetFrom('info@teleflow.de','TELEFLOW');
            $mail->addReplyTo('info@teleflow.de', 'TELEFLOW');
            $mail->AddAddress($an);
            //$mail->addCC($request->emailCc);
            //$mail->addBCC($request->emailBcc);
            $mail->Subject  = $betreff;
            $mail->Body    = $inhalt;
            $mail->isHTML(true);                // Set email content format to HTML

            if( !$mail->send() ) {
                return array('ergebnis' => 'fehler' , 'text1' => "Die E-Mail konnte nicht gesendet werden." , 'text2' => $mail->ErrorInfo);
            }
            return array('ergebnis' => 'erfolgreich' , 'text1' => "Erfolgreich" , 'text2' => 'text2');


        } catch (Exception $e) {
            return array('ergebnis' => 'fehler' , 'text1' => "Die E-Mail konnte nicht gesendet werden." , 'text2' => $mail->ErrorInfo);
        }
    }



    }
