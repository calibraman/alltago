<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;


class AllgemeinController extends Controller
{

    public function sqldate2date($datum){
        return substr($datum,8,2).".".substr($datum,5,2).".".substr($datum,0,4);
    }

    public function sqldate2dateUhrzeit($datum){
        return substr($datum,8,2).".".substr($datum,5,2).".".substr($datum,0,4)." ".substr($datum,11,8);
    }

    public function sqldate2dateUhrzeitOhneSek($datum){
        if (empty($datum)) return '';
        return substr($datum,8,2).".".substr($datum,5,2).".".substr($datum,0,4)." ".substr($datum,11,5).' Uhr';
    }


    public function date2sqldate($datum){
        return substr($datum,6,4)."-".substr($datum,3,2)."-".substr($datum,0,2);
    }


    /**
     * Zuletzt besucht eintragen
     */
    public function zuletztBesuchtEintragen($kundeID)
    {

        $pdo = DB::connection()->getPdo();

        $userID = Auth::user()->id;

        if (isset($kundeID) && !empty($kundeID)) {
            $kundeID = trim($kundeID);
        } else {
            $kundeID = null;
        }

        try {
            $stmt = $pdo->prepare("INSERT INTO `users_zuletzt_besucht` (
                                                    `id` ,
                                                    `kundeID` ,
                                                    `erstellt_am` ,
                                                    `userID`
                                                  ) VALUES (
                                                    NULL ,
                                                    :kundeID,
                                                    NOW(),
                                                    :userID
                                          )");
            $stmt->bindParam(":kundeID",$kundeID);
            $stmt->bindParam(":userID",$userID);
            $stmt->execute();
        } catch(\PDOException $e){
            //$objEmail->sendeFehler('Der Ansprechpartner '.$vorname.' '.$nachname.' konnte nicht angelegt werden über DELPHI, Benutzer: '.$_SESSION['benutzer']['benutzername'].'.<br><br>' . $e->getMessage(),'DELPHI/JANUS Fehler');
            return json_encode(array('ergebnis' => 'fehler' , 'text1' => "Fehler" , 'text2' => "Zuletzt besucht konnte nicht angelegt werden.<br><br>".$e->getMessage()));
        }


        return ['success'=>''];
    }


    public function humanTiming ($time) {
        $time = strtotime($time);
        $time = time() - $time; // to get the time since that moment
        $time = ($time<1)? 1 : $time;
        $tokens = array (
            31536000 => 'Jahre',
            2592000 => 'Monate',
            604800 => 'Woche',
            86400 => 'Tage',
            3600 => 'Stunde',
            60 => 'Minute',
            1 => 'Sekunde'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'n':'');
        }
    }



}
