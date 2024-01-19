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


$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motDePasse = ""; // Mot de passe MySQL
$baseDeDonnees = "formation"; // Nom de la base de données

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les images de la table "Livres"
    $requete = "SELECT image_livre FROM Livres WHERE image_livre IS NOT NULL";
    $resultat = $connexion->query($requete);

   $chemin_upload = '/formation/photosLivres/'; 
   //$chemin_upload = 'photosLivres/'; // Remplacez par le chemin correct
   error_reporting(E_ALL);
    ini_set('display_errors', 1);

while ($row = $resultat->fetch()) {
    $image = $row['image_livre'];
    echo "<img src='$chemin_upload$image' alt='Image du livre' style='max-width: 300px;'><br>";
}

} catch (PDOException $e) {
    echo "Erreur lors de la récupération des images : " . $e->getMessage();
}

//$image_test = 'Java_Servlet.jpg'; // Remplacez par un nom d'image spécifique

//echo "<img src='$chemin_upload$image_test' alt='Image de test' style='max-width: 300px;'><br>";
// Fermeture de la connexion à la base de données
$connexion = null;


?>

</body>
</html>
