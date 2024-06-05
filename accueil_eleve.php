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
                        $query_uti = $lien->prepare("SELECT nomEleve, prenomEleve, fondPerso FROM eleve WHERE mailEleve=?");
                        $query_uti->execute(array($Email));
                        while($rowan = $query_uti->fetch()){
                            echo "<p style='margin-top: 1em; color: white;'> Votre profil : " . $rowan['nomEleve'] . " " . $rowan['prenomEleve'] . " </p>";
                            echo "<p style='margin-top: 1em; color: white;'> Fond personnel : ".$rowan['fondPerso']."</p>";
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
            while($row = $query->fetch()) {
                echo '<div class="cours">'
                    ."<form class='formation' method='POST' action='./voir_cours.php'>
                        <p name='idForm'style='margin-right: 1em;'> {$row['idFormation']} </p>
                        <input type='text' value='{$row['idFormation']}' name='idForm' hidden>
                        <p style='margin-left: 1em;'> {$row['nomFormation']} </p>
                        <p style='margin-left: 1em;'> Profresseur principal : {$row['nomTuteur']} </p>
                        <p style='margin-left: 1em;'> Niveau d'étude requi : {$row['libelNiveau']} </p>
                        <p style='margin-left: 1em;'> Coût total de la formation : {$row['cout']} </p>
                        <p style='margin-left: 1em;'> Nombre d'élève maximum par cours : {$row['nbEleveMax']} </p>
                        <input type='submit' value='Voir les cours' name='boutton-valider'>
                    </from>\n
                </div>";
            }
        ?>
        <footer>
            <h2>© 2024</h2>
        </footer>
    </body>
</html>