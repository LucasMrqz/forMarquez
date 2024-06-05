<?php
    require_once './co_bdd.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Création de cours</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="./style.css" rel="stylesheet"/>
    </head>
    <body>
        <section class="about">
            <div class="container">
                <h1> Page de création de cours</h1>
                <form class="contact-form" method="POST" action="./new_cours.php">
                        <?php
                            $query_sujet = $lien->prepare("SELECT * FROM typeCours");
                            $query_sujet->execute();
                            
                            echo "<label for='idTypeCours'>Choississez le type de cours souhaiter (si votre sujet voulu n'existe pas allez dans l'accueil pour en créer un) :</label>";
                            echo '<select id="idTypeCours" name="idTypeCours" required>';
                            echo '<option value="" style="text-align: center;">--- Choisir le type de cours ---</option>';
                            while($rowan = $query_sujet->fetch()) {
                                echo "<option value='{$rowan["idTypeCours"]}' style='text-align: center;'> {$rowan["libelType"]} </option>";
                            }
                        ?>
                        <input type="text" name="NomFormation" placeholder="Titre" required style="text-align: center;"/>
                        <label for="duree">Durée du cours</label>
                        <input type="time" id="duree" name="duree" min="01:00" max="04:00" required style="text-align: center;"/>
                        <div class="center-form">
                            <label for="numSalle">Choisissez la salle requise :</label>
                                <select id="numSalle" name="numSalle" required>
                                    <option value="" style="text-align: center;">--- Choisir une salle ---</option>
                                    <!-- affiche les niveaux ajoutée par l'utilisateur à la suites des niveaux déjà existante -->
                                    <?php
                                        $query = $lien->prepare("SELECT * FROM salle");
                                        $query->execute();
                                        
                                        while($row = $query->fetch()) {
                                            echo "<option value='{$row["numSalle"]}' style='text-align: center;'> {$row["numSalle"]} </option>";
                                        }
                                    ?>
                                </select>
                        </div>
                        <input type="submit" value="Valider" name="boutton-valider">
                </form>
            </div>
        </section>
    </body>
</html>
