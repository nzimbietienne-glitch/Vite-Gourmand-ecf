<?php
require_once __DIR__ . "/../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars($_POST["nom"]);
    $prenom = htmlspecialchars($_POST["prenom"]);
    $email = htmlspecialchars($_POST["email"]);
    $telephone = htmlspecialchars($_POST["telephone"]);
    $adresse = htmlspecialchars($_POST["adresse"]);
    $password = $_POST["password"];

    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{10,}$/', $password)) {
        $message = "Le mot de passe doit contenir au moins 10 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
    } else {

        $checkSql = "SELECT id FROM users WHERE email = ?";
        $checkQuery = $pdo->prepare($checkSql);
        $checkQuery->execute([$email]);

        if ($checkQuery->fetch()) {
            $message = "Cet email est déjà utilisé.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (role_id, nom, prenom, email, telephone, adresse, mot_de_passe)
                    VALUES (3, ?, ?, ?, ?, ?, ?)";

            $query = $pdo->prepare($sql);
            $query->execute([$nom, $prenom, $email, $telephone, $adresse, $passwordHash]);

            $message = "Compte créé avec succès.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section class="contact-section">
    <h2>Créer un compte</h2>

    <?php if ($message) : ?>
        <p class="success-message"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="telephone" placeholder="Téléphone">
        <input type="text" name="adresse" placeholder="Adresse">
        <input type="password" name="password" placeholder="Mot de passe" required>

        <button type="submit">Créer mon compte</button>
    </form>
</section>

</body>
</html>