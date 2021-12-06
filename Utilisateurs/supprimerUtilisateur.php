<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
if(isset($_GET['id']) AND !empty($_GET['id'])){ 
    $getIdUtilisateur = (int) htmlentities(trim($_GET['id'])) ;  
    $resultat = $connexion->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
    $resultat->execute(array($getIdUtilisateur));   
    if($resultat->rowCount() > 0){
        $deleteIdUtilisateur = $connexion->prepare("DELETE FROM utilisateur WHERE idUtilisateur = ?");
        $deleteIdUtilisateur->execute(array($getIdUtilisateur));
        // echo 'Lutilisteur a été bien supprimé !';
        header('Location: enregistrerUtilisateur.php');
    }else{
        echo 'Aucun utilisateur trouvé!';
    }
}else{
    echo 'Aucun identifiant trouvé !';
}

?>