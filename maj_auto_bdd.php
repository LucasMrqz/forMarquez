<?php
// Inclure votre connexion à la base de données
$backup_file = "backup_" . date("Y-m-d_H-i-s") . ".sql";

// Création de la connexion
try {
    $lien = new PDO('mysql:host=localhost;dbname=formarquez', 'root', '');
    $lien->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Échec de la connexion: " . $e->getMessage());
}

// Ouverture du fichier de sauvegarde
$handle = fopen($backup_file, 'w');
if (!$handle) {
    die("Impossible d'ouvrir le fichier de sauvegarde pour écrire.");
}

// Liste des tables dans l'ordre souhaité
$tables = array("composer", "contenir", "cours", "eleve", "formation", "niveauetud", "paiement", "salle", "s_inscrire", "tuteur", "typecours");

foreach ($tables as $table_name) {
    // Récupération de la structure de la table
    $sql_create = "SHOW CREATE TABLE $table_name";
    $stmt_create = $lien->query($sql_create);
    if ($stmt_create) {
        $row_create = $stmt_create->fetch(PDO::FETCH_ASSOC);
        fwrite($handle, "-- Structure de la table $table_name\n");
        fwrite($handle, $row_create['Create Table'] . ";\n\n");
    }
    
    // Récupération des données de la table
    $sql_select = "SELECT * FROM $table_name";
    $stmt_select = $lien->query($sql_select);
    if ($stmt_select) {
        fwrite($handle, "-- Données de la table $table_name\n");
        while ($row_select = $stmt_select->fetch(PDO::FETCH_ASSOC)) {
            $columns = array_keys($row_select);
            $values = array_values($row_select);
            
            // Échappement des valeurs
            foreach ($values as $key => $value) {
                $values[$key] = addslashes($value);
            }
            
            $columns_list = implode("`, `", $columns);
            $values_list = implode("', '", $values);
            
            $sql_insert = "INSERT INTO `$table_name` (`$columns_list`) VALUES ('$values_list');\n";
            fwrite($handle, $sql_insert);
        }
        fwrite($handle, "\n");
    }
}

// Fermeture du fichier de sauvegarde
fclose($handle);

// Fermeture de la connexion
$lien = null;

echo "Sauvegarde de la base de données effectuée avec succès dans le fichier $backup_file.";
?>