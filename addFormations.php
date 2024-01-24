<?php





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Formation</title>
</head>
<body>

    <h2>Formulaire de Formation</h2>

    <form action="sql_formations.php" method="post" enctype="multipart/form-data">
        <label for="libelle_formation">Libellé de la formation:</label>
        <input type="text" id="libelle_formation" name="libelle_formation" required><br><br>

        <label for="matiere">Matière:</label>
        <input type="text" id="matiere" name="matiere" required><br><br>

        <label for="methode">Méthode:</label>
        <input type="text" id="methode" name="methode" required><br><br>

        <label for="image">Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <label for="estLance">Est Lancé:</label>
        <select id="estLance" name="estLance" required>
            <option value="1">Oui</option>
            <option value="0">Non</option>
        </select><br><br>
        <label for="nbre_Heures">Nombre d'heures:</label>
        <input type="number" id="nbre_Heures" name="nbre_Heures" required><br><br>

        <input type="submit" value="Soumettre">
    </form>

</body>
</html>
