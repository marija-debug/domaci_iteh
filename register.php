<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
	<link rel="stylesheet" type="text/css" href="css/register.css"> 
	<title>Pozorište na Terazijama</title>
	
	 <?php include 'components/header.php'; ?>
	
 </head>
<body>
<div class="overlay"><div class="loader"></div></div>
	
<!--	<p></p>-->

<div class="main-div">

	<div class="container">
		<div class="card mx-auto " width="100%" style="width: 30rem;" >
	        <div class="card-header" style="text-align:center;"> <h1>Registrovanje</h1></div>
		      <div class="card-body">
		        <form id="register_form" onsubmit="return false" method="post" autocomplete="off">
                <div class="form-group">
		            <label for="fullName">Ime i prezime</label>
		            <input type="text" name="fullName" class="form-control" id="fullName" placeholder="Enter Username">
		            <small id="fn_error" class="form-text text-muted"></small>
		          </div>
		          <div class="form-group">
		            <label for="username">Korisničko ime</label>
		            <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
		            <small id="u_error" class="form-text text-muted"></small>
		          </div>
		          <div class="form-group">
		            <label for="email">Email adresa</label>
		            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
		            <small id="e_error" class="form-text text-muted">Vaši podaci neće biti deljeni.</small>
		          </div>
		          <div class="form-group">
		            <label for="password">Lozinka</label>
		            <input type="password" name="password" class="form-control"  id="password" placeholder="Password">
		            <small id="p1_error" class="form-text text-muted"></small>
		          </div>
		          <div class="form-group">
		            <label for="password2">Potvrdite lozinku</label>
		            <input type="password" name="password2" class="form-control"  id="password2" placeholder="Password">
		            <small id="p2_error" class="form-text text-muted"></small>
		          </div>
		          
		          <button type="submit" name="user_register" class="btn btn-primary" id="dugme"><span class="fa fa-user"></span>&nbsp;Registruj se</button>
		          <span style="padding-left:20px;"><a href="index.php">Prijavi se</a></span>
		        </form>
		      </div>
	      <div class="card-footer text-muted">
	        
	      </div>
	    </div>
	</div>
	</div>

    <link rel="stylesheet" href="jquery-ui/jquery-ui.min.css">
	<script src="jquery-ui/external/jquery/jquery.js"></script>
	<script src="jquery-ui/jquery-ui.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
    <script language="javascript" src="./js/jquery.sha256.js" ></script>
</body>
</html>