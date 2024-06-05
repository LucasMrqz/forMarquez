
<?php
session_start();
require_once './co_bdd.php';
if(isset($_POST['boutton-valider'])){ 
    $Email = $_SESSION['mail'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    $query_uti = $lien->prepare("SELECT nomTuteur, prenomTuteur FROM tuteur WHERE emailTuteur=?");
    $query_uti->execute(array($Email));
        
        $query_form = $lien->prepare("SELECT * FROM formation");
        $query_form->execute();

        $query_cours = $lien->prepare("SELECT * FROM cours INNER JOIN typecours ON cours.idTypeCours = typecours.idTypeCours INNER JOIN salle ON salle.numSalle = cours.numSalle");
        $query_cours->execute();

        echo "<nav class='navbar'>";;
            while($rowan = $query_uti->fetch()){
                echo "<p style='margin-top: 1em; color: white;'> Votre profil : " . $rowan['nomTuteur'] . " " . $rowan['prenomTuteur'] . " </p>";
            }
        echo "</nav>";
        echo "<title>Liste des cours</title>";
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />';
        echo '<link href="./style.css" rel="stylesheet"/>';
        while($rowy = $query_form->fetch()){
            //echo "<p style='color: black;'>{$rowy['IdSujet']} {$rowy['LibelSujet']} </p>";
            echo "<h1>{$rowy['nomFormation']}</h1>";
            echo "<h3>{$rowy['descFormation']}</h3>";
        }
        echo "<h2 style='color: black;'> Voici la liste de vos cours :".  "</h2>";
        echo '<a href="./ajout_cours.php" class="button-56" style="color: white; text-decoration: none;">Ajouter un cours</a>';
        echo '<table style="margin-top: 2em;" border 1 eifth =100%>';
        echo "<tr><td>Id du cours</td><td>Nom du type de cours</td><td>Nom du cours</td><td>Date/Heures du cours</td><td>Duree du cours</td><td>Numéro de la salle</td><td>Supprimer le cours</td>\n " ;
            while($rowan = $query_cours->fetch()){
                    echo "<tr>"
                            ."<td> {$rowan['idCours']} </td>
                            <td> {$rowan['libelType']} </td>
                            <td> {$rowan['libelCours']} </td>
                            <td> {$rowan['dateHeureCours']} </td>
                            <td> {$rowan['duree']} </td>
                            <td> {$rowan['numSalle']} </td>
                            <td><a href='./supprimer.php?id=".$rowan['idCours']."' id='btn1'>Supprimer</a></td>
                        </tr>\n";
                }
                echo "</table>";
                echo "<a href='./accueil_prof.php' class='button-56' style='color: white; margin-top: 2em;text-decoration: none;'>Retour à la page d'accueil</a>";
                echo "<footer>"
                ."<h2>© 2024</h2>
            </footer>";
            }

?>