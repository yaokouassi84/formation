<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Livres</title>
</head>
<body>

<h2>Liste des Livres</h2>

<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "formation";

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);

    // Activation du mode exception pour les erreurs PDO
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête SQL pour créer la table
    $requete = "CREATE TABLE IF NOT EXISTS contact (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nom VARCHAR(255) NOT NULL,
                    prenom VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    sujet VARCHAR(255) NOT NULL,
                    message TEXT NOT NULL,
                    date_creation DATETIME NOT NULL
                )";

    // Exécution de la requête
    $connexion->exec($requete);

    echo "La table 'votre_table' a été créée avec succès.";
} catch (PDOException $e) {
    echo "Erreur lors de la création de la table : " . $e->getMessage();
}

// Fermeture de la connexion
$connexion = null;
?>

</body>
</html>
