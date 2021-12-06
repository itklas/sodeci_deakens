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
    <link rel="stylesheet" href="../css/style.css">
    <title>Accueil</title>
</head>
<body>
    <div class="accueil">
        <?php
            include_once('../Fichiers_includes/side-bar.php');    
        ?>
        <?php
            include_once('../Fichiers_includes/haut-bar.php');    
        ?>
    </div>
    
</body>
</html>