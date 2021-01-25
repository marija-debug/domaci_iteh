<?php


class Rezervacija {
    public $korisnikId;
    public $datum;
    public $nazivPredstave;
    public $nazivSale;
    public $sediste;
    public $trajanje;
    public $zanr;


    public function __construct($korisnikId = null, $datum = null, $nazivPredstave = null, $nazivSale = null, $sediste = null, $trajanje = null, $zanr = null) {
        $this->korisnikId = $korisnikId;
        $this->datum = $datum;
        $this->nazivPredstave = $nazivPredstave;
        $this->nazivSale = $nazivSale;
        $this->sediste = $sediste;
        $this->trajanje = $trajanje;
        $this->zanr = $zanr;

    }

    public static function getAll($id)
    {
        
        $url = 'http://localhost/domaci3/rezervacije/'.$id.'.json';
        // echo $url;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, false);
        $curl_odgovor = curl_exec($curl);
        curl_close($curl);
        $parsiran_json = json_decode ($curl_odgovor);
        return $parsiran_json;
    }


}