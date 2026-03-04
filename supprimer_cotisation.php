<?php
// =========================================================
//   supprimer_cotisation.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

$id = intval($_GET["id"] ?? 0);
if (!$id) {
    header("Location: gestion_cotisations.php?error=" . urlencode("ID invalide."));
    exit();
}

try {
    $delete = $pdo->prepare("DELETE FROM cotisations_ajefem WHERE id_cotisation = :id");
    $delete->execute([":id" => $id]);

    header("Location: gestion_cotisations.php?success=" . urlencode("Cotisation supprimée avec succès !"));
    exit();

} catch (Exception $e) {
    header("Location: gestion_cotisations.php?error=" . urlencode("Erreur lors de la suppression."));
    exit();
}
