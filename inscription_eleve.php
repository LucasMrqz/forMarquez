<?php
    require_once './co_bdd.php';  
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire d'inscription</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body class ='body-test'>
        <section class="about">
            <div class="container">
                <h1> Inscription</h1>
                <form class="contact-form" action="./action_inscri_eleve.php" method="POST"> <!-- Dans ce formulaire, on demande à l'utilisateur ses informations personnelles--->
                    <p>Entrez vos informations personnelles</p>
                    <input type="text" name="nom" placeholder="Nom" required style="text-align: center;">
                    <input type="text" name="prenom" placeholder="Prenom" required style="text-align: center;">
                    <input type="email" id="mail" name="mail" placeholder="Adresse Mail (ex : exemple@exemple.fr)" required style="text-align: center;">
                    <div class="center-form">
                            <label for="competence">Choississez le niveau d'étude requis :</label>
                                <select id="competence" name="competence" required>
                                    <option value="" style="text-align: center;">--- Choisir un niveau ---</option>
                                    <!-- affiche les niveaux ajoutée par l'utilisateur à la suites des niveaux déjà existante -->
                                    <?php
                                        $query = $lien->prepare("SELECT * FROM niveauEtud");
                                        $query->execute();
                                        
                                        while($row = $query->fetch()) {
                                            echo "<option value='{$row["idNiveau"]}' style='text-align: center;'> {$row["libelNiveau"]} </option>";
                                        }
                                    ?>
                                </select>
                        </div>
                    <input type="password" name="mdp" minlength="8" placeholder="Mot de passe" required style="text-align: center;">
                    <input type="submit" value="S'inscrire" name="boutton-valider">
                    <p>
                        Avez-vous déjà un compte? <a href="./page_co_eleve.php"> Connectez vous </a>
                    </p>
                </form>
            </div>
        </section> 
    </body>
</html>