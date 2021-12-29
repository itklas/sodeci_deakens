<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
$resultat = $connexion->prepare("SELECT idUtilisateur, lockUser FROM utilisateur WHERE idUtilisateur=?");
$resultat->execute(array($_GET['id']));
$users = $resultat->fetchAll();
if (sizeof($users)==1) {
    if ($users[0]['lockUser']==1) {
        $resultat = $connexion->prepare("UPDATE utilisateur SET lockUser=? WHERE idUtilisateur=?");
        $resultat->execute(array(0 , $_GET['id']));
    } else {
        $resultat = $connexion->prepare("UPDATE utilisateur SET lockUser=? WHERE idUtilisateur=?");
        $resultat->execute(array(1 , $_GET['id']));
    }
    header('Location: enregistrerUtilisateur.php');
} else {
    echo 'erreur : utilisateur non existant';
}


?>