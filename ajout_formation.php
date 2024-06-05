<?php
    require_once './co_bdd.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Création de formation</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="./style.css" rel="stylesheet"/>
    </head>
    <body>
        <section class="about">
            <div class="container">
                    <h1> Page de création de formation</h1>
                    <form class="contact-form" method="POST" action="./new_formation.php">
                            <input type="text" name="nomForm" placeholder="Nom de la formation" required style="text-align: center;"/>
                            <textarea name="descForm" id="descForm" placeholder="Description de la formation de la formation" required style="text-align: center;"></textarea>
                            <input type="number" name="cout" id="cout" placeholder="Coût de la formation" required style="text-align: center;">
                            <input type="number" name="nbEleveMax" id="nbEleveMax" placeholder="Nombre d'élève maximum pour la formation" required style="text-align: center;">
                            <div class="center-form">
                                <label for="niveauEtude">Choississez le niveau d'étude requis :</label>
                                <select id="niveauEtude" name="niveauEtude" required>
                                    <option value="" style="text-align: center;">--- Choisir un niveau ---</option>
                                    <?php
                                        $query = $lien->prepare("SELECT * FROM niveauetud");
                                        $query->execute();
                                            
                                        while($row = $query->fetch()) {
                                            echo "<option value='{$row["idNiveau"]}' style='text-align: center;'> {$row["libelNiveau"]} </option>";
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
