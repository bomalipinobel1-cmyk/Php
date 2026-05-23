<!DOCTYPE html>
<html>
<head>
    <title>Liste des colis</title>
    <link rel="stylesheet" href="nb.css">
</head>
<body>
    <?php include("menu.php"); ?>

    <h2>Liste des colis</h2>

    <form method="GET" class="search">
        <input type="text" name="q">
        <button type="submit">Rechercher</button>
    </form>

    <?php
    $fichier = "colis.json";
    if (file_exists($fichier)) {
        $data = json_decode(file_get_contents($fichier), true);
    } else {
        $data = [];
    }

    $search = $_GET["q"] ?? "";
    if ($search != "") {
        $resultats = array_filter($data, function($colis) use ($search) {
            return strpos($colis["numero"], $search) !== false ||
                   strpos($colis["telephone"], $search) !== false;
        });
    } else {
        $resultats = $data;
    }
    ?>

    <table>
        <tr>
            <th>Numéro de suivi</th>
            <th>Client</th>
            <th>Téléphone</th>
            <th>Description</th>
            <th>Statut</th>
        </tr>
        <?php foreach ($resultats as $colis): ?>
        <tr>
            <td><?= htmlspecialchars($colis["numero"]) ?></td>
            <td><?= htmlspecialchars($colis["client"]) ?></td>
            <td><?= htmlspecialchars($colis["telephone"]) ?></td>
            <td><?= htmlspecialchars($colis["description"]) ?></td>
            <td><?= htmlspecialchars($colis["statut"]) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
