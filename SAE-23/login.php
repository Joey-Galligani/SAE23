<?php

session_start();
 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
 

require_once "config.php";
 

$username = $password = "";
$username_err = $password_err = $login_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Entré votre Nom d'utilisateur, s'il vous plait.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Entré votre mot de passe, s'il vous plait.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = $username;
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                           
                            session_start();
                            
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            
                            header("location: index.php");
                        } else{
                            
                            $login_err = "Le Mot de passe ou le Nom d'utilisateur est incorrect.";
                        }
                    }
                } else{
                    
                    $login_err = "Le Mot de passe ou le Nom d'utilisateur est incorrect.";
                }
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
    <title>RT Coin - S'identifier</title>
    <link rel="stylesheet" href="indexsae23.css"/>
    <style>
        body{ font: 14px sans-serif; text-align: center}
        .wrapper{ width: 90%; padding: 5%; }
        h2{ color: #00ff06 }
        body{background-image:url("RT-COIN-2.png");}
    </style>
</head>
<body>

    <div class="wrapper">

        <h2>RT Coin - Identification :</h2>
        <br>
        <p>Veuillez vous identifier pour vous connecter.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div> 
            <br>   
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div id="monForm">
                <input type="submit" class="btn btn-primary" value="Connexion">
            </div>
            <br>
            <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici !</a>.</p>
        </form>
    </div>
</body>
</html>