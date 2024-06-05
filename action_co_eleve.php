<?php
require_once 'co_bdd.php';
session_start();

if(isset($_POST['boutton-valider'])){
  if(isset($_POST['mail']) && isset($_POST['mdp'])){
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdpHash = hash('sha256',$mdp.$sel);
    // echo $mdpHash;
    //requête sql qui permet de prendre et les mails de la table utilisateurs pour l'authentification
    $utilisateurExistant = $lien->prepare('SELECT nomEleve, prenomEleve, mailEleve, mdpEleve FROM eleve WHERE mailEleve = ? AND mdpEleve = ?');
    $utilisateurExistant->execute(array($mail, $mdpHash));
           
    //permet de vérifier que le nombre d'utilisateur récupéré est bien supérieur a 0, si c'est le cas on identifie l'utilisateur
    if($utilisateurExistant->rowCount() > 0 ){
       
       $infosUtilisateur = $utilisateurExistant->fetch();
       
       if($mdpHash == $infosUtilisateur['mdpEleve']){
        $_SESSION['mdp'] = $infosUtilisateur['mdpEleve'];
        $_SESSION['nom'] = $infosUtilisateur['nomEleve'];
        $_SESSION['prenom'] = $infosUtilisateur['prenomEleve'];
        $_SESSION['mail'] = $infosUtilisateur['mailEleve'];
        
        //si la connexion est réussie, rediriger vers la page d'accueil "accueil.php"
        header('Location: ./accueil_eleve.php');
        
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