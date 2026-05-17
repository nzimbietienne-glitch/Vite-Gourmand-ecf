<?php
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"]) || !in_array($_SESSION["role_id"], [1, 2])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? null;

$sql = "SELECT * FROM menus WHERE id = ?";
$query = $pdo->prepare($sql);
$query->execute([$id]);

$menu = $query->fetch();

if (!$menu) {
    die("Menu introuvable");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = htmlspecialchars($_POST["titre"]);
    $description = htmlspecialchars($_POST["description"]);
    $theme = htmlspecialchars($_POST["theme"]);
    $regime = htmlspecialchars($_POST["regime"]);
    $personnes = (int) $_POST["personnes_min"];
    $prix = (float) $_POST["prix"];

    $sql = "UPDATE menus
            SET titre = ?,
                description = ?,
                theme = ?,
                regime = ?,
                personnes_min = ?,
                prix = ?
            WHERE id = ?";

    $query = $pdo->prepare($sql);

    $query->execute([
        $titre,
        $description,
        $theme,
        $regime,
        $personnes,
        $prix,
        $id
    ]);

    $message = "Menu modifié avec succès.";

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Modifier Menu</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="contact-section">

    <h2>Modifier le menu</h2>

    <form method="POST">

        <input type="text"
               name="titre"
               value="<?= htmlspecialchars($menu['titre']) ?>"
               required>

        <textarea name="description"
                  required><?= htmlspecialchars($menu['description']) ?></textarea>

        <input type="text"
               name="theme"
               value="<?= htmlspecialchars($menu['theme']) ?>"
               required>

        <input type="text"
               name="regime"
               value="<?= htmlspecialchars($menu['regime']) ?>"
               required>

        <input type="number"
               name="personnes_min"
               value="<?= htmlspecialchars($menu['personnes_min']) ?>"
               required>

        <input type="number"
               step="0.01"
               name="prix"
               value="<?= htmlspecialchars($menu['prix']) ?>"
               required>

        <button type="submit">
            Modifier
        </button>

    </form>

</section>

</body>
</html>