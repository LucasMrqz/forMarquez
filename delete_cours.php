        
    <?php 
    require_once 'co_bdd.php' ;

        if (isset($_GET['id'])&& (isset($_POST['validation'])) ){
                $id =$_GET['id'];
                //Requete sql
                $query = $lien->prepare("DELETE FROM cours WHERE idCours=?"); //on supprime le rdv donné
                $query->execute(array($id));
                header("Location:./voir_cours_prof.php") ; // retour vers la page de la secrétaire
        }

        if (isset($_POST['refus'])){// si la secrétaire ne veut finalement pas supprimer le rdv cela nous ramène vers la page de la sécrétaire
            header("Location:./voir_cours_prof.php") ;
        }

    ?>