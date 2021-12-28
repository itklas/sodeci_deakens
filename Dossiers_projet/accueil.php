<?php
session_start();
include_once ('../connexion/connexion.php');

if(!isset($_SESSION['auth'])){
    header('Location: ../index.php');
    exit;
}
if(isset($_POST['valider'])){
    //echo var_dump($_POST['searchValue']).'<br>';
    //echo '<pre>';print_r($_POST);echo '</pre>';exit();
    if(isset($_POST['typeObjet']) AND $_POST['typeObjet'] ==""){
        $msg = 'Veuillez selectionner un type de recherche! <span style="color: red">Merci</span>';
    }elseif(isset($_POST['typeObjet']) AND $_POST['typeObjet'] !==""){
        if(isset($_POST['searchValue']) AND $_POST['searchValue'] ==""){
            $msg = 'Veuillez saisir un terme de recherche! <span style="color: red">Merci</span>';
        }elseif(isset($_POST['searchValue']) AND $_POST['searchValue'] !==""){
            switch ($_POST['typeObjet']) {
                case 'dossiers':
                    //$projets = "";
                    $resultat = $connexion->prepare("SELECT * FROM dossier WHERE nomClient LIKE ? OR prenomClient= ? OR adresseGeographieClient = ? OR typePieceClient= ?");
                    $terme = $_POST['searchValue'];
                    $terme = '%'.$terme.'%';
                    $resultat->execute(array($terme, $terme,$terme, $terme));
                    $dossiers = $resultat->fetchAll();
                    break;
                
                /*case 'rapports':
                    # code...
                    break;
                
                case 'clients':
                    # code...
                    break;
                
                case 'agences':
                    # code...
                    break;
                
                case 'projets':
                    # code...
                    break;
                
                case 'utilisateurs':
                    # code...
                    break;
                 */       
                    
            }
        }
    }
}

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
        <h1>Moteur de recherche</h1>
        <form action="" method="post" class='register_form'>
            
            <div class='input_label_bloc'>
                <input type="text" name="searchValue" value="<?= @$_POST['searchValue']?>"> 
            </div>
            <div class='input_label_bloc'>
                <select for="typePieceClient" name="typeObjet">
                    <option value="" >Choisir une valeur</option>
                    <option value="dossiers" <?= (@$_POST['typeObjet']=='dossiers')?'selected':''?>>Dossiers</option>
                    <option value="rapports" <?= (@$_POST['typeObjet']=='rapports')?'selected':''?> >Rapports</option>
                    <option value="clients" <?= (@$_POST['typeObjet']=='clients')?'selected':''?> >Clients</option>
                    <option value="agences" <?= (@$_POST['typeObjet']=='agences')?'selected':''?> >Agences</option>
                    <option value="projets" <?= (@$_POST['typeObjet']=='projets')?'selected':''?> >Projets</option>
                    <option value="utilisateurs" <?= (@$_POST['typeObjet']=='utilisateurs')?'selected':''?> >Utilisateurs</option>
                </select>
            </div>
            
            
            <div>
                <button type="submit" name="valider">Rechercher</button>
            </div>
            <!-- <input type="submit" name="submit" value="Enregistrer"> -->
        </form>
    <br>
    <br>
    <!-- <table>
        <thead>
            <th></th>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table> -->
    <?php
        
    if(isset($_POST['typeObjet']) AND $_POST['typeObjet'] ==""){
            require '../Fichiers_includes/error.php';
        }elseif(isset($_POST['typeObjet']) AND $_POST['typeObjet'] !==""){
            if(isset($_POST['searchValue']) AND $_POST['searchValue'] ==""){
                require '../Fichiers_includes/error.php';
            }elseif(isset($_POST['searchValue']) AND $_POST['searchValue'] !==""){
                switch ($_POST['typeObjet']) {
                    case 'dossiers':
                        //$projets = "";
                        include '../Fichiers_includes/resultats_dossiers.php';
                        break;
                    
                    case 'rapports':
                        # code...
                        break;
                    
                    case 'clients':
                        # code...
                        break;
                    
                    case 'agences':
                        # code...
                        break;
                    
                    case 'projets':
                        # code...
                        break;
                    
                    case 'utilisateurs':
                        # code...
                        break;
                            
                        
                }
            }
        }
    ?>
    </div>
</div>
</div>
    
</body>
</html>