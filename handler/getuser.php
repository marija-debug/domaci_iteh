<?php
if (isset($_SESSION['korisnik_korisnikId'])) { 
    echo $_SESSION['korisnik_korisnikId'];
}else{
    echo "Korisnik nije prijavljen";
}   
?>