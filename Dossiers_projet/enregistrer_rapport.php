<?php
/*include_once('connexion/connexion.php');
if(isset($_POST['valider'])){
    if(isset($_POST['montant']) AND isset($_POST['paye'])
        AND isset($_POST['demandeSodeci']) AND isset($_POST['polices'])
        AND isset($_POST['codeSecteur']) AND isset($_POST['traverseeBitumeCiment'])
        AND isset($_POST['conduiteDeBranchement']) AND isset($_POST['lineaireBranchement'])
        AND isset($_POST['observations']) AND isset($_POST['poserPar']) 
        AND isset($_POST['dateDeRealisation']) AND isset($_POST['dateDeTraitement']))
    {
        if(!empty($_POST['montant']) AND !empty($_POST['paye'])
            AND !empty($_POST['demandeSodeci']) AND !empty($_POST['polices'])
            AND !empty($_POST['codeSecteur']) AND !empty($_POST['traverseeBitumeCiment	'])
            AND !empty($_POST['conduiteDeBranchement']) AND !empty($_POST['lineaireBranchement'])
            AND !empty($_POST['observations']) AND !empty($_POST['poserPar']) 
            AND !empty($_POST['dateDeRealisation']) AND !empty($_POST['dateDeTraitement']))
            
        {
            $montant=htmlspecialchars($_POST['montant']);
            $paye=htmlspecialchars($_POST['paye']);
            $demandeSodeci=htmlspecialchars($_POST['demandeSodeci']);
            $polices=htmlspecialchars($_POST['polices']);
            $codeSecteur=htmlspecialchars($_POST['codeSecteur']);
            $traverseeBitumeCiment=htmlspecialchars($_POST['traverseeBitumeCiment']);
            $conduiteDeBranchement=htmlspecialchars($_POST['conduiteDeBranchement']);
            $lineaireBranchement=htmlspecialchars($_POST['lineaireBranchement']);
            $observations=htmlspecialchars($_POST['observations']);
            $poserPar=htmlspecialchars($_POST['poserPar']);
            $dateDeRealisation=htmlspecialchars($_POST['dateDeRealisation']);
            $dateDeTraitement=htmlspecialchars($_POST['dateDeTraitement']);
            
            // $inserer = $connexion->prepare('INSERT INTO dossier (montant, paye, demandeSodeci, polices, codeSecteur, traverseeBitumeCiment	, conduiteDeBranchement	,lineaireBranchement	, dateDeRealisation	)
            //                                 VALUES(:montant, :paye, :demandeSodeci, :polices, :codeSecteur, :traverseeBitumeCiment	, :conduiteDeBranchement	, :lineaireBranchement	, :dateDeRealisation	)');
            $inserer = $connexion->prepare('INSERT INTO dossier (montant, paye, demandeSodeci, polices, codeSecteur, traverseeBitumeCiment, conduiteDeBranchement, lineaireBranchement, observations, poserPar, dateDeRealisation, dateDeTraitement)
                                            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
             $inserer->execute(array($montant, $paye, $demandeSodeci, $polices, $codeSecteur, $traverseeBitumeCiment, $conduiteDeBranchement, $lineaireBranchement, $observations, $poserPar, $dateDeRealisation, $dateDeTraitement));
      

        }else{
            echo "Veuillez entrer tous les champs !";
        }
    }
}*/

?>