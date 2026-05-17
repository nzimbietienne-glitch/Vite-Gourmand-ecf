<?php
session_start();
require_once __DIR__ . "/../config/database.php";

if (!isset($_SESSION["user_id"]) || !in_array($_SESSION["role_id"], [1, 2])) {
    header("Location: login.php");
    exit;
}

$id = $_GET["id"] ?? null;

if ($id) {
    $sql = "DELETE FROM menus WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
}

header("Location: index.php");
exit;