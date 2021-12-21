<?php
include_once('connexion/connexion.php');

if(isset($_POST['submit'])){
    if(!empty($_POST['pseudoUtilisateur']) AND !empty($_POST['motPasseUtilisateur'])){
        $pseudoUtilisateur = htmlspecialchars($_POST['pseudoUtilisateur']);
        $motPasseUtilisateur = htmlspecialchars($_POST['motPasseUtilisateur']);

        $verifieSiPseudoUtilisateurExiste = $connexion->prepare("SELECT * FROM utilisateur WHERE pseudoUtilisateur = ?");
        $verifieSiPseudoUtilisateurExiste->execute(array($pseudoUtilisateur));  
        

        if($verifieSiPseudoUtilisateurExiste->rowCount() > 0){
            $dataUtilisateur = $verifieSiPseudoUtilisateurExiste->fetch();
            if($dataUtilisateur['motPasseUtilisateur'] == $motPasseUtilisateur){
                
                $_SESSION['auth'] = true;
                $_SESSION['idUtilisateur'] = $dataUtilisateur['idUtilisateur'];
                $_SESSION['nomUtilisateur'] = $dataUtilisateur['nomUtilisateur'];
                $_SESSION['prenomUser'] = $dataUtilisateur['prenomUser'];
                $_SESSION['pseudoUtilisateur'] = $dataUtilisateur['pseudoUtilisateur'];
                $_SESSION['typeUtilisateur'] = $dataUtilisateur['typeUtilisateur'];

                header('Location: Dossiers_projet/accueil.php');
                exit();
            }else{
                print('Votre mot de passe est incorrect');
            }
        }else{
            print('Votre pseudo est incorrect...');
        }
    }else{
        $errorMess = "Veuillez completer tous les champs...";
    }
    
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Page login</title>
</head>
<body>
    
    <div class="login_page">
        <div class="form-block">
            <h2>eau plus</h2>
            <span>page d'authentification</span>
            <form action="" method="post" class="login_form">
                <label for="pseudoUtilisateur">PSEUDO</label><br /><br />
                <input id="pseudoUtilisateur" type="text" name="pseudoUtilisateur"><br />
                <label for="motPasseUtilisateur">MOT DE PASSE</label><br /><br />
                <input id="motPasseUtilisateur" type="password" name="motPasseUtilisateur"><br /><br />       
                <input type="submit" name="submit" value="Se connecter">
            </form>
        </div>
        <section class="wave_section">
            <div class="wave wave1"></div>
            <div class="wave wave2"></div>
            <div class="wave wave3"></div>
            <div class="wave wave4"></div>
        </section>
    </div>
</body>
</html>