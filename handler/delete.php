<?php
require "../dbBroker.php";
require "../model/predstava.php";

if(isset($_POST['id'])) {
    $status = Predstava::deleteById($_POST['id'], $conn);
    if ($status) {
        echo 'Success';
    } else {
        echo 'Failed';
    }
}