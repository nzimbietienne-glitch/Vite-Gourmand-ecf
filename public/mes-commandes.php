<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT commandes.*, menus.titre 
        FROM commandes
        INNER JOIN menus ON commandes.menu_id = menus.id
        WHERE commandes.user_id = ?
        ORDER BY commandes.created_at DESC";

$query = $pdo->prepare($sql);
$query->execute([$_SESSION["user_id"]]);

$commandes = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes commandes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menu</a>
        <a href="mes-commandes.php">Mes commandes</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
</header>

<main>
    <section class="contact-section">
        <h2>Mes commandes</h2>

        <?php if (empty($commandes)) : ?>
            <p>Vous n’avez encore passé aucune commande.</p>
        <?php endif; ?>

        <?php foreach ($commandes as $commande) : ?>
            <article class="menu-card">
                <h3><?= htmlspecialchars($commande["titre"]) ?></h3>
                <p><strong>Date :</strong> <?= htmlspecialchars($commande["date_prestation"]) ?></p>
                <p><strong>Heure :</strong> <?= htmlspecialchars($commande["heure_livraison"]) ?></p>
                <p><strong>Lieu :</strong> <?= htmlspecialchars($commande["lieu_livraison"]) ?></p>
                <p><strong>Personnes :</strong> <?= htmlspecialchars($commande["nombre_personnes"]) ?></p>
                <p><strong>Total :</strong> <?= htmlspecialchars($commande["prix_total"]) ?>€</p>
                <p><strong>Statut :</strong> <?= htmlspecialchars($commande["statut"]) ?></p>
                
                <?php if ($commande["statut"] === "en attente") : ?>
    <a href="annuler-commande.php?id=<?= htmlspecialchars($commande["id"]) ?>"
   class="delete-btn"
   onclick="return confirm('Voulez-vous vraiment annuler cette commande ?');">
   Annuler la commande
</a>
<?php endif; ?>
            </article>
        <?php endforeach; ?>
    </section>
</main>

</body>
</html>