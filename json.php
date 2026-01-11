

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des personnes</title>
</head>
<body>

<h2>Ajouter une personne</h2>

<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" required><br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required><br><br>

    <label>Âge :</label>
    <input type="number" name="age" required><br><br>

    <button type="submit">Ajouter</button>
    <?php

$fichier = "personne.json";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $age = $_POST['age'];

    if (file_exists($fichier)) {
        $json = file_get_contents($fichier);
        $personnes = json_decode($json, true);
    } else {
        $personnes = [];
    }

    $nouvelle_personne = [
        "nom" => $nom,
        "prenom" => $prenom,
        "age" => $age
    ];

    $personnes[] = $nouvelle_personne;

    file_put_contents($fichier, json_encode($personnes, JSON_PRETTY_PRINT));
}
if (file_exists($fichier)) {
    $json = file_get_contents($fichier);
    $personnes = json_decode($json, true);
} else {
    $personnes = [];
}
?>
</form>

<hr>

<h2>Liste des personnes</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Âge</th>
    </tr>

    <?php foreach ($personnes as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['nom']) ?></td>
            <td><?= htmlspecialchars($p['prenom']) ?></td>
            <td><?= htmlspecialchars($p['age']) ?></td>
        </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
