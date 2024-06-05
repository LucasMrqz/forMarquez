<?php
session_start();
    require_once './co_bdd.php';

    if(isset($_POST['boutton-valider'])){ 
        if(isset($_POST['mail']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['competence'])) { // les issests servent à verifier que l'utilisateur à bien rempli un login, un mot de passe et qu'il a bien valider ceci
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = htmlspecialchars($_POST['mdp']);
            $nomUti = htmlspecialchars($_POST['nom']);
            $prenomUti = htmlspecialchars($_POST['prenom']);
            $competence = $_POST['competence'];
            $mdpHash = hash('sha256',$mdp.$sel);

            $query_niveau = $lien->prepare("SELECT idNiveau FROM niveauetud WHERE idNiveau = ?");
            $query_niveau->execute(array($competence));
            $infosNiveau = $query_niveau->fetch();
            
                // Vérifier si l'utilisateur existe déjà sur le site
                $utilisateurExistant = $lien->prepare('SELECT mailEleve, nomEleve, prenomEleve, mdpEleve FROM eleve WHERE mailEleve = ? OR nomEleve = ? OR prenomEleve = ? OR mdpEleve = ?');
                $utilisateurExistant->execute(array($mail, $nomUti, $prenomUti, $mdpHash));
                
                if($utilisateurExistant->rowCount() == 0 ){
                
                    // Insérer l'l'utilisateur dans la bdd
                    $creerUtilisateur = $lien->prepare('INSERT INTO eleve (mailEleve, mdpEleve, nomEleve, prenomEleve, fondPerso, idNiveau) VALUES (?, ?, ?, ?, "3000", ?)');
                    $creerUtilisateur->execute(array($mail, $mdpHash, $nomUti, $prenomUti, $infosNiveau['idNiveau']));
                    
                    // Récupérer les informations de l'utilisateur
                    $obtenirinfoUtilisateur = $lien->prepare('SELECT mailEleve, nomEleve, prenomEleve, mdpEleve FROM eleve WHERE mailEleve = ? OR nomEleve = ? OR prenomEleve = ? OR mdpEleve = ?');
                    $obtenirinfoUtilisateur->execute(array($mail, $nomUti, $prenomUti, $mdpHash));
                    
                    // Récupère les informations de l'utilisateur depuis la base de données
                    $infosUtilisateur = $obtenirinfoUtilisateur->fetch();
        
                    // Authentifier l'utilisateur sur le site et récupérer ses données dans des sessions
                    $_SESSION['mail'] = $infosUtilisateur['mailEleve'];
                    $_SESSION['mdp'] = $infosUtilisateur['mdpEleve'];
                    $_SESSION['nom'] = $infosUtilisateur['nomEleve'];
                    $_SESSION['prenom'] = $infosUtilisateur['prenomEleve'];

                    // Redirige l'utilisateur vers la page d'accueil
                    header('Location: ./page_co_eleve.php');
                    
                } else {
                    $errorMsg = "L'utilisateur existe déjà avec cet e-mail";
                }   
            }
        } 
?>