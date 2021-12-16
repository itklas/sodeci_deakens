<?php
include_once('../connexion/connexion.php');
if(isset($_POST['valider'])){
    if(isset($_POST['numeroAgence']) AND !empty($_POST['numeroAgence']))
    {
        $numeroAgence = htmlspecialchars($_POST['numeroAgence']);
        $nomAgence = htmlspecialchars($_POST['nomAgence']);
        $situationGeoAgence = htmlspecialchars($_POST['situationGeoAgence']);
        $contactAgence = htmlspecialchars($_POST['contactAgence']);
        $emailAgencet = htmlspecialchars($_POST['emailAgence']);            

        // $inserer = $connexion->prepare('INSERT INTO dossier (nomClientProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient,contactClient, dateReception)
        //                                 VALUES(:nomClientProjet, :nomClient, :prenomClient, :adresseGeographieClient, :quartierClient, :typePieceClient, :numeroPieceClient, :contactClient, :dateReception)');
        $inserer = $connexion->prepare('INSERT INTO agence(numeroAgence, nomAgence, situationGeoAgence, contactAgence, emailAgence)VALUES(?, ?, ?, ?, ?)');
        $inserer->execute(array($numeroAgence, $nomAgence, $situationGeoAgence, $contactAgence, $emailAgence));
    //    $inserer->execute(array(
    //        'nomClientProjet' => $nomClientProjet,
    //    ));

       
    }else{
        echo "Veuillez entrer tous les champs !";
    }
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../Fichiers_includes/sidebar.css">
    <title>Document</title>
</head>
<body>
<?php
    include_once('../Fichiers_includes/side-bar.php');    
?>
<?php
    include_once('../Fichiers_includes/haut-bar.php');    
?>
    <h1>Création agence</h1>
    <form action="" method="post">
        <label for="numeroAgence">Numéro agence</label>
        <input id="numeroAgence" type="text" name="numeroAgence"><br><br>
        <label for="nomAgence">Nom agence</label>
        <input id="nomAgence" type="text" name="nomAgence"><br><br>
        <label for="situationGeoAgence">Situation géo agence</label>
        <input id="situationGeoAgence" type="text" name="situationGeoAgence"><br><br>
        <label for="contactAgence">Contact agence</label>
        <input id="contactAgence" type="text" name="contactAgence"><br><br>
        <label for="emailAgence">Email agence</label>
        <input id="emailAgence" type="text" name="emailAgence"><br><br>
        <button type="submit" name="valider">Enregistrer</button>
    </form>
</body>
</html>