<?php
$nomUtilisateur = $_SESSION['nomUtilisateur'];
$prenomUser = $_SESSION['prenomUser'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <div class="content">       
        <div class="content-right">
            <h2>Enregistrement Dossier</h2>
            <div>
                <p><?php echo 'Mr. '.$nomUtilisateur.' '.$prenomUser?></p>
                <p>En ligne</p>
                
            </div>
        </div>
    </div>
</body>
</html>