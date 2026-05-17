<?php
session_start();
require_once __DIR__ . "/../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = htmlspecialchars($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$email]);

    $user = $query->fetch();

    if ($user && password_verify($password, $user["mot_de_passe"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_nom"] = $user["nom"];
        $_SESSION["role_id"] = $user["role_id"];

        header("Location: index.php");
        exit;

    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="contact-section">
    <h2>Connexion</h2>

    <?php if ($message) : ?>
        <p class="success-message"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Votre email" required>

        <input type="password" name="password" placeholder="Votre mot de passe" required>

        <button type="submit">Se connecter</button>
    </form>

    <p>
        Pas encore de compte ?
        <a href="register.php">Créer un compte</a>
    </p>
</section>

</body>
</html>