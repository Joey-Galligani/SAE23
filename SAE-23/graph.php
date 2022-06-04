<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>RT Coin - Graphiques</title>
        <link rel="stylesheet" href="indexsae23.css"/>
    	<meta charset="utf8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="style.css">
		<style>
        	body{ font: 14px sans-serif; text-align: center; }
    	</style>
    </head>
    <body>
		<nav>

			<ul class="menu">
					<li>
						<a href="welcome.php" classe="actif">Accueil</a>
					</li>
					<li>
						<a href="AetV.php">Achats & Ventes</a>
					</li>
					<li>
						<a href="graph.php">Graphiques</a>
					</li>
					<li>
						<a href="reset-password.php" class="btn btn-warning"> Changer votre mot de passe </a>
					</li>
					<li>
						<a href="logout.php" class="btn btn-danger ml-3">Se déconnecter</a>
					</li>
				</ul>	
			</nav>
	<br>
	<div id="txtgrf">Cours du Bitcoin en temps réel : </div>
	<br>
	<div id="divgraph">

    <section>
        <div class="container">
            <div>
                <canvas id="myChart"></canvas>
            </div>

        </div>
    </section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="app.js"></script>


    </div>

</body>
</html>

