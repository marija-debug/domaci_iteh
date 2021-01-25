<?php
require "dbBroker.php";
require "model/korisnik.php";

session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $uname = $_POST['username'];
    $password = hash ("sha256", $_POST['password'], false) ;

    $rs = Korisnik::logInUser($uname, $password, $conn);

    if ($rs->num_rows == 1) {
        $row = $rs->fetch_assoc();
        // echo "Uspešno ste se ulogovali!";
        $_SESSION['korisnik_korisnikId'] = $row['korisnikId'];
        $status = $row['status'];
        echo "status: " . $status;

        if ($status == "admin") {
            $location = 'home.php';
            // echo "ovde admin, lokacija: " . $location;
        } else {
            $location = 'userindex.php';
            // echo "ovde user, lokacija: " . $location;
        }
        header("Location: " . $location);
        exit();
    } else {
        // header('Location: index.php');
        echo '<script type="text/javascript">alert("Uneli ste pogrešne parametre za prijavu!"); 
                                                window.location.href = "http://localhost/domaci_iteh/";</script>';
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css"> 
    <link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
 
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <title>Pozorište na Terazijama</title>
    <script>
        request = $.ajax({
            url: 'http://worldclockapi.com/api/jsonp/cet/now?callback=mycallback=?',
            type: 'GET',
            dataType: 'jsonp'
        });
        request.done(function(res) {
            console.log(res);
            // var data = JSON.parse(res);
            var day = res.dayOfTheWeek
            var date = res.currentDateTime
            var dateSplited = date.split("T");
            var time = dateSplited[1].split("+")
            $('#day').text(day);
            //$('#time').text(time[0]);
            $('#date').text(dateSplited[0]);
        });
    </script>

</head>
<script></script>

<body>

    <?php
    if (isset($_GET["msg"]) and !empty($_GET["msg"])) {
    ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_GET["msg"]; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php
    }
    ?>
    <div class="login-form">
        <div class="day-time">
            <!-- <input type="text" id="date" class="form-control"  readonly>
        <input type="text" id="day" class="form-control"  readonly>
        <input type="text" id="time" class="form-control"  readonly> -->
        <b>
            <p id="date"> </p>
            <p id="day"> </p>
</b>
           <!--<p id="time"> </p>-->
        </div>
        <div class="main-div">
            <form method="POST" action="#" autocomplete="off">
                <div class="imgcontainer">
                    <img src="img/Picture2.png" alt="Predstave" class="watch">
                </div>

                <div class="container">
                    <input type="text" placeholder="korisničko ime" name="username" class="form-control" required>
                    <input type="password" placeholder="lozinka" name="password" class="form-control" required>
                    <button type="submit" class="btn btn-primary" name="submit">Prijavi se</button>
                    <span"><a href="register.php">Registracija</a></span>
                    <!-- <a style = "color:white;" href="http://localhost/domaci_iteh/register.php">Registracija</a> -->
                </div>

            </form>
        </div>
    </div>
</body>

</html>