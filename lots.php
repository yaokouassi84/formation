<?php
//$serveur = "localhost";
//$utilisateur = "root";
//$motDePasse = "";
//$baseDeDonnees = "formation";


$serveur = "localhost";
$utilisateur = "yaoko2276746";
$motDePasse = "Nocaise2015@1!";
$baseDeDonnees = "yaoko2276746";

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Source de données (par exemple, fichier CSV)
    $sourceDeDonnees = 'chemin/vers/votre/fichier.csv';

    // Ouverture du fichier en lecture
    if (($handle = fopen($sourceDeDonnees, "r")) !== FALSE) {
        // Ignorer la première ligne si elle contient des en-têtes
        // fgetcsv($handle, 1000, ",");

        // Boucle pour lire les lignes du fichier
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Récupérer les données de chaque colonne (ajustez en fonction de votre fichier)
            $image_livre = $data[0];
            $nom_livre = $data[1];
            $categorie_livre = $data[2];
            $auteur = $data[3];
            $nb_Pages = $data[4];

            // Requête d'insertion des données dans la base de données
            $requete = "INSERT INTO Livres (image_livre, nom_livre, categorie_livre, auteur, nb_Pages)
                        VALUES (:image_livre, :nom_livre, :categorie_livre, :auteur, :nb_Pages)";
            $statement = $connexion->prepare($requete);

            // Liaison des paramètres
            $statement->bindParam(':image_livre', $image_livre);
            $statement->bindParam(':nom_livre', $nom_livre);
            $statement->bindParam(':categorie_livre', $categorie_livre);
            $statement->bindParam(':auteur', $auteur);
            $statement->bindParam(':nb_Pages', $nb_Pages);

            // Exécution de la requête
            $statement->execute();
        }

        // Fermeture du fichier
        fclose($handle);

        echo "Les livres ont été ajoutés avec succès.";
    } else {
        echo "Erreur lors de l'ouverture du fichier.";
    }

} catch (PDOException $e) {
    echo "Erreur lors de l'ajout des livres : " . $e->getMessage();
}

$connexion = null;
?>
