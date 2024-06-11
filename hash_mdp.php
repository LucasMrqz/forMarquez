<?php
require_once 'co_bdd.php';

    $utilisateurExistant = $lien->prepare('SELECT mdpEleve FROM eleve ');
    $utilisateurExistant->execute();
    $associer = $utilisateurExistant->fetch(PDO::FETCH_ASSOC);

    $mdp = $associer['mdpEleve'];
    $mdpHash = hash('sha256',$mdp.$sel);

    if($mpd != $mdpHash){
        $insertMdp = $lien->prepare('UPDATE eleve SET mdpEleve = ?');
        $insertMdp->execute(array($mdpHash));
        $inserer = $insertMdp->fetch(PDO::FETCH_ASSOC);
    }
?>