<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ATL">
    <meta name="author" content="Ismael">
    <title>ATL - Prueba</title>

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<!-- COMMON CSS -->
	<link href="style/bootstrap.min.css" rel="stylesheet">
    <link href="style/style.css" rel="stylesheet">
	<link href="style/vendors.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>

<body>
<?php
    require("./class/groupclass.php");
    $client = new atl_clients();
?>
	<div id="preloader">
		<div class="sk-spinner sk-spinner-wave">
			<div class="sk-rect1"></div>
			<div class="sk-rect2"></div>
			<div class="sk-rect3"></div>
			<div class="sk-rect4"></div>
			<div class="sk-rect5"></div>
		</div>
	</div>
	<!-- End Preload -->

	<div class="layer"></div>
	<!-- Mobile menu overlay mask -->

    <section class="margin_40 mb-3">
        <h1 class="ml-1">ATL - Prueba</h1>
        <hr>
        
        <div class="margi_60">
            <div class="container text-center">
                <h2>Listado de Clientes</h2>
                <div class="row">
                    <div class="col-lg-12">
                        <a href='javascript:void' data-id="0" class="btn btn-primary"  onclick='obtaingData(this)' data-action='crear'>Crear</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class='margin_10'>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="tablePrincipal">
                            <?php
                                $data         = $client->showListData();
                                $count        = 0;
                                while($row    = mysqli_Fetch_array($data)){

                                    $count++;
                                    $name     = $row['first_name'];
                                    $lastName = $row['last_name'];
                                    $id       = $row['id'];
                                    echo <<<Client
                                    <tr>
                                        <td>$count</td>
                                        <td>$name</td>
                                        <td>$lastName</td>
                                        <td><a href='javascript:void' data-id="$id" class="btn btn-info" onclick='obtaingData(this)' data-action='editar'>Ver</a></td>
                                    </tr>
                                    Client;

                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

	<!-- Common scripts -->
	<script src="scripts/page/jquery-3.6.0.min.js"></script>
	<script src="scripts/page/common_scripts_min.js"></script>
	<script src="scripts/page/functions.js"></script>
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/imask"></script>

    <script src="./scripts/app.js"></script>
    <script src="./scripts/client.js"></script>


	

</body>

</html>