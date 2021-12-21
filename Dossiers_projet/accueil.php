<?php
session_start();
if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
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
        </div>
    </div>
</body>
</html>