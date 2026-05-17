<?php

$messageEnvoye = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = htmlspecialchars($_POST["nom"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    $messageEnvoye = true;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Vite & Gourmand</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <h1>Vite & Gourmand</h1>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php#menus">Menu</a>
        <a href="contact.php">Contact</a>
    </nav>
</header>

<main>

<section class="contact-section">

    <h2>Contactez-nous</h2>

    <?php if($messageEnvoye) : ?>

        <p class="success-message">
            Votre message a bien été envoyé.
        </p>

    <?php endif; ?>

    <form method="POST">

        <input type="text"
               name="nom"
               placeholder="Votre nom"
               required>

        <input type="email"
               name="email"
               placeholder="Votre email"
               required>

        <textarea name="message"
                  placeholder="Votre message"
                  required></textarea>

        <button type="submit">
            Envoyer
        </button>

    </form>

</section>

</main>

</body>
</html>