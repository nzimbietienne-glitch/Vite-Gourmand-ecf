<?php
session_start();
require_once __DIR__ . "/../config/database.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mentions légales - Vite & Gourmand</title>
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
        <h2>Mentions légales</h2>

        <p><strong>Nom de l’entreprise :</strong> Vite & Gourmand</p>
        <p><strong>Activité :</strong> Service traiteur événementiel.</p>
        <p><strong>Adresse :</strong> Bordeaux, France.</p>
        <p><strong>Email :</strong> contact@vitegourmand.fr</p>

        <p>
            Ce site est réalisé dans le cadre d’un projet ECF Développeur Web et Web Mobile.
        </p>
    </section>
</main>

</body>
</html>