<?php
require_once __DIR__ . "/../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = htmlspecialchars($_POST["titre"]);
    $description = htmlspecialchars($_POST["description"]);
    $theme = htmlspecialchars($_POST["theme"]);
    $regime = htmlspecialchars($_POST["regime"]);
    $personnes = (int) $_POST["personnes_min"];
    $prix = (float) $_POST["prix"];

    $sql = "INSERT INTO menus
    (titre, description, theme, regime, personnes_min, prix)
    VALUES (?, ?, ?, ?, ?, ?)";

    $query = $pdo->prepare($sql);

    $query->execute([
        $titre,
        $description,
        $theme,
        $regime,
        $personnes,
        $prix
    ]);

    $message = "Menu ajouté avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Admin - Vite & Gourmand</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Administration</h1>
</header>

<main>

<section class="contact-section">

    <h2>Ajouter un menu</h2>

    <?php if($message) : ?>

        <p class="success-message">
            <?= $message ?>
        </p>

    <?php endif; ?>

    <form method="POST">

        <input type="text"
               name="titre"
               placeholder="Titre"
               required>

        <textarea name="description"
                  placeholder="Description"
                  required></textarea>

        <input type="text"
               name="theme"
               placeholder="Thème"
               required>

        <input type="text"
               name="regime"
               placeholder="Régime"
               required>

        <input type="number"
               name="personnes_min"
               placeholder="Nombre minimum"
               required>

        <input type="number"
               step="0.01"
               name="prix"
               placeholder="Prix"
               required>

        <button type="submit">
            Ajouter
        </button>

    </form>

</section>

</main>

</body>
</html>