<?php
include_once('../connexion/connexion.php');
if(isset($_POST['valider'])){
    if(isset($_POST['nomProjet']) AND !empty($_POST['nomProjet']))
    {
        $nomProjet = htmlspecialchars($_POST['nomProjet']);
         // $inserer = $connexion->prepare('INSERT INTO dossier (nomClientProjet, nomClient, prenomClient, adresseGeographieClient, quartierClient, typePieceClient, numeroPieceClient,contactClient, dateReception)
            //                                 VALUES(:nomClientProjet, :nomClient, :prenomClient, :adresseGeographieClient, :quartierClient, :typePieceClient, :numeroPieceClient, :contactClient, :dateReception)');
            $inserer = $connexion->prepare('INSERT INTO projet(nomProjet)VALUES(?)');
            $inserer->execute(array($nomProjet));
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
    <title>Création projet</title>
</head>
<body>
<?php
    include_once('../Fichiers_includes/side-bar.php');    
?>
<?php
    include_once('../Fichiers_includes/haut-bar.php');    
?>
    <h1>Création projet</h1>
    <form action="" method="post">
        <label for="nomProjet">Nom projet</label>
        <input id="nomProjet" type="text" name="nomProjet">
        <button type="submit" name="valider">Créer</button>
    </form>
</body>
</html>