<?php
session_start();
require_once __DIR__ . "/../config/database.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CGV - Vite & Gourmand</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>
    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menus</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>

<main>
    <section class="contact-section">
        <h2>Conditions Générales de Vente</h2>

        <p>
            Les commandes doivent être effectuées dans les délais indiqués pour chaque menu.
        </p>

        <p>
            Le prix final dépend du nombre de personnes, du menu choisi et des frais éventuels de livraison.
        </p>

        <p>
            En cas de prêt de matériel, celui-ci devra être restitué dans un délai de 10 jours ouvrés.
            En cas de non-restitution, des frais de 600€ pourront être appliqués.
        </p>

        <p>
            Toute commande acceptée par l’équipe ne peut plus être annulée directement par le client.
        </p>
    </section>
</main>

</body>
</html>