<?php

require "../dbBroker.php";
require "../model/predstava.php";

if (isset($_POST['nazivFilma']) && isset($_POST['zanrFilma']) 
    && isset($_POST['trajanjeFilma']) && isset($_POST['ocena_UtisakOFilmu'])) {

        
    $status = Predstava::add($_POST['nazivFilma'], $_POST['zanrFilma'], $_POST['ocena_UtisakOFilmu'], $_POST['trajanjeFilma'], $conn);
        
    if ($status) {
        echo 'Success';
    } else
     {
        echo $status;
        echo 'Failed';
    }
    
}