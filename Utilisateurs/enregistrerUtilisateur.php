<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
//requete modifiee
$resultat = $connexion->prepare("SELECT utilisateur.idUtilisateur, nomUtilisateur, prenomUser, pseudoUtilisateur, motPasseUtilisateur, typeUtilisateur, COUNT(idDossier) AS nb FROM utilisateur LEFT JOIN dossier ON utilisateur.idUtilisateur = dossier.idUtilisateur GROUP BY idUtilisateur, nomUtilisateur, prenomUser, pseudoUtilisateur, motPasseUtilisateur, typeUtilisateur ORDER BY idUtilisateur ASC");
$resultat->execute(array());
$data = $resultat->fetchAll(); 
if(isset($_POST['valider'])){
    if(isset($_POST['nomUtilisateur']) AND isset($_POST['prenomUser'])
        AND isset($_POST['pseudoUtilisateur']) AND isset($_POST['motPasseUtilisateur'])
        AND isset($_POST['contactUtilisateur']) AND isset($_POST['typeUtilisateur']))
    {
        if(!empty($_POST['nomUtilisateur']) AND !empty($_POST['prenomUser'])
            AND !empty($_POST['pseudoUtilisateur']) AND !empty($_POST['motPasseUtilisateur'])
            AND !empty($_POST['contactUtilisateur']) AND !empty($_POST['typeUtilisateur']))
            
        {
            $nomUtilisateur = htmlspecialchars($_POST['nomUtilisateur']);
            $prenomUser = htmlspecialchars($_POST['prenomUser']);
            $pseudoUtilisateur = htmlspecialchars($_POST['pseudoUtilisateur']);
            $motPasseUtilisateur =htmlspecialchars($_POST['motPasseUtilisateur']);
            $contactUtilisateur =htmlspecialchars($_POST['contactUtilisateur']);
            $typeUtilisateur = htmlspecialchars($_POST['typeUtilisateur']);

            $verifieSiPseudoUtilisateurExiste = $connexion->prepare("SELECT pseudoUtilisateur FROM utilisateur WHERE pseudoUtilisateur = ?");
            $verifieSiPseudoUtilisateurExiste->execute(array($pseudoUtilisateur));
            // $verifieSiPseudoUtilisateurExiste->fetchAll()

            if($verifieSiPseudoUtilisateurExiste->rowCount() == 0){           
           
                $inserer = $connexion->prepare('INSERT INTO utilisateur (nomUtilisateur, prenomUser, pseudoUtilisateur, motPasseUtilisateur, typeUtilisateur, contactUtilisateur) VALUES(?, ?, ?, ?, ?, ?)');
                $inserer->execute(array($nomUtilisateur, $prenomUser, $pseudoUtilisateur, $motPasseUtilisateur, $typeUtilisateur, $contactUtilisateur));

                // $resultat = $connexion->prepare("SELECT * FROM utilisateur ORDER BY idUtilisateur ASC");
                // $resultat->execute(array());
                // $data = $resultat->fetch();
            }else{
                echo 'L\'utilisateur existe déjà sur le site';
            }      


        }else{
            echo "Veuillez entrer tous les champs !";
        }
        
    }
}
?>
<?php
    include_once('../Fichiers_includes/side-bar.php');    
?>
<?php
    include_once('../Fichiers_includes/haut-bar.php');    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'utilisateur</title>
</head>
<body>
    <h1>Création d'utilisateur</h1>
    <form action="" method="post">
        <label for="nomUtilisateur">Nom d'utilisateur</label>
        <input id="nomUtilisateur" type="text" name="nomUtilisateur"><br><br>
        <label for="prenomUser">Prénoms d'utilisateur</label>
        <input id="prenomUser" type="text" name="prenomUser"><br><br>
        <label for="pseudoUtilisateur">Pseudo utilisateur</label>
        <input id="pseudoUtilisateur" type="text" name="pseudoUtilisateur"><br><br>
        <label for="motPasseUtilisateur">Mot de passe utilisateur</label>
        <input id="motPasseUtilisateur" type="password" name="motPasseUtilisateur"><br><br>
        <label for="typeUtilisateur">Type utilisateur</label>
        <select name="typeUtilisateur" id="">
            <option>Choisir type d'utilisateur</option>    
            <option value="1">Admin</option>
            <option value="2">Invité</option>
            <option value="3">Responsable</option>             
        </select><br><br>      
        <label for="contactUtilisateur">Contact utilisateur</label>
        <input id="contactUtilisateur" type="text" name="contactUtilisateur"><br><br>
        <button type="submit" name="valider">Enregistrer</button>
        <button type="reset" name="valider">Annuler</button>
    </form>
    <br><br>
    
    <?php require_once('listeUtilisateurs.php')?>    
</body>
</html>