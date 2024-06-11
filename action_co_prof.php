<?php
require_once 'co_bdd.php';
require_once './hash_mdp.php';
session_start();

if(isset($_POST['boutton-valider'])){
    
  if(isset($_POST['mail']) && isset($_POST['mdp'])){
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $mdpHash = hash('sha256',$mdp.$sel);
    // echo $mdpHash;
    //requête sql qui permet de prendre et les mails de la table utilisateurs pour l'authentification
    $utilisateurExistant = $lien->prepare('SELECT * FROM tuteur WHERE emailTuteur = ? AND mdpTuteur = ?');
    $utilisateurExistant->execute(array($mail, $mdpHash));

    //permet de vérifier que le nombre d'utilisateur récupéré est bien supérieur a 0, si c'est le cas on identifie l'utilisateur
    if($utilisateurExistant->rowCount() > 0 ){

       $infosUtilisateur = $utilisateurExistant->fetch();
       
       if($mdpHash == $infosUtilisateur['mdpTuteur']){
        $_SESSION['id'] = $infosUtilisateur['idTuteur'];
        $_SESSION['mdp'] = $infosUtilisateur['mdpTuteur'];
        $_SESSION['nom'] = $infosUtilisateur['nomTuteur'];
        $_SESSION['prenom'] = $infosUtilisateur['prenomTuteur'];
        $_SESSION['mail'] = $infosUtilisateur['emailTuteur'];
        
        //si la connexion est réussie, rediriger vers la page d'accueil "accueil.php"
        header('Location: ./accueil_prof.php');
        
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