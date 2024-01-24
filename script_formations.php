<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "formation";

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Script SQL pour créer la table
    $requete = "CREATE TABLE IF NOT EXISTS formations (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    libelle_formation VARCHAR(255) NOT NULL,
                    matiere VARCHAR(255) NOT NULL,
                    methode VARCHAR(255) NOT NULL,
                    image VARCHAR(255) NOT NULL,
                    estLance BOOLEAN NOT NULL,
                    nbre_Heures INT NOT NULL
                )";

    // Exécution de la requête
    $connexion->exec($requete);

    echo "La table 'formations' a été créée avec succès.";

} catch (PDOException $e) {
    echo "Erreur lors de la création de la table : " . $e->getMessage();
}

$connexion = null;
?>
