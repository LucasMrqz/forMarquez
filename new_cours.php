<?php
    require_once 'co_bdd.php';
    session_start();

    if(isset($_POST['boutton-valider'])){ 
        if(isset($_POST['NomFormation']) && isset($_POST['duree']) && isset($_POST['idTypeCours']) && isset($_POST['numSalle'])) {  
            $titre = htmlspecialchars($_POST['NomFormation']);
            $duree = $_POST['duree'];
            $id_sujet = $_POST['idTypeCours'];
            $id_salle = $_POST['numSalle'];

            $query_sujet = $lien->prepare("SELECT * FROM typeCours WHERE idTypeCours = ?");
            $query_sujet->execute(array($id_sujet));
            $infosSujet = $query_sujet->fetch();

            $query_salle = $lien->prepare("SELECT * FROM salle WHERE numSalle = ?");
            $query_salle->execute(array($id_salle));
            $infosSalle = $query_salle->fetch();

            $creerCour = $lien->prepare("INSERT INTO cours (libelCours, dateHeureCours, duree, idTypeCours, numSalle) VALUES (?, NOW(), ?, ?, ?)");
            $creerCour->execute(array($titre, $duree, $infosSujet['idTypeCours'], $infosSalle['numSalle']));
            $infosCour = $creerCour->fetch();

            header('Location:./voir_cours.php');
        }
    }
?>