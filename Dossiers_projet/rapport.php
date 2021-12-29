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
 $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur WHERE (montant is null AND paye is null AND demandeSodeci is null AND polices is null AND codeSecteur is null AND traverseeBitumeCiment is null AND conduiteDeBranchement is null AND lineaireBranchement is null AND observations is null AND poserPar is null AND traiterPar is null AND dateDeRealisation is null AND dateDeTraitement is null) ORDER BY idDossier ASC");
 $resultat->execute();
 $dossiers = $resultat->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../Fichiers_includes/sidebar.css">
    <title>Enregistrement de rapport</title>
</head>

<body>
    <div class="register">
        <?php
        include_once('../Fichiers_includes/side-bar.php');    
        ?>
        
        <div class="register_rigth">
            <?php
            include_once('../Fichiers_includes/haut-bar.php');    
            ?>
            <div class="">  
                <h2 class="table_title">Différrents dossiers enregistrés non traités</h2>
                <table class="rapport_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>N° Dossier</th>
                            <th>Nom et Prenoms</th>
                            <th>Quartier / Adresse</th>
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
                            <td><?php echo $dossier['numeroAgence'].'-'.$dossier['idDossier'].'-'.$dossier['nomProjet']?></td>
                            <td><?php echo $dossier['nomClient'].' '.$dossier['prenomClient']?></td>
                            <td><?php echo $dossier['quartierClient'].' / '.$dossier['adresseGeographieClient']?></td>
                            <td><?php echo $dossier['contactClient']?></td>
                            <td><?php echo $dossier['dateReception']?></td>
                            <td><?php echo $dossier['nomUtilisateur'].' '.$dossier['prenomUser']?></td>
                            <td><a href="ajouterRapport.php?id=<?= $dossier['idDossier']; ?>"><i class="fas fa-clipboard"></i></a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
                <br><br>
                
            </div>
        </div>
    </div>

</body>
</html>