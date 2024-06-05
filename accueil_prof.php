<?php
    require_once './co_bdd.php';  
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page accueil</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="./style.css" rel="stylesheet"/>
    </head>
    <body>
        <!-- Barre de navigation -->
        <nav class="navbar">
        </div>
            <ul class="navbar-menu">
            <a href="./ajout_formation.php" class="button-56" style="color: white;">Ajouter une formation</a>
                <form>
                    <div>
                        <input
                            type="search"
                            id="maRecherche"
                            name="q"
                            placeholder="Recherche sur le site…"
                            required />
                        <button>Rechercher</button>
                        <span class="validity"></span>
                    </div>
                </form>
                <div class="profil">
                    <?php 
                        $Email = $_SESSION['mail'];
                        $nom = $_SESSION['nom'];
                        $prenom = $_SESSION['prenom'];
                        $query_uti = $lien->prepare("SELECT nomTuteur, prenomTuteur FROM tuteur WHERE emailTuteur=?");
                        $query_uti->execute(array($Email));
                        while($rowan = $query_uti->fetch()){
                            echo "<p style='margin-top: 1em; color: white;'> Votre profil : " . $rowan['nomTuteur'] . " " . $rowan['prenomTuteur'] . " </p>";
                        }
                    ?>
                </div>
                <a href="./deconnexion.php">Se déconnecter</a>
            </ul>
        </nav>
        <!-- affiche les formations ajoutée par l'utilisateur à la suites des formations déjà existante -->
        <?php
            $Email = $_SESSION['mail'];
            $nom = $_SESSION['nom'];

            $query = $lien->prepare("SELECT * FROM formation INNER JOIN niveauetud ON formation.idNiveau = niveauetud.idNiveau INNER JOIN tuteur ON tuteur.idTuteur = formation.idTuteur");
            $query->execute();

            echo "<h2 style='color: black;'> Voici la liste de toutes les formations disponible : ".  "</h2>";
            while($rowan = $query->fetch()) {
                        echo '<div class="cours">'
                            ."<form class='formation' method='POST' action='./voir_cours_prof.php'>
                                <p name='idForm'style='margin-right: 1em;'> {$rowan['idFormation']} </p>
                                <input type='text' value='{$rowan['idFormation']}' name='idForm' hidden>
                                <p style='margin-left: 1em;'> {$rowan['nomFormation']} </p>
                                <p style='margin-left: 1em;'> Profresseur principal : {$rowan['nomTuteur']} </p>
                                <p style='margin-left: 1em;'> Niveau d'étude requi : {$rowan['libelNiveau']} </p>
                                <p style='margin-left: 1em;'> Coût total de la formation : {$rowan['cout']}€ </p>
                                <p style='margin-left: 1em;'> Nombre d'élève maximum par cours : {$rowan['nbEleveMax']} </p>
                                <input type='submit' value='Voir les cours' name='boutton-valider'>
                            </from>\n
                        </div>";
                //}
            }
        ?>
    </body>
    <footer>
        <h2>© 2024</h2>
    </footer>
</html>