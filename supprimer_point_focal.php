<?php
// =========================================================
//   supprimer_point_focal.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

$id = intval($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: points_focaux.php?error=" . urlencode("ID invalide"));
    exit();
}

try {
    $delete = $pdo->prepare("DELETE FROM points_focaux WHERE id=:id");
    $delete->execute([":id"=>$id]);

    header("Location: points_focaux.php?success=" . urlencode("Point Focal supprimé avec succès !"));
    exit();

} catch (Exception $e) {
    header("Location: points_focaux.php?error=" . urlencode("Erreur lors de la suppression."));
    exit();
}
