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
// $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient, contactClient, dateReception, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur ORDER BY idDossier ASC");
//  $resultat->execute();
//  $dossiers = $resultat->fetchAll();


 

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getDossier = (int) htmlentities(trim($_GET['id']));
    // debut dossiers traite
    $resultat = $connexion->prepare("SELECT dossier.idDossier, numeroAgence, nomAgence, projet.nomProjet, demandeSodeci, polices, codeSecteur, montant, paye, traverseeBitumeCiment, lineaireBranchement, conduiteDeBranchement, dateDeRealisation, dateDeTraitement, observations, traiterPar, poserPar, utilisateur.nomUtilisateur AS nomUtilisateur, utilisateur.prenomUser AS prenomUser FROM dossier JOIN agence ON dossier.idAgence  = agence.idAgence JOIN projet ON dossier.idProjet = projet.idProjet JOIN utilisateur ON utilisateur.idUtilisateur = dossier.idUtilisateur WHERE idDossier = ?");
    $resultat->execute(array($getDossier));
    // $dossierstraites = $resultat->fetchAll();
//fin dossiers traités
       
    
    if($resultat->rowCount() > 0){
        $dossierstraites = $resultat->fetch(PDO::FETCH_ASSOC);
        $demandeSodeci = $dossierstraites['demandeSodeci'];
        $polices = $dossierstraites['polices'];
        $codeSecteur = $dossierstraites['codeSecteur'];
        $montant = $dossierstraites['montant'];
        $paye = $dossierstraites['paye'];
        $traverseeBitumeCiment = $dossierstraites['traverseeBitumeCiment'];
        $lineaireBranchement = $dossierstraites['lineaireBranchement'];
        $conduiteDeBranchement = $dossierstraites['conduiteDeBranchement'];
        $dateDeRealisation = $dossierstraites['dateDeRealisation'];
        $observations = $dossierstraites['observations'];
        $poserPar = $dossierstraites['poserPar'];
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
            $dateDeTraitement = date('Y-m-d');
            
            $updateDossier = $connexion->prepare('UPDATE dossier SET montant = ?, paye = ?, demandeSodeci = ?, polices = ?, codeSecteur = ?, traverseeBitumeCiment = ?, conduiteDeBranchement = ?, lineaireBranchement = ?, observations = ?, poserPar = ?, traiterPar = ?, dateDeRealisation = ?, dateDeTraitement = ? WHERE idDossier = ?');
            
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
    <title>Modifier rapport</title>
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

            <h1>Modifier un rapport</h1>
            <form action="" method="post" class='register_form'>
                <div class='input_label_bloc'>
                    <label for="">ID Dossier</label>
                    <input id="" type="text" value="<?= $dossierstraites['idDossier']; ?>" readonly>
                </div>
                <div class='input_label_bloc'>
                    <label for="">N° Dossier</label>
                    <input id="" type="text"  value="<?= $dossierstraites['numeroAgence'].'-'.$dossierstraites['idDossier'].'-'.$dossierstraites['nomProjet']; ?>" readonly>
                </div>
                <div class='input_label_bloc'>
                    <label for="demandeSodeci">Demande SODECI</label>
                    <input id="demandeSodeci" type="text" name="demandeSodeci" value="<?= $demandeSodeci; ?>">
                </div>
                <div class='input_label_bloc'>
                    <label for="polices">Polices</label>
                    <input id="polices" type="text" name="polices" value="<?= $polices; ?>">
                </div>
                <div class='input_label_bloc'>
                    <label for="codeSecteur">Code secteur</label>
                    <input id="codeSecteur" type="text" name="codeSecteur" value="<?= $codeSecteur; ?>"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="montant">Montant</label>
                    <input id="montant" type="text" name="montant" value="<?= $montant; ?>">
                </div>
                <div class='input_label_bloc'>
                    <label for="traverseeBitumeCiment">Traversée Bitume Ciment</label>
                    <select name="traverseeBitumeCiment" id="traverseeBitumeCiment">
                        <option value="1" <?=($traverseeBitumeCiment==='1')?'selected':'';?>>Traversée</option>
                        <option value="2" <?=($traverseeBitumeCiment==='2')?'selected':'';?>>Bitume</option>
                        <option value="3" <?=($traverseeBitumeCiment==='3')?'selected':'';?>>Ciment</option>
                    </select> 
                </div>
                <!-- <input id="traverseeBitumeCiment" type="text" name="traverseeBitumeCiment">  -->
                <div class='input_label_bloc'>
                    <label for="lineaireBranchement">Linéaire de branchement</label>
                    <input id="lineaireBranchement" type="text" name="lineaireBranchement" value="<?= $lineaireBranchement; ?>"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="conduiteDeBranchement">Conduite de Branchement</label>
                    <input id="conduiteDeBranchement" type="text" name="conduiteDeBranchement" value="<?= $conduiteDeBranchement; ?>"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="poserPar">Posé par</label>
                    <input id="poserPar" type="text" name="poserPar" value="<?= $poserPar; ?>"> 
                </div>
                <div class='input_label_bloc'>
                    <label for="dateDeRealisation">Date de réalisation</label>
                    <input id="dateDeRealisation" type="date" name="dateDeRealisation" value="<?= $dateDeRealisation; ?>">
                </div>
                <!-- <div class='input_label_bloc'>
                    <label for="dateDeTraitement">Date de traitement</label>
                    <input id="dateDeTraitement" type="date" name="dateDeTraitement">
                </div> -->
                <div class='input_label_bloc'>
                    <label for="paye">Paye</label>
                    <div>                        
                        <label for="oui">Oui</label>
                        <input id="paye" type="radio" name="paye" value="oui" id="oui">            
                    
                        <label for="non">Non</label>
                        <input id="paye" type="radio" name="paye" value="non" id="non">                        
                    </div>
                </div>
                <div class='input_label_bloc'>
                    <label for="observations">Observation</label>
                    <textarea name="observations" id="observations" cols="60" rows="10"><?= $observations; ?></textarea>
                </div>
                <div>
                    <button type="submit" name="valider">Modifier rapport</button>
                </div>
            </form>
            
        </div>
    </div>
</body>
</html>