<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"]) || !in_array($_SESSION["role_id"], [1, 2])) {
    header("Location: login.php");
    exit;
}

/*
Pour l’instant, page admin simple.
Plus tard on pourra limiter l’accès aux rôles admin/employé.
*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $commandeId = (int) $_POST["commande_id"];
    $statut = htmlspecialchars($_POST["statut"]);

    $sql = "UPDATE commandes SET statut = ? WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$statut, $commandeId]);

    header("Location: admin-commandes.php");
    exit;
}

$sql = "SELECT commandes.*, menus.titre, users.nom, users.prenom, users.email, users.telephone
        FROM commandes
        INNER JOIN menus ON commandes.menu_id = menus.id
        INNER JOIN users ON commandes.user_id = users.id
        ORDER BY commandes.created_at DESC";

$query = $pdo->query($sql);
$commandes = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des commandes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Administration</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="admin.php">Ajouter un menu</a>
        <a href="admin-commandes.php">Commandes</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
</header>

<main>
    <section class="contact-section">
        <h2>Gestion des commandes</h2>

        <?php if (empty($commandes)) : ?>
            <p>Aucune commande pour le moment.</p>
        <?php endif; ?>

        <?php foreach ($commandes as $commande) : ?>
            <article class="menu-card">
                <h3>Commande #<?= htmlspecialchars($commande["id"]) ?> - <?= htmlspecialchars($commande["titre"]) ?></h3>

                        <p><strong>Client :</strong> <?= htmlspecialchars($commande["prenom"]) ?> <?= htmlspecialchars($commande["nom"]) ?></p>

                        <p><strong>Email :</strong> <?= htmlspecialchars($commande["email"]) ?></p>
                        <p><strong>Téléphone :</strong> <?= htmlspecialchars($commande["telephone"]) ?></p>
                        <p><strong>Date prestation :</strong> <?= htmlspecialchars($commande["date_prestation"]) ?></p>
                        <p><strong>Heure livraison :</strong> <?= htmlspecialchars($commande["heure_livraison"]) ?></p>
                        <p><strong>Lieu :</strong> <?= htmlspecialchars($commande["lieu_livraison"]) ?></p>
                        <p><strong>Personnes :</strong> <?= htmlspecialchars($commande["nombre_personnes"]) ?></p>
                        <p><strong>Total :</strong> <?= htmlspecialchars($commande["prix_total"]) ?>€</p>
                <form method="POST">
<input type="hidden" name="commande_id" value="<?= htmlspecialchars($commande["id"]) ?>">

                    <select name="statut">
                        <option value="en attente" <?= $commande["statut"] === "en attente" ? "selected" : "" ?>>En attente</option>
                        <option value="accepté" <?= $commande["statut"] === "accepté" ? "selected" : "" ?>>Accepté</option>
                        <option value="en préparation" <?= $commande["statut"] === "en préparation" ? "selected" : "" ?>>En préparation</option>
                        <option value="en cours de livraison" <?= $commande["statut"] === "en cours de livraison" ? "selected" : "" ?>>En cours de livraison</option>
                        <option value="livré" <?= $commande["statut"] === "livré" ? "selected" : "" ?>>Livré</option>
                        <option value="en attente du retour de matériel" <?= $commande["statut"] === "en attente du retour de matériel" ? "selected" : "" ?>>En attente du retour de matériel</option>
                        <option value="terminée" <?= $commande["statut"] === "terminée" ? "selected" : "" ?>>Terminée</option>
                    </select>

                    <button type="submit">Mettre à jour</button>
                </form>
            </article>
        <?php endforeach; ?>
    </section>
</main>

</body>
</html>