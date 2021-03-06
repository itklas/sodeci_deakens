<?php
include_once('../connexion/connexion.php');
$resultat = $connexion->prepare("SELECT utilisateur.idUtilisateur, nomUtilisateur, prenomUser, pseudoUtilisateur, motPasseUtilisateur, typeUtilisateur, lockUser, COUNT(idDossier) AS nb FROM utilisateur LEFT JOIN dossier ON utilisateur.idUtilisateur = dossier.idUtilisateur GROUP BY idUtilisateur, nomUtilisateur, prenomUser, pseudoUtilisateur, motPasseUtilisateur, typeUtilisateur ORDER BY idUtilisateur ASC");
$resultat->execute(array());
$data = $resultat->fetchAll();   
 
// $_SESSION['auth'] = true;
// $_SESSION['idUtilisateur'] = $data['idUtilisateur'];
// $_SESSION['nomUtilisateur'] = $data['nomUtilisateur'];
// $_SESSION['prenomUser'] = $data['prenomUser'];
// $_SESSION['pseudoUtilisateur'] = $data['pseudoUtilisateur'];
// $_SESSION['typeUtilisateur'] = $data['typeUtilisateur'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2 class='table_title'>Les différents utilisateurs</h2>
<table class="register_table">
        <thead>
            <tr class="trtb">
                <th>ID</th>
                <th>Nom et Prenoms</th>                
                <th>Pseudo</th>
                <th>Mot de passe</th>
                <th>Contact</th>
                <th>Type utilisateur</th>
                <th>Nombre de dossiers</th>
                <th>Status</th>
                <th>Actions</th>
                
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $donnee):?>
            <?php if($donnee['idUtilisateur'] !== $_SESSION['idUtilisateur']):?>
			<tr>
                <td><?php echo $donnee['idUtilisateur']?></td>
                <td><?php echo $donnee['nomUtilisateur'].' '.$donnee['prenomUser']?></td>
                <td><?php echo $donnee['pseudoUtilisateur']?></td>
                <td><?php echo $donnee['motPasseUtilisateur']?></td>
                <td><?php //echo $donnee['contactUtilisateur']?></td>
                <td>
                    <?php if($donnee['typeUtilisateur']==1){
                        echo 'Admin';
                    }elseif($donnee['typeUtilisateur']==2){
                        echo 'Invité';
                    }elseif($donnee['typeUtilisateur']==3){
                        echo 'Responsable';
                    }
                    
                    ?>
                </td>    
				<td><?php echo $donnee['nb']?></td>
                <td style='text-align:left;'>
                    
                    <a title='bloquer utilisateur' href='bloquerUtilisateur.php?id=<?=$donnee['idUtilisateur']?>'> <?=($donnee['lockUser']==0)?'Debloquer':'Bloquer';?> </a>
                </td>
                <td style='text-align:left;'>
                    <a title='modifier utilisateur' href="modifierUtilisateur.php?id=<?=$donnee['idUtilisateur']?>">
                    <i class="fas fa-undo-alt"> </i>
                    </a>
                    <?=($donnee['nb']>0)?'':'<a href="supprimerUtilisateur.php?id='.$donnee['idUtilisateur'].'"><i class="fas fa-trash"></i></a>';?>

                </td>
            </tr>
			<?php endif;?>
        <?php endforeach;?>
        </tbody>
        <tfoot></tfoot>
    </table>
</body>
</html>