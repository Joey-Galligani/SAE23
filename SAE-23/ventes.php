<?php

session_start();
     require_once 'config.php';
 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

try
    { 
        $mysqlClient = new PDO('mysql:host=localhost;dbname=db_GALLIGANI;charset=UTF8','22100332','JoeyJoey',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
    catch(Exception $e)
    {
            die('Erreur : '.$e->getMessage());
    }
        $USER = $_SESSION['username'];
        

        $REQUETE = "UPDATE users SET bitcoin = bitcoin-0.1 WHERE username='".$USER."';";
        $insert = $mysqlClient->prepare($REQUETE);
        $insert->execute();
        
   
        header("Location: AetV.php");

    
?>