<?php

require "../dbBroker.php";
require "../model/predstava.php";

if(isset($_POST['id'])) {
    $myArray = Predstava::getById($_POST['id'], $conn);
    echo json_encode($myArray);
}

