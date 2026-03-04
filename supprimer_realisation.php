<?php
// ================================================
//  supprimer_realisation.php - AJEFEM ADMIN
// ================================================
session_start();
require_once "config.php";

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

/* Vérifier ID */
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("ID manquant ou invalide.");
}

$id = intval($_GET["id"]);

/* Vérifier si la réalisation existe */
$stmt = $pdo->prepare("SELECT image_principale FROM realisations WHERE id = :id");
$stmt->execute([":id" => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Erreur : la réalisation n'existe pas.");
}

/* Suppression de l'image si elle existe */
if (!empty($data["image_principale"])) {
    $path = "uploads/realisations/" . $data["image_principale"];
    if (file_exists($path)) {
        unlink($path);
    }
}

/* Suppression dans la base de données */
$delete = $pdo->prepare("DELETE FROM realisations WHERE id = :id");
$delete->execute([":id" => $id]);

/* Redirection */
header("Location: liste_realisations.php?success=deleted");
exit();
