<?php
include_once('../connexion/connexion.php');


if(isset($_POST['valider'])){
    if(isset($_POST['nomClient'])
        AND isset($_POST['prenomClient']) AND isset($_POST['adresseGeographieClient'])
        AND isset($_POST['quartierClient']) AND isset($_POST['typePieceClient'])
        AND isset($_POST['numeroPieceClient']) AND isset($_POST['contactClient'])
        AND isset($_POST['dateReception']) AND isset($_POST['nomProjet']) 
        AND isset($_POST['numeroAgence']))
    {
        if(!empty($_POST['nomClient'])
            AND !empty($_POST['prenomClient']) AND !empty($_POST['adresseGeographieClient'])
            AND !empty($_POST['quartierClient']) AND !empty($_POST['typePieceClient'])
            AND !empty($_POST['numeroPieceClient']) AND !empty($_POST['contactClient'])
            AND !empty($_POST['dateReception']) AND !empty($_POST['nomProjet']) 
            AND !empty($_POST['numeroAgence']))
        {
            $nomClient=htmlspecialchars($_POST['nomClient']);
            $prenomClient=htmlspecialchars($_POST['prenomClient']);
            $adresseGeographieClient=htmlspecialchars($_POST['adresseGeographieClient']);
            $quartierClient=htmlspecialchars($_POST['quartierClient']);
            $typePieceClient=htmlspecialchars($_POST['typePieceClient']);
            $numeroPieceClient=htmlspecialchars($_POST['numeroPieceClient']);
            $contactClient=htmlspecialchars($_POST['contactClient']);
            $dateReception=htmlspecialchars($_POST['dateReception']);
            $idProjet=htmlspecialchars($_POST['nomProjet']);
            $idAgence = htmlspecialchars($_POST['numeroAgence']);
            $idUtilisateur = $_SESSION['idUtilisateur'];
            //  echo '<pre>';
            //  print_r($_POST);
            //  print_r($_SESSION);
            //  echo '</pre>';exit();             
             
            $inserer = $connexion->prepare('INSERT INTO dossier (nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, idUtilisateur, idAgence, idProjet) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
             
            $inserer->execute(array($nomClient, $prenomClient, $adresseGeographieClient, $quartierClient, $typePieceClient, $numeroPieceClient, $contactClient, $dateReception, $idUtilisateur, $idAgence, $idProjet));        
       
            header('Location: dossier.php');
        
        }else{
            echo "Veuillez entrer tous les champs !";
        }
    }
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>