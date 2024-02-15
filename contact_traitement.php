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

// Vérifie si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère les données du formulaire
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $sujet = htmlspecialchars($_POST["sujet"]);
    $message = htmlspecialchars($_POST["message"]);

    // Ajoutez la date actuelle
    $date = date("Y-m-d H:i:s");

    // Validation pour le champ nom
    if (!preg_match("/^[a-zA-Z]+$/", $nom)) {
        // Gérer l'erreur pour un nom invalide
        die("Erreur : Le nom n'est pas valide.");
    }

    // Validation pour le champ prenom
    if (!preg_match("/^[a-zA-Z]+$/", $prenom)) {
        // Gérer l'erreur pour un prénom invalide
        die("Erreur : Le prénom n'est pas valide.");
    }

    // Validation d'email (exemple basique)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Gérer l'erreur pour une adresse e-mail invalide
        die("Erreur : L'adresse e-mail n'est pas valide.");
    }

    // Validation pour le champ prenom
    if (!preg_match("/^[a-zA-Z]+$/", $sujet)) {
        // Gérer l'erreur pour un sujet invalide
        die("Erreur : Le sujet n'est pas valide.");
    }

    // Utilisation de preg_match pour valider le champ "message"
if (!preg_match("/^[a-zA-Z0-9\n -]+$/", $_POST["message"])) {
    // Gérer l'erreur pour un champ "message" invalide
    die("Erreur : Le champ message n'est pas valide.");
}

// Utilisation de strip_tags pour supprimer les balises HTML du champ "message"
$message = strip_tags($_POST["message"]);

    // Paramètres de connexion à la base de données (remplacez les valeurs par les vôtres)
    $serveur = "localhost";
$utilisateur = "yaoko2276746";
$motDePasse = "Nocaise2015@1!";
$baseDeDonnees = "yaoko2276746";

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);

        // Activation du mode exception pour les erreurs PDO
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête d'insertion des données dans la table de la base de données (à personnaliser selon votre structure)
        $requete = "INSERT INTO contact (nom, prenom, email, sujet, message, date_creation) VALUES (?, ?, ?, ?, ?, ?)";

        // Préparation de la requête
        $statement = $connexion->prepare($requete);

        // Vérifie si la préparation de la requête a réussi
        if ($statement === false) {
            die("Échec de la préparation de la requête : " . $connexion->errorInfo()[2]);
        }

        // Liaison des paramètres et exécution de la requête
        $resultat = $statement->execute([$nom, $prenom, $email, $sujet, $message, $date]);

        // Vérifie si l'exécution de la requête a réussi
        if ($resultat === false) {
            die("Échec de l'exécution de la requête : " . $statement->errorInfo()[2]);
        }

        // Fermeture des ressources
        $statement = null;
        $connexion = null;

        // Vous pouvez rediriger l'utilisateur vers une page de confirmation si nécessaire
        header("Location: confirmation.php");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de la connexion à la base de données : " . $e->getMessage());
    }
}
?>


</body>
</html>
