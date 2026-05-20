<?php session_start(); ?>
<?php require_once __DIR__ . "/../config/database.php"; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vite & Gourmand</title>
    <link rel="stylesheet" href="css/style.css?v=10">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menu</a>
        <a href="contact.php">Contact</a>
        
        <?php if (isset($_SESSION["user_id"])) : ?>
            <a href="mes-commandes.php">Mes commandes</a>

            <?php if (isset($_SESSION["role_id"]) && in_array($_SESSION["role_id"], [1, 2])) : ?>
                <a href="admin.php">Administration</a>
                <a href="admin-commandes.php">Commandes</a>
            <?php endif; ?>

            <a href="logout.php">Déconnexion</a>
        <?php else : ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <section class="hero">
    <div class="hero-content">
        <h2>Une expérience culinaire unique</h2>
        <p>
            Depuis 25 ans, Vite & Gourmand sublime vos évènements avec des plats raffinés et sur mesure.
        </p>
        <a href="#menus" class="btn-primary">Voir nos menus</a>
    </div>
</section>

<section class="menus-section" id="menus">
    <h2>Nos menus</h2>

<div class="filters">
    <input type="number" id="prixMax" placeholder="Prix max">
    
    <select id="theme">
        <option value="">Thème</option>
        <option value="noel">Noël</option>
        <option value="paques">Pâques</option>
        <option value="classique">Classique</option>
    </select>

    <select id="regime">
        <option value="">Régime</option>
        <option value="vegetarien">Végétarien</option>
        <option value="vegan">Vegan</option>
        <option value="classique">Classique</option>
        <option value="evenement">Événement</option>
    </select>

    <button id="filtrer">Filtrer</button>
</div>

<div class="menus-grid">

<?php
$sql = "SELECT * FROM menus";
$requete = $pdo->query($sql);

while ($menu = $requete->fetch()) :
?>

<article class="menu-card"
    data-prix="<?= htmlspecialchars($menu['prix']); ?>"
    data-theme="<?= htmlspecialchars($menu['theme']); ?>"
    data-regime="<?= htmlspecialchars($menu['regime']); ?>">

    <?php if (!empty($menu['image'])) : ?>
    <img src="images/<?= htmlspecialchars($menu['image']); ?>"
         alt="<?= htmlspecialchars($menu['titre']); ?>"
         class="menu-image">
    <?php endif; ?>

    <h3><?= htmlspecialchars($menu['titre']); ?></h3>

    <p><?= htmlspecialchars($menu['description']); ?></p>

    <p>
        À partir de <?= htmlspecialchars($menu['personnes_min']); ?> personnes
    </p>

    <p>
        <strong><?= htmlspecialchars($menu['prix']); ?>€</strong>
    </p>

    <a href="menu-detail.php?id=<?= htmlspecialchars($menu['id']); ?>">
        Voir le détail
    </a>

    <?php if (isset($_SESSION["role_id"]) && in_array($_SESSION["role_id"], [1, 2])) : ?>
        <a href="delete-menu.php?id=<?= htmlspecialchars($menu['id']); ?>"
           class="delete-btn">
           Supprimer
        </a>

        <a href="edit-menu.php?id=<?= htmlspecialchars($menu['id']); ?>"
           class="edit-btn">
           Modifier
        </a>
    <?php endif; ?>

</article>

<?php endwhile; ?>
</div>
</section>
</main>

<section class="avis-section">
    <h2>Ce que disent nos clients</h2>

    <div class="avis-grid">
        <article class="avis-card">
            <p>“Service professionnel, menu excellent et livraison parfaitement organisée.”</p>
            <strong>Sophie M.</strong>
        </article>

        <article class="avis-card">
            <p>“Très bonne expérience pour notre événement familial. Je recommande.”</p>
            <strong>Julien D.</strong>
        </article>
    </div>
</section>

<footer>
    <p>Horaires : du Lundi au Dimanche</p>
    <a href="mentions-legales.php">Mentions légales</a>
    <a href="cgv.php">CGV</a>
</footer>

<script src="js/main.js?v=2"></script>
</body>
</html>