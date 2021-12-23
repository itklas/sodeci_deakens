<?php
session_start();
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
// require('recherche.php');
// echo'<pre>';
// print_r($_SESSION);
// echo'</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/deakens_logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="../Fichiers_includes/sidebar.css">
    <title>Accueil</title>
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
            <div>
                <form action="" name='recherche' method="GET">
                    <input type="search" name="search">
                    <button type="submit">Rechercher</button>
                
                
                    <!-- <select name="par">
                        <option value=""> Choisir un critère</option>
                        <option value="year"> Par Année</option> 
                        <option value="agent"> Agent d'operation</option>
                    </select> -->
                </form>
            </div>

            <?php
                // foreach ($dossiers as $key => $dossier) {
                    // echo '<pre>';
                    // echo $key.'°)';
                    // print_r($dossier);
                    // echo '</pre>';
                // }
            ?>
        </div>

    </div>
    
</body>
</html>