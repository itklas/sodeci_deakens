<?php
@session_start();
$serveur = "localhost";
$login = "root";
$pass = "root";
$base = "sodeci_deakens";
try{
    $connexion = new PDO('mysql:host=' .$serveur . ';dbname=' . $base, $login, $pass);
    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'la connexion à la base de données réussie';
}
catch(PDOException $e){
    echo 'Echec de la connexion : ' .$e->getMessage();
}

?>