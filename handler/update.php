<?php
require "../dbBroker.php";
require "../model/predstava.php";

if (isset($_POST['filmId']) && isset($_POST['nazivFilma']) && isset($_POST['zanrFilma'])
    && isset($_POST['ocena_utisakOFilmu']) && isset($_POST['trajanjeFilma'])) {

    $status = Predstava::update($_POST['filmId'], $_POST['nazivFilma'], $_POST['zanrFilma'], $_POST['ocena_utisakOFilmu'], $_POST['trajanjeFilma'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo $status;
        echo 'Failed';
    }
}