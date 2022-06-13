<?php

session_start();
 

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 

require_once "config.php";
 

$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Entrer un mot de passe, s'il vous plait.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Le mot de passe doit être composé d'au moins 6 caractères.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
 
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirmer le mot de passe.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Le mot de passe ne correspond pas.";
        }
    }
        
    
    if(empty($new_password_err) && empty($confirm_password_err)){
        
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
           
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            
            if(mysqli_stmt_execute($stmt)){
                
                session_destroy();
                header("location: login.php");
                exit();
            } else{
                echo "Un problème est survenu. Veuillez réessayer plus tard.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RT Coin - Changer votre mot de passe :</title>
    <link rel="stylesheet" href="indexsae23.css"/>
    <style>
        body{ font: 14px sans-serif; text-align: center }
        .wrapper{ width: 90%; padding: 5%; }
        h2{ color: #00ff06; }
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
                <a href="logout.php" class="btn btn-danger ml-3">Se deconnecter</a>
            </li>
		</ul>	
	</nav>

    <div class="wrapper">

        <h2>Changer votre mot de passe : </h2>
        <br>
        <p>Veuillez remplir ce formulaire pour réinitialiser votre mot de passe.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
        <br>

        <?php echo $new_password_err; ?><?php echo $confirm_password_err; ?>
        <br>
        <br>
            <div class="form-group">
                <label>Nouveau mot de passe</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"></span>
            </div>
            <br>
            <div class="form-group">
                <label>Confirmer votre mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"></span>
            </div>
            <br>
            <br>
            <div id="monForm">
                <input type="submit" class="btn btn-primary" value="Valider">
                <input type="reset" class="btn btn-primary" value="Annuler" href="welcome.php">
            </div>
        </form>
    </div>    
</body>
</html>