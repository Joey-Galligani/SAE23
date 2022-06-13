<?php

require_once "config.php";
 

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = "Entrer un nom d'utilisateur.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Le nom d'utilisateur ne peut contenir que des lettres, des chiffres et des caractères de soulignement.";
    } else{
        
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "Ce nom d'utilsateur est déjà utilisé.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Un problème est survenu. Veuillez réessayer plus tard.";
            }

            
            mysqli_stmt_close($stmt);
        }
    }
    
  
    if(empty(trim($_POST["password"]))){
        $password_err = "Entrer un mot de passe, s'il vous plait.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Le mot de passe doit être composé d'au moins 6 caractères.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirmer le mot de passe.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Le mot de passe ne correspond pas.";
        }
    }
    
   
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
       
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); 
            
            if(mysqli_stmt_execute($stmt)){
               
                header("location: login.php");
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
    <title>RT - S'inscrire</title>
    <link rel="stylesheet" href="indexsae23.css"/>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
        .wrapper{ width: 90%; padding: 5%; }
        h2{ color: #00ff06 }
        body{background-image:url("RT-COIN-2.png");}

    </style>
</head>
<body>
    
    <div class="wrapper">
        <h2>S'inscrire :</h2>
        <br>
        <p>Veuillez remplir ce formulaire pour créer un compte.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <br>
            <div class="form-group">
                <label>Nom d'utilisateur</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <br>  
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <label>Confirmer votre mot de passe</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalide' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <br>
            <div id="monForm">
                <input type="submit" class="btn btn-primary" value="Valider">
                <input type="reset" class="btn btn-secondary ml-2" value="Annuler">
            </div>
            <br>
            <p>Vous avez déjà un compte ? <a href="login.php">Identifiez vous ici</a>.</p>
        </form>
    </div>    
</body>
</html>