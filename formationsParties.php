<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h1>Des formations pour enrichir vos connaissances</h1>
                </div>
            </div>
        </div>

        <div class="row course_boxes">
            <?php
            $serveur = "localhost";
			$utilisateur = "yaoko2276746";
			$motDePasse = "Nocaise2015@1!";
			$baseDeDonnees = "yaoko2276746";

            try {
                // Connexion à la base de données avec PDO
                $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Requête pour récupérer les informations sur les formations
                $requete = "SELECT * FROM Formations";
                $resultat = $connexion->query($requete);

                $chemin_local_images = '/formation/imagesFormations/';

                while ($row = $resultat->fetch()) {
                    $image = $row['image'];
                    $libelle_formation = $row['libelle_formation'];
                    $matiere = $row['matiere'];
                    $methode = $row['methode'];
                    $estLance = $row['estLance'];
                    $nbre_Heures = $row['nbre_Heures'];

                    echo "<div class='col-lg-4 course_box'>";
                    echo "<div class='card'>";
                    echo "<img class='card-img-top' src='" . $chemin_local_images . $image . "' alt='Image de la formation' style='max-width: 200px;'>";
                    echo "<div class='card-body text-center'>";
                    echo "<div class='card-title'><a href='#'>$libelle_formation</a></div>";
                    echo "<div class='card-text'>$matiere</div>";
                    echo "</div>";
                    echo "<div class='price_box d-flex flex-row align-items-center'>";
                    echo "<div class='course_author_image'>";
                    // Vous pouvez remplacer l'image de l'auteur par une image stockée dans la base de données si nécessaire
                    //echo "<img src='images/author.jpg' alt='Auteur'>";
                    //echo "<div class='course_price d-flex flex-column align-items-center justify-content-center'><span>$estLance </span></div>";
                    echo "</div>";
                    echo "<div class='course_author_name'>$methode <span> Author</span></div>";
                    echo "<div class='course_price d-flex flex-column align-items-center justify-content-center'><span>$nbre_Heures H </span></div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

            } catch (PDOException $e) {
                echo "Erreur lors de la récupération des informations sur les formations : " . $e->getMessage();
            }

            $connexion = null;
            ?>
        </div>
    </div>
</div>
