<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
$idUtilisateur = $_SESSION['idUtilisateur'];
// $auth = $_SESSION['auth'] = true;
// $nomUtilisateur = $_SESSION['nomUtilisateur']; 
// $prenomUser = $_SESSION['prenomUser'];
$resultat = $connexion->prepare("SELECT nomUtilisateur, prenomUser FROM utilisateur WHERE idUtilisateur = ? ORDER BY idUtilisateur");
$resultat->execute(array($idUtilisateur));
$users = $resultat->fetchAll();
// $idUtilisateur = $_SESSION['idUtilisateur'];
// $_SESSION['auth'] = true;
// $_SESSION['idUtilisateur'] = $data['idUtilisateur'];
// $_SESSION['nomUtilisateur'] = $data['nomUtilisateur'];
// $_SESSION['prenomUser'] = $data['prenomUser'];
// $_SESSION['pseudoUtilisateur'] = $data['pseudoUtilisateur'];
// $_SESSION['typeUtilisateur'] = $data['typeUtilisateur'];

// $resultat = $connexion->prepare("SELECT * FROM utilisateur ORDER BY nomUtilisateur DESC, prenomUser DESC");
// $resultat->execute(array());
// $users = $resultat->fetchAll();  
 
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
    <title>Creation Dossier</title>
    
</head>

<body>
<?php
include_once('../Fichiers_includes/side-bar.php');    
?>
<?php
include_once('../Fichiers_includes/haut-bar.php');    
?>
<div class="">
        
	
		
    <h1>Creation Dossier</h1>
    <form action="enregistrer.php" method="post">
        <label for="nomProjet">Nom projet</label>
        <select id="nomProjet" name="nomProjet">
        <?php foreach($projets as $projet):?>
            <option value="<?php echo $projet['idProjet'];?>"><?php echo $projet['nomProjet'];?></option>
        <?php endforeach;?>
        </select><br><br>
        <!--
        <label for="nomProjet">Nom projet</label>
        <select id="nomProjet" name="nomProjet">
        <?php //foreach($users as $user):?>
            
        <?php //endforeach;?>
        </select><br><br>
        -->
        <label for="numeroAgence">Code de l'agence</label>
        <select id="numeroAgence" name="numeroAgence">
        <?php foreach($agences as $agence):?>
            <option value="<?php echo $agence['idAgence'];?>"><?php echo $agence['numeroAgence'];?></option>
        <?php endforeach;?>
        </select><br><br>
        
        <label for="nomClient">Nom</label>
        <input id="nomClient" type="text" name="nomClient"><br><br>
        <label for="prenomClient">Prenom</label>
        <input id="prenomClient" type="text" name="prenomClient"> <br><br>
        <label for="adresseGeographieClient">Adresse Géographique</label>
        <input id="adresseGeographieClient" type="text" name="adresseGeographieClient"> <br><br>
        <label for="quartierClient">Quartier</label>
        <input id="quartierClient" type="text" name="quartierClient"> <br><br>
        <label for="typePieceClient">Type de pièce</label>
        <select for="typePieceClient" name="typePieceClient"><br><br>
            <option value="cni">cni</option>
            <option value="oni">oni</option>
            <option value="Passe-port">Passe-port</option>
        </select>
        <!-- <input id="typePieceClient" type="text" name="typePieceClient"> <br><br> -->
        <label for="numeroPieceClient">Numéro de pièce</label>
        <input id="numeroPieceClient" type="text" name="numeroPieceClient"> <br><br>
        <label for="contactClient">Contact client</label>
        <input id="contactClient" type="text" name="contactClient"> <br><br>
        <label for="dateReception">Date de réception</label>
        <input id="dateReception" type="date" name="dateReception"><br><br>
        <button type="submit" name="valider">Enregistrer</button>
        <!-- <input type="submit" name="submit" value="Enregistrer"> -->
    </form>
    <br><br>
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
				<!-- <td><?php //echo $dossier['lname'].' '.$dossier['fname']?></td>           -->
                <td><a href="">Modifier</a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="">Supprimer</a></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <tfoot></tfoot>
    </table>
</body>
</html>