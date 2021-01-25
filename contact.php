<!doctype html> 
<html lang="en">
	<head>
		<?php include 'components/header.php';?>

		<title>Pozorište na Terazijama</title>
	</head>
	<body>
  <link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
		<?php include 'components/navbar.php';?>

		<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header" style="color: white">Kontakt</h1>
        <ol class="breadcrumb">
          <li><a href="userindex.php" style="color: black">Početna</a>
          </li>
          <li class="active" style="color: black">Kontakt</li>
        </ol>
      </div>
    </div>
    <!-- /.row -->

    <!-- Content Row -->
    <div class="row">
      <!-- Map Column -->
      <div class="col-md-8">
        <!-- Embedded Google Map -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2830.4271129625663!2d20.45933241549833!3d44.81286267909861!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x475a7aae6ca275b9%3A0xc28e2426c9743c97!2z0J_QvtC30L7RgNC40YjRgtC1INC90LAg0KLQtdGA0LDQt9C40ZjQsNC80LA!5e0!3m2!1ssr!2srs!4v1580900528530!5m2!1ssr!2srs" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
      <!-- Contact Details Column -->
      <div class="col-md-4" style="color: white">
        <h3>Adresa</h3>
        <p>
        TRG NIKOLE PAŠIĆA 3<br>11000 BEOGRAD, SRBIJA<br>
        </p>
        <p><i class="icon fas fa-phone"></i>
          (011) 32 29 943</p>
        <p><i class="icon far fa-envelope"></i>
          <a href="#" >blagajna@pozoristeterazije.com</a>
        </p>
        <p><i class="fas fa-clock"></i>
        Svakim radnim danom i vikendom od 13 do 19.30 časova</p>
        <ul class="list-unstyled list-inline list-social-icons">
          <li>
            <a class="text-danger" href="https://www.facebook.com/pozoristenaterazijama/" target="_blank"><i class="fab fa-facebook"></i></a>
          </li>
          <li>
            <a class="text-danger" href="http://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
          </li>
          <li>
            <a class="text-danger" href="https://www.whatsapp.com/" target="_blank"><i class="fab fa-whatsapp"></i></a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8" style="color: white">
        <h3>Pišite nam</h3>
        <form name="sentMessage" id="contactForm" novalidate>
          <div class="control-group form-group">
            <div class="controls">
              <label>Ime i prezime:</label>
              <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
              <p class="help-block"></p>
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Broj telefona:</label>
              <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Email adresa:</label>
              <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
            </div>
          </div>
          <div class="control-group form-group">
            <div class="controls">
              <label>Poruka:</label>
              <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
            </div>
          </div>
          <div id="success"></div>
          <button type="submit" class="btn btn-danger" style="background-color: #230000; border: #230000; color:white;">Pošalji</button>
        </form>
      </div>
    </div>
  </div>

	  <div>
	    <p class="spacer"></p>
	  </div>

		<?php include 'components/footer2.php';?>
	</body>
</html>
