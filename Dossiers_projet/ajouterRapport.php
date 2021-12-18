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
 $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur ORDER BY idDossier ASC");
 $resultat->execute();
 $dossiers = $resultat->fetchAll();

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getDossier = (int) htmlentities(trim($_GET['id']));
    $resultat = $connexion->prepare("SELECT idDossier, nomProjet, agence.idAgence, numeroAgence FROM dossier JOIN projet ON projet.idProjet = dossier.idProjet JOIN agence ON agence.idAgence = dossier.idAgence WHERE idDossier = ?");
    $resultat->execute(array($getDossier));   
    
    if($resultat->rowCount() > 0){
        $datasDossier = $resultat->fetch(PDO::FETCH_ASSOC);
        // $idDossier = $datasDossier['idDossier'];
        // $numeroAgence = $datasDossier['numeroAgence'];
        // $nomProjet = $datasUtilisateur['nomProjet'];       
        // // echo 'Lutilisteur a été bien supprimé !';
        // header('Location: enregistrerUtilisateur.php');
        if(isset($_POST['valider'])){
            $montant = htmlspecialchars($_POST['montant']);
            $paye = htmlspecialchars($_POST['paye']);
            $demandeSodeci = htmlspecialchars($_POST['demandeSodeci']);
            $polices = htmlspecialchars($_POST['polices']);
            $codeSecteur = htmlspecialchars($_POST['codeSecteur']);
            $traverseeBitumeCiment = htmlspecialchars($_POST['traverseeBitumeCiment']);
            $conduiteDeBranchement = htmlspecialchars($_POST['conduiteDeBranchement']);
            $lineaireBranchement = htmlspecialchars($_POST['lineaireBranchement']);
            $observations = htmlspecialchars($_POST['observations']);
            $poserPar = htmlspecialchars($_POST['poserPar']);
            $idUtilisateur = $_SESSION['idUtilisateur'];
            $dateDeRealisation = htmlspecialchars($_POST['dateDeRealisation']);
            $dateDeTraitement = htmlspecialchars($_POST['dateDeTraitement']);
            
            $updateDossier = $connexion->prepare("UPDATE dossier SET montant = ?, paye = ?, demandeSodeci = ?, polices = ?, codeSecteur = ?, traverseeBitumeCiment = ?, conduiteDeBranchement = ?, lineaireBranchement = ?, observations = ?, poserPar = ?, traiterPar = ?, dateDeRealisation = ?, dateDeTraitement = ?, WHERE idDossier = '$getDossier'"); 
            $updateDossier->execute(array($montant, $paye, $demandeSodeci, $polices, $codeSecteur, $traverseeBitumeCiment, $conduiteDeBranchement, $lineaireBranchement, $observations, $poserPar, $idUtilisateur, $dateDeRealisation, $dateDeTraitement, $getDossier));
            header('Location: rapport.php');
        }
    }else{
        echo 'Aucun dossier trouvé!';
    }
}else{
    echo 'Aucun identifiant trouvé !';
}

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

            <h1>Ajouter un rapport</h1>
            <form action="" method="post" class='register_form'>
                <div class='input_label_bloc'>
                    <label for="">ID Dossier</label>
                    <input id="" type="text" value="<?= $datasDossier['idDossier']; ?>" readonly>
                </div>
                <div class='input_label_bloc'>
                    <label for="">N° Dossier</label>
                    <input id="" type="text"  value="<?= $datasDossier['numeroAgence'].'-'.$datasDossier['idDossier'].'-'.$datasDossier['nomProjet']; ?>" readonly>
                </div>
                <div class='input_label_bloc'>
                    <label for="demandeSodeci">Demande SODECI</label>
                    <input id="demandeSodeci" type="text" name="demandeSodeci">
                </div>
                <div class='input_label_bloc'>
                    <label for="polices">Polices</label>
                    <input id="polices" type="text" name="polices">
                </div>
                <div class='input_label_bloc'>
                    <label for="codeSecteur">Code secteur</label>
                    <input id="codeSecteur" type="text" name="codeSecteur"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="montant">Montant</label>
                    <input id="montant" type="text" name="montant">
                </div>
                <div class='input_label_bloc'>
                    <label for="traverseeBitumeCiment">Traversée Bitume Ciment</label>
                    <select name="traverseeBitumeCiment" id="traverseeBitumeCiment">
                        <option value="1">Traversée</option>
                        <option value="2">Bitume</option>
                        <option value="3">Ciment</option>
                    </select> 
                </div>
                <!-- <input id="traverseeBitumeCiment" type="text" name="traverseeBitumeCiment">  -->
                <div class='input_label_bloc'>
                    <label for="lineaireBranchement">Linéaire de branchement</label>
                    <input id="lineaireBranchement" type="text" name="lineaireBranchement"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="conduiteDeBranchement">Conduite de Branchement</label>
                    <input id="conduiteDeBranchement" type="text" name="conduiteDeBranchement"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="poserPar">Posé par</label>
                    <input id="poserPar" type="text" name="poserPar"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="dateDeRealisation">Date de réalisation</label>
                    <input id="dateDeRealisation" type="date" name="dateDeRealisation">
                </div>
                <div class='input_label_bloc'>
                    <label for="dateDeTraitement">Date de traitement</label>
                    <input id="dateDeTraitement" type="date" name="dateDeTraitement">
                </div>
                <div class='input_label_bloc'>
                    <label for="paye">Paye</label>
                    <div>
                        <input id="paye" type="radio" name="paye" value="oui">Oui 
                        <input id="paye" type="radio" name="paye" value="non">Non 
                    </div>
                </div>
                <div class='input_label_bloc'>
                    <label for="observations">Observation</label>
                    <textarea name="observations" id="observations" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" name="valider">Ajouter rapport</button>
                <!-- <input type="submit" name="submit" value="Enregistrer"> -->
            </form>
            
            <h2>Différrents dossiers enregistrés</h2>
            <table class="register_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Dossier</th>
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
            
            <h2>Différrents rappots enregistrés</h2>
            <table class="register_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>N° Dossier</th>
                        <th>Demande SODECI</th>
                        <th>Polices</th>
                        <th>Code secteur</th>
                        <th>Paye</th>
                        <th>Montant</th>
                        <th>Traversée-Bitume-Ciment</th>
                        <th>Linéaire de branchement</th>
                        <th>Conduite de Branchement</th>
                        <th>Date de réalisation</th>
                        <th>Date de traitement</th>
                        <th>Observation</th>
                        <th>Actions</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php foreach($dossiers as $dossier):?>
                    <tr>
                        <td><?php echo $dossier['idDossier']?></td>
                        <td><?php echo $dossier['numeroAgence'].'-'.$dossier['idDossier'].'-'.$dossier['nomProjet']?></td>
                        <td><?php echo $dossier['demandeSodeci']?></td>
                        <td><?php echo $dossier['polices']?></td>
                        <td><?php echo $dossier['codeSecteur']?></td>
                        <td><?php echo $dossier['paye']?></td>
                        <td><?php echo $dossier['montant']?></td>
                        <td><?php echo $dossier['traverseeBitumeCiment']?></td>
                        <td><?php echo $dossier['lineaireBranchement']?></td>
                        <td><?php echo $dossier['conduiteDeBranchement']?></td>
                        <td><?php echo $dossier['dateDeRealisation']?></td>
                        <td><?php echo $dossier['dateDeTraitement']?></td>
                        <td><?php echo $dossier['observation']?></td>
                        <!-- <td><?php //echo $dossier['lname'].' '.$dossier['fname']?></td>           -->
                        <td><a href="modifierRapport.php?id=<?= $dossier['idDossier']; ?>">Modifier rapport</a></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
                <tfoot></tfoot>
            </table> 
        </div>
    </div>
</body>
</html>