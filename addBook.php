<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Informations de connexion à la base de données
    //$serveur = "localhost"; // Adresse du serveur MySQL
    //$utilisateur = "root"; // Nom d'utilisateur MySQL
    //$motDePasse = ""; // Mot de passe MySQL
    //$baseDeDonnees = "formation"; // Nom de la base de données


    $serveur = "localhost";
$utilisateur = "yaoko2276746";
$motDePasse = "Nocaise2015@1!";
$baseDeDonnees = "yaoko2276746";

    try {
        // Connexion à la base de données avec PDO
        $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupération des données du formulaire
        $nom_livre = $_POST['nom_livre'];
        $categorie_livre = $_POST['categorie_livre'];
        $nb_Pages = $_POST['nb_Pages'];
        $auteur = $_POST['auteur'];
        $langue_livre = $_POST['langue_livre'];

        // Vérification de l'existence du champ 'image_livre' dans $_FILES
        if (isset($_FILES['image_livre'])) {
            // Récupération des données de l'image
            $image_livre = $_FILES['image_livre']['name'];
            $chemin_temporaire = $_FILES['image_livre']['tmp_name'];
            //$dossier_upload = 'chemin/vers/dossier/upload/'; // Remplacez par le chemin de votre dossier d'upload
            $dossier_upload = 'C:/xampp/htdocs/formation/photosLivres/';
            // Déplacement de l'image vers le dossier d'upload
            move_uploaded_file($chemin_temporaire, $dossier_upload . $image_livre);
        } else {
            $image_livre = null; // Ajustez si nécessaire
        }

        // Requête d'insertion dans la table "Livres"
        $requeteInsertion = "
            INSERT INTO Livres (nom_livre, categorie_livre, nb_Pages, auteur, langue_livre, image_livre)
            VALUES (:nom_livre, :categorie_livre, :nb_Pages, :auteur, :langue_livre, :image_livre)
        ";

        // Préparation de la requête
        $stmt = $connexion->prepare($requeteInsertion);

        // Liaison des paramètres
        $stmt->bindParam(':nom_livre', $nom_livre);
        $stmt->bindParam(':categorie_livre', $categorie_livre);
        $stmt->bindParam(':nb_Pages', $nb_Pages);
        $stmt->bindParam(':auteur', $auteur);
        $stmt->bindParam(':langue_livre', $langue_livre);
        $stmt->bindParam(':image_livre', $image_livre);

        // Exécution de la requête
        $stmt->execute();

        echo "Livre ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du livre : " . $e->getMessage();
    }

    // Fermeture de la connexion à la base de données
    $connexion = null;
} else {
    echo "Le formulaire n'a pas été soumis correctement.";
}

?>
