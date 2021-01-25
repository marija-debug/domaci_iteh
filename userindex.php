<?php

require "dbBroker.php";
require "model/predstava.php";

session_start();

if (!isset($_SESSION['korisnik_korisnikId'])) { 
    header('Location: index.php');
    exit();
} elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}


$result = Predstava::getAll($conn);

if (!$result) {
	echo "Nastala je greska pri izvodenju upita<br>";
	die();
}
if (count($result) == 0) {
	echo "Nema predstava";
	die();
}
// else {

?>

<!DOCTYPE html>
<html lang="en" id="<?php echo $_SESSION['korisnik_korisnikId']?>">

<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
	<?php include 'components/header.php'; ?>

	<title>Pozorište na Terazijama</title>
</head>

<body>
	<?php include 'components/navbar.php'; ?>

	<header id="myCarousel" class="carousel slide">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			<div class="item active">
				<div class="fill" style="background-image:url('img/pozadina2.jpg');"></div> 
				<div class="carousel-caption">
				<!--	<h2>Rezervacija karata</h2>-->
				</div>
			</div>
			<div class="item">
			<div class="fill" style="background-image:url('img/pozadina1.jpeg');"></div>
				<div class="carousel-caption">
					<!--<h2>Najnovije predstave</h2>-->
				</div>
			</div>
			<div class="item">
				<div class="fill" style="background-image:url('img/pozadina4.jpg');"></div> 
				<div class="carousel-caption">
					<!--<h2>Rekli su o nama</h2>-->
				</div>
			</div>
		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="icon-prev"></span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="icon-next"></span>
		</a>
	</header>

	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="page-header" style="text-align: center; color:white;">Rezervišite svoje karte</h2>
			</div>
			<div class="col-xs-12">
				<h5 class="center-align text-uppercase lead"  style="text-align: center; color:white;">Predstave</h5>
			</div>
		</div>
		<div class="row">

			<?php foreach ($result as $row) {
			?>
				<div class="col-xs-6 col-md-3">
					<div class="thumbnail">
						<center>
							<img src="<?php echo 'img/' . $row->id . '.jpg' ?>" alt="<?php echo $row->naziv ?>" style="width:40%; height:150px; margin-bottom:5px">
							<div class="caption">
								<h4><?php echo $row->naziv; ?></h4>
								<h5><?php echo $row->zanr; ?></h5>
								<label>19:30h</label>
								<div class="form-group">
									<label for="utisakIzmeni">O predstavi:</label>
									<textarea id="utisakIzmeni" name="opis" class="form-control" placeholder="Ocena/Utisak o filmu" style="width: 100%; height: 150px;"><?php echo $row->opis ?></textarea>
								</div>
								<h4>Cena: <?php echo $row->cena; ?> RSD</h5>
								<p>
									<button class="btnReserve" type="button" value="<?php echo $row->id ?>" class="btn btn-default dropdown-toggle" style="color:white; background-color: #3F1918; font-size:18px">Rezervišite sedište</button>
								</p>
							</div>
						</center>
					</div>
				</div>
			<?php
			}
			?>
		</div>

		<br><br><br>
	</div>

	<div class="modal fade" id="reservation" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!-- <div class="modal-header" style="border:none;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div> -->
				<div class="modal-body">
					<div class="container-form">
						<!--ovo je pozadina-->
						<div class="film-image">
							<!-- <img src="img/fav.jpg" alt="rocket_contact"/> -->
						</div>
						<form action="#" method="post" id="rezervacijaForm">
							<h3 style="color: white">Rezervisanje sedišta</h3>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<p value="" name="idPredstave" style="color: white">Naziv predstave:</p>
										<input id="filmIzmeni" type="text" name="naziv" required class="form-control" placeholder="Naziv filma" value="" readonly />
									</div>

									<div class="form-group">
										<p style="color: white">Trajanje predstave (u minutima):</p>
										<input id="trajanjeIzmeni" type="number" name="trajanje" required min=0 class="form-control" placeholder="Trajanje filma" value="" readonly />

									</div>


									<div class="form-group">
										<button id="btnRezervisi" type="submit" class="btn btn-success btn-block" style="background-color: #230000; border: #230000;"><i class="fas fa-couch"></i> Rezervišite sedište
										</button>
									</div>

								</div>
								<div class="col-md-6">
									<div class="form-group">
										<p style="color: white">Izaberite datum izvodjenja:</p>
										<select id="datumiIzvodjenja">
											<option value="0"> Izaberite sedište: </option>
										</select>
									</div>

									<div class="form-group">
										<p style="color: white">Izaberite sedište:</p>
										<select id="sediste">
											<option value="0">- Select -</option>
										</select>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="modal-footer" style="border:none;">
					<button type="button" class="btn btn-default" style="background-color: #230000; border: #230000; color:white;" data-dismiss="modal">Zatvori</button>
				</div>
			</div>

		</div>
	</div>



	<div class="bottom">
		<!-- Call to Action Section -->
		<div class="pre-footer small" style="background-color:#833306; color:black; opacity:0.9;">
			<div class="row">
				<div class="col-xs-12">
					<h5 class="center-align bold"style="color:white" >O nama</h5>
				</div>
				<div class="row row-content">
					<div class="col-xs-12 " style="text-align:center;"> 
						"Tražim da sala bude na Terazijama. Humorističko ili bulevarsko pozorište, koje nedostaje Beogradu, mora biti tamo gde ljudi ubijau vreme, a mi im onda ponudimo smešno ubijanje samoće!"
					</div>
				</div>
				<div class="row row-content">
					<div class="col-sm-4 col-xs-12" id="pozoriste" >
						<h5 class="bold" style="color:white" >O POZORIŠTU</h5>
						<p>Pozorište na Terazijama osnovano je 23. decembra 1949. godine kao Humorističko pozorište. Danas je Pozorište na Terazijama sinonim za mjuzikl i muzičke predstave, ne samo u Beogradu već u celoj zemlji. Osim izvođenja brodvejskih hitova kao što je na primer Kabare, sada se u pozorištu na Terazijama izvode predstave koje su i širi svetski hitovi kao što je predstava Fantom iz Opere.
						</p>
					</div>
					<div class="col-sm-4 col-xs-12" id="pozoriste">
						<h5 class="bold" style="color:white" >ANSAMBLI</h5>
						<p>
							Tokom sedam decenija postojanja, pozorište na Terazijama je svoj dramski, orkestarski, baletski i horski ansambl neprekidno obogaćivalo novim, prvenstveno mladim, talentovanim i školovanim umetnicima. To mu je uvek donosilo dominantnu notu umetničke svežine, koju je publika nepogrešivo umela da prepozna. Trenutni ansambli su dopunjeni i tehničkim sektorom.
						</p>
					</div>
					<div class="col-sm-4 col-xs-12" id="pozoriste">
						<h5 class="bold" style="color:white" >REPERTOAR</h5>
						<p>
							Pozorište na Terazijama pored stranih hitova poslednjih deceniju i više, neguje i razvija i predstave zasnovane na domaćoj literaturi koje prepoznajemo kao "domaći mjuzikl", među kojima su: Lutka sa naslovne strane, Maratonci trče počasni krug, Na slovo, na slovo, kao i još uvek aktuelnih predstava poput Zone Zamfirove, Glavo luda ili Mister Dolar.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include_once("./components/footer2.php"); ?>
	<link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
	<script src="jquery-ui/external/jquery/jquery.js"></script>
	<script src="jquery-ui/jquery-ui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/userpage.js"></script>
	<script>
		$('.carousel').carousel({
			interval: 5000 //changes the speed
		});
	</script>
</body>

</html>