<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? null;

if (!$id) {
    header("Location: mes-commandes.php");
    exit;
}

// On vérifie que la commande appartient bien à l'utilisateur connecté
$sql = "SELECT * FROM commandes WHERE id = ? AND user_id = ?";
$query = $pdo->prepare($sql);
$query->execute([$id, $_SESSION["user_id"]]);

$commande = $query->fetch();

if (!$commande) {
    header("Location: mes-commandes.php");
    exit;
}

// L'utilisateur peut annuler uniquement si la commande est encore en attente
if ($commande["statut"] === "en attente") {
    $sql = "UPDATE commandes SET statut = 'annulée' WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
}

header("Location: mes-commandes.php");
exit;