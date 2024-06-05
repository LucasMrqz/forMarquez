<?php
    require_once './co_bdd.php';
    session_start();

    if(isset($_POST['boutton-valider'])){ 
        if(isset($_POST['nomForm']) && isset($_POST['descForm']) && isset($_POST['cout']) && isset($_POST['nbEleveMax']) && isset($_POST['niveauEtude'])) {  
            // Récupération des données du formulaire
            $nomForm = htmlspecialchars($_POST['nomForm']);
            $descForm = htmlspecialchars($_POST['descForm']);
            $cout = htmlspecialchars($_POST['cout']);
            $nbEleveMax = htmlspecialchars($_POST['nbEleveMax']);
            $etude = $_POST['niveauEtude'];
            $id = $_SESSION['id'];
            $Email = $_SESSION['mail'];
            $nom = $_SESSION['nom'];

            //selectionner le bon professeur
            $selectUti = $lien->prepare("SELECT idTuteur FROM tuteur WHERE emailTuteur = ?");
            $selectUti->execute(array($Email));

            //selectionner le niveau d'étude de l'élève
            $nvEtude = $lien->prepare("SELECT idNiveau FROM niveauetud WHERE idNiveau = ?");
            $nvEtude->execute(array($etude));
            $row = $nvEtude->fetch();

            $creerSujet = $lien->prepare("INSERT INTO formation (nomFormation, descFormation, cout, nbEleveMax, idTuteur, idNiveau) VALUES (?,?,?,?,?,?)");
            $creerSujet->execute(array($nomForm, $descForm, $cout, $nbEleveMax, $id, $row['idNiveau']));

            header('Location: ./accueil_prof.php');
        }
    }
?>