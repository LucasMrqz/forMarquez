<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire de connexion</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body class ='body-test'>
        <section class="about">
            <div class="container">
                <h1>Page de connexion élève</h1>
                <form class="contact-form" action="./action_co_eleve.php" method="POST"> <!-- Dans ce formulaire, on demande à l'utilisateur son login et son mot de passe--->
                    <input type="email" id="mail" name="mail" placeholder="Adresse Mail (ex : exemple@exemple.fr)" required style="text-align: center;"/>
                    <input type="password" name="mdp" minlength="8" placeholder="Mot de passe" required style="text-align: center;">
                    <input type="submit" value="Se connecter" name="boutton-valider">
                    <p>
                        Pas de compte? Créez en un <a href="./inscription_eleve.php"> ici <a>
                    </p>
                </form>
            </div>
        </section>
    </body>
</html>