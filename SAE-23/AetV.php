<?php

session_start();
     require_once 'config.php';
 

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
		<style>
        	body{ font: 14px sans-serif; text-align: center; }
			body{background-image:url("RT-COIN-2.png");}

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

	<div>
		<br>
		<br>
		<p>Vous pouvez acheter ou vendre 0.1 Bitcoin en cliquant ci-dessous</p><br>
		<a href="achats.php">Acheter</a> <br> <br> <a href="ventes.php">Vendre</a>
		<br>
		<br>
		<br>

		<?php

		$USER=$_SESSION['username'];

		$mysqlClient = new PDO('mysql:host=localhost;dbname=db_GALLIGANI;charset=UTF8','22100332','JoeyJoey',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

		$REQUETE ="SELECT bitcoin FROM users WHERE username='".$USER."';";
		$insert = $mysqlClient->prepare($REQUETE);
		$insert->execute();
		$data = $insert->fetchAll();
		$insert->closeCursor();
	
		if(isset($data[0]['bitcoin'])){
    		printf("<h1>Vous possédez actuellement %s Bitcoin</h1>", $data[0]['bitcoin']);
		}

		?>

	</div>


</script>
</body>
</html>