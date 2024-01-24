<div class="popular page_section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title text-center">
                    <h1>Des livres peuvent toujours nous servir</h1>
                </div>
            </div>
        </div>

        <div class="row course_boxes">
            <?php
            $serveur = "localhost";
            $utilisateur = "root";
            $motDePasse = "";
            $baseDeDonnees = "formation";

            try {
                // Connexion à la base de données avec PDO
                $connexion = new PDO("mysql:host=$serveur;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Pagination
                $livresParPage = 6; // Nombre de livres par page
                $pageCourante = isset($_GET['page']) ? $_GET['page'] : 1; // Page actuelle, par défaut 1
                $depart = ($pageCourante - 1) * $livresParPage; // L'index de départ pour la requête SQL

                // Requête pour récupérer les informations sur les livres avec pagination
                $requete = "SELECT image_livre,nom_livre,categorie_livre, auteur, nb_Pages 
                            FROM Livres 
                            WHERE image_livre IS NOT NULL
                            LIMIT :depart, :livresParPage";
                $statement = $connexion->prepare($requete);
                $statement->bindValue(':depart', $depart, PDO::PARAM_INT);
                $statement->bindValue(':livresParPage', $livresParPage, PDO::PARAM_INT);
                $statement->execute();
                $resultat = $statement->fetchAll();

                $chemin_upload = '/formation/photosLivres/';

                error_reporting(E_ALL);
                ini_set('display_errors', 1);

                foreach ($resultat as $row) {
                    $image = $row['image_livre'];
                    $titre = $row['nom_livre'];
                    $description = $row['categorie_livre'];
                    $auteur = $row['auteur'];
                    $prix = $row['nb_Pages'];

                    echo "<div class='col-lg-4 course_box'>";
                    echo "<div class='card'>";
                    echo "<img class='card-img-top' src='$chemin_upload$image' alt='Image du livre' style='max-width: 300px;'>";
                    echo "<div class='card-body text-center'>";
                    // echo "<div class='card-title'><a href='courses.html'>$titre</a></div>";
                    // echo "<div class='card-text'>$description</div>";
                    echo "</div>";
                    // echo "<div class='price_box d-flex flex-row align-items-center'>";
                    // echo "<div class='course_author_image'>";
                    // echo "<img src='images/author.jpg' alt='Auteur'>";
                    // echo "</div>";
                    // echo "<div class='course_author_name'>$auteur</div>";
                    // echo "<div class='course_price d-flex flex-column align-items-center justify-content-center'><span>$prix</span></div>";
                    // echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }

                // Pagination
                $requeteTotalLivres = "SELECT COUNT(*) as total FROM Livres WHERE image_livre IS NOT NULL";
                $statementTotalLivres = $connexion->query($requeteTotalLivres);
                $totalLivres = $statementTotalLivres->fetch()['total'];
                $nombrePages = ceil($totalLivres / $livresParPage);

                echo "<div class='row'>";
                echo "<div class='col'>";
                echo "<ul class='pagination justify-content-center'>";
                
                for ($i = 1; $i <= $nombrePages; $i++) {
                    echo "<li class='page-item " . ($i == $pageCourante ? 'active' : '') . "'>";
                    echo "<a class='page-link' href='?page=$i'>$i</a>";
                    echo "</li>";
                }

                echo "</ul>";
                echo "</div>";
                echo "</div>";

            } catch (PDOException $e) {
                echo "Erreur lors de la récupération des informations sur les livres : " . $e->getMessage();
            }

            $connexion = null;
            ?>
        </div>
    </div>
</div>

