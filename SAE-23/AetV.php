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
        <title>RT Coin - Achats & Ventes</title>
        <link rel="stylesheet" href="indexsae23.css"/>
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
						<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
					</li>
					<li>
						<a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
					</li>
				</ul>
				
			</nav>

	<div id="divbase">
        <p>az</p>
	</div>

</body>
</html>

