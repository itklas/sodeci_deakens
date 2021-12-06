<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
$idUtilisateur = $_SESSION['idUtilisateur'];

$resultat = $connexion->prepare("SELECT nomUtilisateur, prenomUser FROM utilisateur WHERE idUtilisateur = ? ORDER BY idUtilisateur");
$resultat->execute(array($idUtilisateur));
$users = $resultat->fetchAll();

 
 $resultat = $connexion->prepare("SELECT * FROM agence ORDER BY nomAgence DESC");
 $resultat->execute();
 $agences = $resultat->fetchAll();

 $resultat = $connexion->prepare("SELECT * FROM projet ORDER BY nomProjet DESC");
 $resultat->execute();
 $projets = $resultat->fetchAll();
//
 $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur ORDER BY idDossier ASC");
 $resultat->execute();
 $dossiers = $resultat->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrement de rapport</title>
    <style>
        .trtb{
            border: 1px solid red;
        }
    </style>
</head>

<body>
<?php
include_once('../Fichiers_includes/side-bar.php');    
?>
<?php
include_once('../Fichiers_includes/haut-bar.php');    
?>
<div class="">  
 
    <br><br>
    <h2>Différrents dossiers enregistrés</h2>
    <table border='1'>
        <thead>
            <tr class="trtb">
                <th>ID Dossier</th>
                <th>Code de l'agence</th>
                <th>N° Dossier<br>(codeAgence-ID-Nom projet)</th>
                <th>Nom et Prenoms</th>
                <th>Quartier / Adresse</th>
                <th>N°Piece (Type)</th>
                <th>Contact</th>
                <th>Date de réception</th>
                <th>Enregistrer par</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($dossiers as $dossier):?>
            <tr>
                <td><?php echo $dossier['idDossier']?></td>
                <td><?php echo $dossier['numeroAgence']?></td>
                <td><?php echo $dossier['numeroAgence'].'-'.$dossier['idDossier'].'-'.$dossier['nomProjet']?></td>
                <td><?php echo $dossier['nomClient'].' '.$dossier['prenomClient']?></td>
                <td><?php echo $dossier['quartierClient'].' / '.$dossier['adresseGeographieClient']?></td>
                <td><?php echo $dossier['numeroPieceClient']?></td>
                <td><?php echo $dossier['contactClient']?></td>
                <td><?php echo $dossier['dateReception']?></td>
                <td><?php echo $dossier['nomUtilisateur'].' '.$dossier['prenomUser']?></td>
				<!-- <td><?php //echo $dossier['lname'].' '.$dossier['fname']?></td> -->
                <td><a href="ajouterRapport.php?id=<?= $dossier['idDossier']; ?>">Ajouter un rapport</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot></tfoot>
    </table>
    <br><br>
    
</div>
</body>
</html>