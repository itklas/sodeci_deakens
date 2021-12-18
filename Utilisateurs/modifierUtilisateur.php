<?php
include_once('../connexion/connexion.php');
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}

if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getIdUtilisateur = (int) htmlentities(trim($_GET['id']));
    $resultat = $connexion->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = ?");
    $resultat->execute(array($getIdUtilisateur));
    
    //echo '<pre>';var_dump($datasUtilisateur);echo '</pre>';
    //echo 'NB: '.$resultat->rowCount().'<br>';
    //exit();
    if($resultat->rowCount() > 0){
        $datasUtilisateur = $resultat->fetch(PDO::FETCH_ASSOC);
        if(isset($_POST['valider'])){
            $nomUtilisateur = htmlspecialchars($_POST['nomUtilisateur']);
            $prenomUser = htmlspecialchars($_POST['prenomUser']);
            $pseudoUtilisateur = htmlspecialchars($_POST['pseudoUtilisateur']);
            $motPasseUtilisateur = htmlspecialchars($_POST['motPasseUtilisateur']);
            $typeUtilisateur = htmlspecialchars($_POST['typeUtilisateur']);
            $contactUtilisateur = htmlspecialchars($_POST['contactUtilisateur']);
            
            
            $updateUtilisateur = $connexion->prepare('UPDATE utilisateur SET nomUtilisateur = ?, prenomUser = ?, pseudoUtilisateur = ?, motPasseUtilisateur = ?, typeUtilisateur = ?, contactUtilisateur = ? WHERE idUtilisateur = ?'); 
            $updateUtilisateur->execute(array($nomUtilisateur, $prenomUser,$pseudoUtilisateur, $motPasseUtilisateur, $typeUtilisateur, $contactUtilisateur, $getIdUtilisateur));
            header('Location: enregistrerUtilisateur.php');
        }
    }else{
        echo 'Aucun utilisateur trouvé!';
    }
}else{
    echo 'Aucun identifiant trouvé !';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../Fichiers_includes/sidebar.css">
    <title>Modifier l'utilisateur</title>
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
        <form action="" method="post" class='register_form'>
            <div class='input_label_bloc'>
                <label for="nomUtilisateur">Nom d'utilisateur</label>
                <input id="nomUtilisateur" type="text" name="nomUtilisateur" value="<?= @$datasUtilisateur['nomUtilisateur']; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="prenomUser">Prénoms d'utilisateur</label>
                <input id="prenomUser" type="text" name="prenomUser" value="<?= @$datasUtilisateur['prenomUser']; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="pseudoUtilisateur">Pseudo utilisateur</label>
                <input id="pseudoUtilisateur" type="text" name="pseudoUtilisateur" value="<?= @$datasUtilisateur['pseudoUtilisateur']; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="motPasseUtilisateur">Mot de passe utilisateur</label>
                <input id="motPasseUtilisateur" type="text" name="motPasseUtilisateur" value="<?= @$datasUtilisateur['motPasseUtilisateur']; ?>">
            </div>
            <div class='input_label_bloc'>
                <label for="typeUtilisateur">Type utilisateur</label>
                <select name="typeUtilisateur" id="">
                    <option>Choisir type d'utilisateur</option>
                    <option value="1" <?=(@$datasUtilisateur['typeUtilisateur']==='1')?'selected':'';?>>Admin</option>
                    <option value="2" <?=(@$datasUtilisateur['typeUtilisateur']==='2')?'selected':'';?>>Invité</option>
                    <option value="3" <?=(@$datasUtilisateur['typeUtilisateur']==='3')?'selected':'';?> >Responsable</option>             
                </select>
            </div>
            <div class='input_label_bloc'>
                <label for="contactUtilisateur">Contact utilisateur</label>
                <input id="contactUtilisateur" type="text" name="contactUtilisateur" value="<?= @$datasUtilisateur['contactUtilisateur']; ?>">
            </div>
            <button type="submit" name="valider">Enregistrer</button>
            <button type="reset" name="valider">Annuler</button>
        </form>
    </div>
</div>
</body>
</html>