<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$menuId = $_GET["menu_id"] ?? null;

if (!$menuId) {
    die("Aucun menu sélectionné.");
}

$sql = "SELECT * FROM menus WHERE id = ?";
$query = $pdo->prepare($sql);
$query->execute([$menuId]);
$menu = $query->fetch();

if (!$menu) {
    die("Menu introuvable.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $datePrestation = $_POST["date_prestation"];
    $heureLivraison = $_POST["heure_livraison"];
    $lieuLivraison = htmlspecialchars($_POST["lieu_livraison"]);
    $nombrePersonnes = (int) $_POST["nombre_personnes"];

    if ($nombrePersonnes < $menu["personnes_min"]) {
        $message = "Le nombre de personnes doit être au minimum de " . $menu["personnes_min"] . ".";
    } else {
        $prixTotal = $nombrePersonnes * $menu["prix"];

        if ($nombrePersonnes >= $menu["personnes_min"] + 5) {
            $prixTotal = $prixTotal * 0.90;
        }

        $sql = "INSERT INTO commandes 
                (user_id, menu_id, date_prestation, heure_livraison, lieu_livraison, nombre_personnes, prix_total)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $query = $pdo->prepare($sql);
        $query->execute([
            $_SESSION["user_id"],
            $menu["id"],
            $datePrestation,
            $heureLivraison,
            $lieuLivraison,
            $nombrePersonnes,
            $prixTotal
        ]);

        $message = "Commande enregistrée avec succès. Total : " . number_format($prixTotal, 2) . "€";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Commande - Vite & Gourmand</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menu</a>
        <a href="contact.php">Contact</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
</header>

<main>
    <section class="contact-section">
        <h2>Commander : <?= $menu["titre"] ?></h2>

        <?php if ($message) : ?>
            <p class="success-message"><?= $message ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="date" name="date_prestation" required>

            <input type="time" name="heure_livraison" required>

            <input type="text" name="lieu_livraison" placeholder="Lieu de livraison" required>

            <input 
                type="number" 
                name="nombre_personnes" 
                min="<?= $menu["personnes_min"] ?>" 
                placeholder="Nombre de personnes"
                required
            >

            <button type="submit">Valider la commande</button>
        </form>
    </section>
</main>

</body>
</html>