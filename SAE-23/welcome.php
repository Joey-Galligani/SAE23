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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="indexsae23.css"/>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>

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