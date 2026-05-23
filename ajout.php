<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un colis</title>
    <link rel="stylesheet" href="nb.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <h2>Ajouter un colis</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $colis = [
            "numero" => $_POST["numero"],
            "client" => $_POST["client"],
            "telephone" => $_POST["telephone"],
            "description" => $_POST["description"],
            "statut" => $_POST["statut"]
        ];

        $fichier = "colis.json";
        if (file_exists($fichier)) {
            $data = json_decode(file_get_contents($fichier), true);
        } else {
            $data = [];
        }

        $data[] = $colis;
        file_put_contents($fichier, json_encode($data, JSON_PRETTY_PRINT));

        echo "<p class='success'> Colis ajouté avec succès !</p>";
    }
    ?>

    <form method="POST">
        Numéro de suivi : <input type="text" name="numero" required><br>
        Nom du client : <input type="text" name="client" required><br>
        Téléphone : <input type="text" name="telephone" required><br>
        Description : <input type="text" name="description"><br>
        Statut :
        <select name="statut">
            <option>En attente</option>
            <option>En cours</option>
            <option>Livré</option>
        </select><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
