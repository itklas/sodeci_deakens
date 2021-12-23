<?php
include_once('../connexion/connexion.php');
$query = '';
if (isset($_GET['par'])) {
    $par = $_GET['par'];
} else {
    $par = '';
}

switch ($par) {
    case 'agent':
        $getDossier = $connexion->query("SELECT * FROM dossier WHERE poserPar = ? ORDER BY idDossier DESC");
        $getDossier->execute(array($_GET['search']));
        break;
    //case 'year':
    //    $query = '';
    //    break;
    default:
        $query = '';
        $getDossier = $connexion->query("SELECT * FROM dossier ORDER BY idDossier DESC");
        $getDossier->execute();
        break;
}
//echo $query;exit();

$dossiers = $getDossier->fetchAll();

/*
$getDossier->execute(array($idUtilisateur));
if(isset($_GET['search']) AND !empty($_GET['search'])){
    $searchDossier = $_GET['search'];
    $getAllDossier = $connexion->query('SELECT * FROM dossier');
}
*/


?>