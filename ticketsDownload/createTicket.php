<?php

function create($predstava, $datum, $sediste, $sala, $cena)
{

  $ticket = "<!DOCTYPE html>
<html>
<head>
<title>Karta</title>
<link rel='shortcut icon' type='image/x-icon' href='img/drama.png' />
<meta content='width=device-width, initial-scale=1.0' name='viewport'>
<meta http-equiv='content-type' content='text-html; charset=utf-8'>

<!-- Custom CSS -->
<link href='ticket/ticketStyle.css' rel='stylesheet'>

<!-- Custom Fonts -->
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
</head>
<style>

body {
    margin: 0;
    color: #ffffff;
    font-family: 'Montserrat';
    font-weight: 400;
    font-size: 25px;
  }

  .container {
    width: 795px;
    margin: 0 auto;
  }

  section {
    position: relative;
    height: 280px;
    width: 100%;
    background-image: url(https://htmlpdfapi.com/uploads/images/568b96887261690f6dbe0000/content_background-concert-3.jpg?1451988615);
    background-size: 100%;
    background-repeat: no-repeat;
    overflow: hidden;
  }
  section .left {
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    float: left;
    width: 635px;
    padding: 35px 0 0 60px;
  }
  section .right {
    float: right;
    width: 160px;
    padding-top: 10px;
  }
  section .event {
    margin-bottom: 10px;
    margin-top: 10px;
    font-weight: 700;
    font-size: 0.6em;
    line-height: 35px;
    text-transform: uppercase;
  }
  section .title {
    margin-bottom: 35px;
    color: #F5A623;
    font-family: 'Montserrat';
    font-size: 2em;
    line-height: 72px;
  }
  section .info {
    font-size: 0.6em;
    text-transform: uppercase;
  }
  section .seats {
    margin-bottom: 15px;
    font-size: 0.45em;
    text-transform: uppercase;
    text-align: right;
  }
  section .seats:last-child {
    margin-bottom: 0;
  }
  section .seats span {
    display: inline-block;
    width: 80px;
    margin-left: 15px;
    margin-right: 15px;
    padding: 10px 0;
    color: #F5A623;
    /* background: rgba(255, 255, 255, 0.5); */
    font-family: 'Montserrat';
    font-size: 1.5em;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
  }

</style>
<body>
  <div class='container'>
    <section>
      <div class='left'>
        <div class='title' id='title'>$predstava</div>
        <div class='event'>Cena: $cena</div>
        <div class='info'>Pozorište na Terazijama // TRG NIKOLE PAŠIĆA 3 // 11000 BEOGRAD </div>
      </div>
      <div class='right'>
        <div class='seats' id='datum'>Datum<span>$datum</span></div>
        <div class='seats' id='vreme'>Vreme<span>19:30h</span></div>
        <div class='seats' id='sala'>Sala<span>$sala</span></div>
        <div class='seats' id='sediste'>Sedište<span>$sediste</span></div>
      </div>
    </section>
  </div>
</body>
</html>";

  $File = fopen('ticket.html', 'w+');
  $Status = fwrite($File, $ticket);
  fclose($File);
}
