<?php
$host = "localhost";
$db = "rest";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_errno) {
    exit("Povezivanje sa bazom je neuspešno: " . $conn->connect_errno);
}