<?php
include_once ('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}

$idUtilisateur = $_SESSION['idUtilisateur'];
// echo '<pre>';
// print_r($idUtilisateur);
// echo '<pre>';

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
 $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur WHERE (montant IS NULL AND paye IS NULL AND traverseeBitumeCiment IS NULL AND lineaireBranchement IS NULL AND conduiteDeBranchement IS NULL AND dateDeRealisation IS NULL AND dateDeTraitement IS NULL AND demandeSodeci IS NULL AND polices IS NULL AND codeSecteur IS NULL) ORDER BY idDossier ASC");
 $resultat->execute();
 $dossiers = $resultat->fetchAll();

 // debut dossiers traite
 $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, concat(nomClient, ' ', prenomClient) AS nomprenoms,  demandeSodeci, polices, codeSecteur, montant, paye, traverseeBitumeCiment, lineaireBranchement, conduiteDeBranchement, dateDeRealisation, dateDeTraitement, observations, traiterPar, poserPar, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = traiterPar WHERE (montant IS NOT NULL AND paye IS NOT NULL AND traverseeBitumeCiment IS NOT NULL AND lineaireBranchement IS NOT NULL AND conduiteDeBranchement IS NOT NULL AND dateDeRealisation IS NOT NULL AND dateDeTraitement IS NOT NULL AND demandeSodeci IS NOT NULL AND polices IS NOT NULL AND codeSecteur IS NOT NULL) ORDER BY idDossier ASC");
 $resultat->execute();
 $dossierstraites = $resultat->fetchAll();
 //fin dossiers traités



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

            
            <h2 class="table_title">Différrents dossiers traités</h2>
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
                            <td><a href="ajouterRapport.php?id=<?= $dossier['idDossier']; ?>">Rapport</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                    <tfoot></tfoot>
                </table>
                <br><br>
                <h2 class="table_title">Différrents rappots enregistrés</h2>
            <table class="register_table">
                <thead>
                    <tr>
                        <th>N° Dossier(Nom & prenoms)</th>
                        <th>Montant</th>
                        <th>Paye</th>
                        <th>Demande SODECI | Polices | Code secteur</th>
                        <th>Traversée-Bitume-Ciment</th>
                        <th>Linéaire de branchement</th>
                        <th>Conduite de Branchement</th>
                        <th>Date de réalisation</th>
                        <th>Date de traitement</th>
                        <th>Observation</th>
                        <th>Traité Par | Posé Par</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dossierstraites as $dossierstraite):?>
                    <tr>
                        <td><?php echo $dossierstraite['numeroAgence'].'-'.$dossierstraite['idDossier'].'-'.$dossierstraite['nomProjet'].'('.$dossierstraite['nomprenoms'].')';?></td>
                        <td><?php echo $dossierstraite['montant']?> </td>
                        <td> <?php echo $dossierstraite['paye']?></td>
                        <td><?php echo $dossierstraite['demandeSodeci'].' | '.$dossierstraite['polices'].' | '.$dossierstraite['codeSecteur']?></td>
                        <td>
                        <?php if($dossierstraite['traverseeBitumeCiment']==1){
                                    echo 'Traversee';
                                }elseif($dossierstraite['traverseeBitumeCiment']==2){
                                    echo 'Bitume';
                                }elseif($dossierstraite['traverseeBitumeCiment']==3){
                                    echo 'Ciment';
                                }                    
                        ?>
                        </td>
                        <td><?php echo $dossierstraite['lineaireBranchement']?></td>
                        <td><?php echo $dossierstraite['conduiteDeBranchement']?></td>
                        <td><?php echo $dossierstraite['dateDeRealisation']?></td>
                        <td><?php echo $dossierstraite['dateDeTraitement']?></td>
                        <td><?php echo $dossierstraite['observations']?></td>
                        <td>
                            <?php echo $dossierstraite['nomUtilisateur'].' '.$dossierstraite['prenomUser'].' | '.$dossierstraite['poserPar']?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table> 
        </div>
        </div>
    </div>
</body>
</html>