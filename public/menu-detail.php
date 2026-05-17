<?php
require_once __DIR__ . "/../config/database.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Menu introuvable.");
}

$sql = "SELECT * FROM menus WHERE id = ?";
$query = $pdo->prepare($sql);
$query->execute([$id]);
$menu = $query->fetch();

if (!$menu) {
    die("Menu introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $menu['titre'] ?> - Vite & Gourmand</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menu</a>
        <a href="#">Contact</a>
        <a href="#">Connexion</a>
    </nav>
</header>

<main>
    <section class="menu-detail">
        <h2><?= htmlspecialchars($menu['titre']) ?></h2>
        <p><?= htmlspecialchars($menu['description']) ?></p>

        <p><strong>Thème :</strong> <?= htmlspecialchars($menu['theme']) ?></p>
        <p><strong>Régime :</strong> <?= htmlspecialchars($menu['regime']) ?></p>
        <p><strong>Nombre minimum :</strong> <?= htmlspecialchars($menu['personnes_min']) ?> personnes</p>
        <p><strong>Prix :</strong> <?= htmlspecialchars($menu['prix']) ?>€</p>
        <p><strong>Stock disponible :</strong> <?= htmlspecialchars($menu['stock']) ?></p>

       <a href="commande.php?menu_id=<?= htmlspecialchars($menu['id']) ?>" class="btn-primary">
    Commander
</a>
    </section>
</main>

</body>
</html>