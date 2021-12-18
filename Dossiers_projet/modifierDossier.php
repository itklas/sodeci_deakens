<?php
include_once ('../connexion/connexion.php');
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

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getIdDossier = (int) htmlentities(trim($_GET['id']));
    $resultat = $connexion->prepare("SELECT nomClient, prenomClient, dateReception, quartierClient, numeroPieceClient, typePieceClient, adresseGeographieClient, contactClient, idDossier, nomProjet, agence.idAgence, numeroAgence FROM dossier JOIN projet ON projet.idProjet = dossier.idProjet JOIN agence ON agence.idAgence = dossier.idAgence WHERE idDossier = ?");
    $resultat->execute(array($getIdDossier));   
    
    if($resultat->rowCount() > 0){
        $datasDossier = $resultat->fetch(PDO::FETCH_ASSOC);
        $nomClient = $datasDossier['nomClient'];
        $prenomClient = $datasDossier['prenomClient'];
        $quartierClient = $datasDossier['quartierClient'];
        $numeroPieceClient = $datasDossier['numeroPieceClient'];
        $typePieceClient = $datasDossier['typePieceClient'];
        $adresseGeographieClient = $datasDossier['adresseGeographieClient'];
        $contactClient = $datasDossier['contactClient'];
        $dateReception = $datasDossier['dateReception'];
        // $numeroAgence = $datasDossier['numeroAgence'];
        // $nomProjet = $datasUtilisateur['nomProjet'];       
        // // echo 'Lutilisteur a été bien supprimé !';
        // header('Location: enregistrerUtilisateur.php');
        if(isset($_POST['valider'])){
            $nomClient = htmlspecialchars($_POST['nomClient']);
            $prenomClient = htmlspecialchars($_POST['prenomClient']);
            $quartierClient = htmlspecialchars($_POST['quartierClient']);
            $numeroPieceClient = htmlspecialchars($_POST['numeroPieceClient']);
            $typePieceClient = htmlspecialchars($_POST['typePieceClient']);
            $adresseGeographieClient = htmlspecialchars($_POST['adresseGeographieClient']);
            $contactClient = htmlspecialchars($_POST['contactClient']);
            $dateReception = htmlspecialchars($_POST['dateReception']);
                        
            $updateDossier = $connexion->prepare("UPDATE dossier SET nomClient = ?, prenomClient = ?, adresseGeographieClient = ?, quartierClient = ?, typePieceClient = ?, numeroPieceClient = ?, contactClient = ?, dateReception = ?,  WHERE idDossier = $getIdDossier"); 
            $updateDossier->execute(array($nomClient, $prenomClient, $adresseGeographieClient, $quartierClient, $typePieceClient, $numeroPieceClient, $contactClient, $dateReception, $getIdDossier));
            header('Location: dossier.php');
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
    <title>Creation Dossier</title>
    
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
        <h1>Modifier un Dossier</h1>
        <form action="" method="post" class='register_form'>
            <div class='input_label_bloc'>
                <label for="nomProjet">Nom projet</label>
                <select id="nomProjet" name="nomProjet">
                <?php foreach($projets as $projet):?>
                    <option value="<?php echo $idProjet;?>"><?php echo $projet['nomProjet'];?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class='input_label_bloc'>
                <label for="numeroAgence">Code de l'agence</label>
                <select id="numeroAgence" name="numeroAgence">
                <?php foreach($agences as $agence):?>
                    <!-- <option>Choisir une agence</option> -->
                    <option value="<?php echo $agence['idAgence'];?>">
                    <?php echo $agence['numeroAgence'];?></option>
                <?php endforeach;?>
                </select>
            </div>
            <div class='input_label_bloc'>
                <label for="nomClient">Nom</label>
                <input id="nomClient" type="text" name="nomClient" value="<?= $nomClient; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="prenomClient">Prenom</label>
                <input id="prenomClient" type="text" name="prenomClient" value="<?= $prenomClient; ?>"> 
            </div>
            <div class='input_label_bloc'>
                <label for="adresseGeographieClient">Adresse Géographique</label>
                <input id="adresseGeographieClient" type="text" name="adresseGeographieClient" value="<?= $adresseGeographieClient; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="quartierClient">Quartier</label>
                <input id="quartierClient" type="text" name="quartierClient" value="<?= $quartierClient; ?>"> 
            </div>
            <div class='input_label_bloc'>
                <label for="typePieceClient">Type de pièce</label>
                <select for="typePieceClient" name="typePieceClient">
                    <option value="cni" <?=($typePieceClient==='cni')?'selected':'';?>>cni</option>
                    <option value="oni" <?=($typePieceClient==='oni')?'selected':'';?>>oni</option>
                    <option value="Passe-port" <?=($typePieceClient==='Passe-port')?'selected':'';?>>Passe-port</option>
                </select>
            </div>
            <div class='input_label_bloc'>
                <label for="numeroPieceClient">Numéro de pièce</label>
                <input id="numeroPieceClient" type="text" name="numeroPieceClient" value="<?= $numeroPieceClient; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="contactClient">Contact client</label>
                <input id="contactClient" type="text" name="contactClient" value="<?= $contactClient; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="dateReception">Date de réception</label>
                <input id="dateReception" type="date" name="dateReception" value="<?= $dateReception; ?>">
            </div>
            <button type="submit" name="valider">Enregistrer</button>
            <!-- <input type="submit" name="submit" value="Enregistrer"> -->
        </form>
    </div>
</div>
</div>    
</body>
</html>