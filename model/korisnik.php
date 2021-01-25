<?php


class Korisnik {
    public $korisnikId;
    public $username;
    public $password;
    public $imePrezime;
    public $status;

    public function __construct($korisnikId = null, $username = null, $password = null, $imePrezime = null,  $status=null)
    {
        $this->korisnikId = $korisnikId;
        $this->username = $username;
        $this->password = $password;
        $this->imePrezime = $imePrezime;
        $this->status = $status;
    }

    public static function logInUser($uname, $password,mysqli $conn)
    {
        $q ="select * from korisnik where username='".$uname."' and password='".$password."' limit 1";
        return $conn->query($q);


    }


}