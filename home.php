<?php


require "dbBroker.php";
require "model/predstava.php";

session_start();

if (!isset($_SESSION['korisnik_korisnikId'])) {
    // echo "nije setovan korisnik";
    header('Location: index.php');
    exit();
} elseif (isset($_GET['logout']) && !empty($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
}


$result = Predstava::getAll($conn);
$resultChart = Predstava::getCountForChart($conn);


if (!$result) {
    echo "Nastala je greska pri izvodenju upita<br>";
    die();
}
if (count($result) == 0) {
    echo "Nema predstava";
    die();
} else {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon" type="image/x-icon" href="img/drama.png" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/home.css">
        <?php include 'components/header.php'; ?>
        <title>Pozorište na Terazijama</title>

        <!--Load the AJAX API-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {
                'packages': ['corechart']
            });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Predstava', 'Broj rezervacija'],
                    <?php
                    if ($resultChart->num_rows > 0) {
                        while ($row = $resultChart->fetch_array()) {
                            echo "['" . $row['naziv'] . "', " . $row['broj'] . "],";
                        }
                    }
                    ?>
                ]);
                // Set chart options
                var options = {
                    'title': 'Pregled broja rezervacija po predstavama',
                    'is3D': true,
                    'width': 550,
                    'height': 450,
                    'colors': ['#990303', '#5c2a2a', '#9c2f2f', '#ab0000', '#c99393', '#f6c7b6', '#a64141', '#593636', '#f24444', '#800000']
                };

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </head>

    <body>

        <div class="jumbotron">
            <h1 style="color: black; ">Pozorište na Terazijama </h1>
            <a href="home.php?logout=true" style="float: right; padding: 10px">
                <button id="logout" type="button" class="btn btn-danger" style="background-color: #230000; border: #230000;">Odjava</button>
            </a>
        </div>

        <div class="row">
            <div class="col-md-2">
                <button id="btn" class="btn btn-info btn-block" style="background-color: #230000; border: #230000;"><i class="glyphicon glyphicon-th-list"></i> Pregled
                </button>
            </div>

            <div class="col-md-2">
                <button id="btnChart" type="button" class="btn btn-success btn-block" style="background-color: #230000;border: #230000; " data-toggle="modal" data-target="#chartModal"><i class="glyphicon glyphicon-plus"></i> Pregled predstava
                </button>
            </div>

            <div class="col-md-4">
            </div>

            <div class="col-md-1">
                <button id="btn-dodaj" type="button" class="btn btn-success btn-block" style="background-color: #230000;border: #230000; " data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i> Dodaj
                </button>

            </div>

            <div class="col-md-1">
                <button id="btn-pretraga" class="btn btn-warning btn-block" style="background-color:  #230000;border: #230000; "><i class="glyphicon glyphicon-search"></i> Pretraži
                </button>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretraži predstavu po žanru" hidden>
            </div>

            <div class="col-md-1">
                <button id="btn-izmeni" type="button" class="btn btn-warning " style="background-color:  #230000;border: #230000;" data-toggle="modal" data-target="#izmeniModal"><i class="glyphicon glyphicon-pencil"></i> Izmeni
                </button>
                <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretrazi krofne" hidden>-->
            </div>

            <div class="col-md-1">
                <button id="btn-obrisi" type="button" class="btn btn-warning btn-danger" style="background-color:  #230000;border: #230000; "><i class="glyphicon glyphicon-trash"></i> Obriši
                </button>
                <!-- <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Pretrazi krofne" hidden>-->
            </div>


        </div>-->
        </div>

        <div id="pregled" class="panel panel-info" style="margin-top: 1%; border:none;">
            <div class="panel-heading" style="background-color:#230000; color:white; border-bottom:white;">Pregled predstava</div>
            <div class="panel-body">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <!--<th scope="col">Id filma</th>-->
                            <th scope="col">Naziv predstave</th>
                            <th scope="col">Žanr predstave</th>
                            <th scope="col">Trajanje predstave (min)</th>
                            <th scope="col">Opis predstave</th>
                            <th scope="col">Cena</th>
                            <th scope="col">Izaberi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // foreach ($toppings as $topping) {
                        //     echo $topping, "\n";
                        // }
                        foreach ($result as $row) {
                        ?>
                            <tr>
                                <!--<th scope="row">{{ counter }}</th>-->
                                <!-- <td><?php echo $row->id ?></td>-->
                                <td><?php echo $row->naziv ?></td>
                                <td><?php echo $row->zanr ?></td>
                                <td><?php echo $row->trajanje ?></td>
                                <td><?php echo $row->opis ?></td>
                                <td width="10%"><?php echo $row->cena ?></td>
                                <td>
                                    <label class="custom-radio-btn">
                                        <input type="radio" name="checked-film" value=<?php echo $row->id ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>

                            </tr>
                    <?php
                        }
                    } ?>
                    </tbody>
                </table>


            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container-form">
                            <!--ovo je pozadina-->
                            <div class="film-image">
                                <img src="img/drama-bela.png" alt="rocket_contact" />
                            </div>
                            <form action="#" method="post" id="dodajForm">
                                <h3 style="color: white">Dodavanje predstave</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="naziv" required class="form-control" placeholder="Naziv predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="zanr" required class="form-control" placeholder="Žanr predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="trajanje" required min=0 class="form-control" placeholder="Trajanje predstave" value="" />

                                        </div>
                                        <div class="form-group">
                                            <input type="number" name="cena" required min=0 class="form-control" placeholder="Cena predstave" value="" required/>

                                        </div>
                                        <div class="form-group">
                                            <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color: #230000; border: #230000;"><i class="glyphicon glyphicon-plus"></i> Dodaj
                                            </button>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea name="opis" class="form-control" placeholder="Opis predstave" style="width: 100%; height: 150px;"></textarea>
                                        </div>                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
                        <!-- <button type="button" class="btn btn-default" style="background-color: #FE3649; border: #FE3649; color:white;" data-dismiss="modal">Close</button>-->
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="izmeniModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container-form">
                            <!--ovde je bilo container krofna-form-->
                            <div class="film-image">
                                <img src="img/drama-bela.png" alt="rocket_contact" />
                            </div>
                            <form action="#" method="post" id="izmeniForm">
                                <h3 style="color: white">Izmena predstave</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input id="id" type="text" name="id" required class="form-control" placeholder="Id predstave" value="" readonly />
                                        </div>
                                        <div class="form-group">
                                            <input id="filmIzmeni" type="text" name="naziv" required class="form-control" placeholder="Naziv predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="zanrIzmeni" type="text" name="zanr" required class="form-control" placeholder="Žanr predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="trajanjeIzmeni" type="number" name="trajanje" required min=0 class="form-control" placeholder="Trajanje predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <input id="cenaIzmeni" type="number" name="cena" required min=0 class="form-control" placeholder="Cena predstave" value="" />
                                        </div>
                                        <div class="form-group">
                                            <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="background-color: #230000; border: #230000;"><i class="glyphicon glyphicon-plus"></i> Izmeni
                                            </button>

                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <textarea id="utisakIzmeni" name="opis" class="form-control" placeholder="Opis predstave" style="width: 100%; height: 150px;"></textarea>
                                            <!-- -->
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
                        <!-- <button type="button" style="margin-bottom:100px; background-color: #FE3649; border: #FE3649; color:white;" class="btn btn-default"  data-dismiss="modal">Close</button>-->
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="chartModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container-form">
                            <!--ovde je bilo container krofna-form-->
                            <div class="film-image">
                                <img src="img/drama-bela.png" alt="rocket_contact" />
                            </div>
                            <div id="chart_div"></div>
                        </div>
                    </div>
                    <div class="modal-footer" style="border:none;">
                        <!-- <button type="button" style="margin-bottom:100px; background-color: #FE3649; border: #FE3649; color:white;" class="btn btn-default"  data-dismiss="modal">Close</button>-->
                    </div>
                </div>

            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            function myFunction() {


                var input, filter, table, tr, i, td1, td2, td3, td4, txtValue1, txtValue2, txtValue3, txtValue4;
                input = document.getElementById("myInput");
                filter = input.value.toUpperCase();
                table = document.getElementById("myTable");
                tr = table.getElementsByTagName("tr");

                for (i = 0; i < tr.length; i++) {
                    td1 = tr[i].getElementsByTagName("td")[1];
                    td2 = tr[i].getElementsByTagName("td")[2];
                    td3 = tr[i].getElementsByTagName("td")[3];
                    td4 = tr[i].getElementsByTagName("td")[4];

                    if (td1 || td2 || td3 || td4) {
                        txtValue1 = td1.textContent || td1.innerText;
                        txtValue2 = td2.textContent || td2.innerText;
                        txtValue3 = td3.textContent || td3.innerText;
                        txtValue4 = td4.textContent || td4.innerText;




                        if (txtValue1.toUpperCase().indexOf(filter) > -1) { //ovo je po zanru
                            tr[i].style.display = "";
                        } else {
                            tr[i].style.display = "none";
                        }

                    }
                }
            }
        </script>


    </body>

    </html>