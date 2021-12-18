<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
if(isset($_GET['id']) AND !empty($_GET['id'])){ 
    $getIdDossier = (int) htmlentities(trim($_GET['id'])) ;  
    $resultat = $connexion->prepare("SELECT * FROM dossier WHERE idDossier = ?");
    $resultat->execute(array($getIdDossier));   
    if($resultat->rowCount() > 0){
        $deleteIdUtilisateur = $connexion->prepare("DELETE FROM dossier WHERE idDossier = ?");
        $deleteIdUtilisateur->execute(array($getIdDossier));
        // echo 'Lutilisteur a été bien supprimé !';
        header('Location: dossier.php');
    }else{
        echo 'Aucun dossier trouvé!';
    }
}else{
    echo 'Aucun identifiant trouvé !';
}

?>