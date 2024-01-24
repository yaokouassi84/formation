<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "formation";

try {
    // Connexion à la base de données avec PDO
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $libelle_formation = $_POST["libelle_formation"];
        $matiere = $_POST["matiere"];
        $methode = $_POST["methode"];
        $estLance = $_POST["estLance"];
        $nbre_Heures = $_POST["nbre_Heures"];

        // Vérifier si un fichier a été téléchargé
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp = $_FILES["image"]["tmp_name"];

            // Déplacer le fichier téléchargé vers un emplacement souhaité
            //$chemin_upload = "/chemin/vers/votre/dossier/images/";

            $chemin_upload = 'C:/xampp\htdocs\formation\imagesFormations/';

            $chemin_final = $chemin_upload . $image_name;
            move_uploaded_file($image_tmp, $chemin_final);
        } else {
            echo "Erreur : Aucun fichier image n'a été téléchargé.";
            exit;
        }

        // Préparer la requête d'insertion

         $requeteInsertion = "INSERT INTO formations (libelle_formation, matiere, methode, image, estLance, nbre_Heures)
                            VALUES (:libelle_formation, :matiere, :methode, :image, :estLance, :nbre_Heures)";
        
        /*$requete = "INSERT INTO formations (libelle_formation, matiere, methode, image, estLance)
                    VALUES (:libelle_formation, :matiere, :methode, :image, :estLance)";*/
        $statement = $connexion->prepare($requeteInsertion);

        // Liaison des paramètres
        $statement->bindParam(':libelle_formation', $libelle_formation);
        $statement->bindParam(':matiere', $matiere);
        $statement->bindParam(':methode', $methode);
        $statement->bindParam(':image', $image_name);
        $statement->bindParam(':estLance', $estLance);
        $statement->bindParam(':nbre_Heures', $nbre_Heures);

        // Exécution de la requête
        $statement->execute();

        echo "Les données ont été ajoutées avec succès.";

    } else {
        echo "Erreur : Le formulaire n'a pas été soumis correctement.";
    }

} catch (PDOException $e) {
    echo "Erreur lors du traitement des données : " . $e->getMessage();
}

$connexion = null;
?>
