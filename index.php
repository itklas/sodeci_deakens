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
                if ($dataUtilisateur['lockUser'] == 0) {
                    header('Location: index.php');
                    exit();
                } else {
                    $_SESSION['auth'] = true;
                    $_SESSION['idUtilisateur'] = $dataUtilisateur['idUtilisateur'];
                    $_SESSION['nomUtilisateur'] = $dataUtilisateur['nomUtilisateur'];
                    $_SESSION['prenomUser'] = $dataUtilisateur['prenomUser'];
                    $_SESSION['pseudoUtilisateur'] = $dataUtilisateur['pseudoUtilisateur'];
                    $_SESSION['typeUtilisateur'] = $dataUtilisateur['typeUtilisateur'];

                    header('Location: Dossiers_projet/accueil.php');
                    exit();
                }
                
                
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
    <link rel="shortcut icon" href="./images/deakens_logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="index.css">
    <title>Page login</title>
</head>
<body>
    <div class="login_page">
        <div class="login_card">
            <div class="login_ulustration">
                <!-- <img src="./images/sodeci.svg" alt="" class="illustration"> -->
            </div>
            <div class="form-block">
                <img src="./images/deakens_logo.png" alt="" width=120 heigth=140>
                <span>Authentification</span>
                <form action="" method="post" class="login_form">
                    <div class="login_form_group">
                        <label for="pseudoUtilisateur">PSEUDO</label><sup>*</sup> <br />
                        <input id="pseudoUtilisateur" type="text" name="pseudoUtilisateur" autocomplete="off" required>
                    </div>
                    <div class="login_form_group">
                        <label for="motPasseUtilisateur">MOT DE PASSE</label><sup>*</sup><br />
                        <input id="motPasseUtilisateur" type="password" name="motPasseUtilisateur" required>       
                    </div>
                    <input type="submit" name="submit" value="Se connecter">
                </form>
            </div>
        </div>
    </div>
</body>
</html>