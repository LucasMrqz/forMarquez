<?php
require_once 'co_bdd.php';
session_start();

if(isset($_POST['boutton-valider'])){
  if(isset($_POST['mail']) && isset($_POST['idPaiement']) && isset($_POST['mdp'])){
    $mail = htmlspecialchars($_POST['mail']);
    $payer = $_POST['idPaiement'];
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdpHash = hash('sha256',$mdp.$sel);
    // echo $mdpHash;
    //requête sql qui permet de prendre et les mails de la table utilisateurs pour l'authentification
    $utilisateurExistant = $lien->prepare('SELECT nomEleve, prenomEleve, mailEleve, mdpEleve FROM eleve WHERE mailEleve = ? AND mdpEleve = ?');
    $utilisateurExistant->execute(array($mail, $mdpHash));
    $selection = $utilisateurExistant->fetch(PDO::FETCH_ASSOC);
           
    //permet de vérifier que le nombre d'utilisateur récupéré est bien supérieur a 0, si c'est le cas on identifie l'utilisateur
    if($selection['mailEleve'] == $mail && $selection['mdpEleve'] && $mdpHash){
       
       $selectCout = $lien->prepare('SELECT fondPerso, cout, moyenPaiement FROM s_inscrire INNER JOIN formation ON formation.idFormation = s_inscrire.idFormation INNER JOIN paiement ON paiement.idPaiement = s_inscrire.idPaiement INNER JOIN eleve ON eleve.idEleve = s_inscrire.idEleve WHERE moyenPaiement = ?');
       $selectCout->execute(array($payer));
       $check = $selectCout->fetch(PDO::FETCH_ASSOC);
       
        $newFond = $selectCout['cout'] - $selectCout['fondPerso'];

        $updateFond = $lien->prepare('UPDATE eleve SET fondPerso = ? WHERE mailEleve = ?');
        $updateFond->execute(array($newFond, $mail))

        exit;
        
       } else {
        $errorMsg = "Votre mot de passe est incorrect";
       }
       
    } else {
        $errorMsg = "Votre pseudo est incorrect";
    }
   
  } else {
        $errorMsg = "Veuillez compléter tous les champs";
    }
}
?>