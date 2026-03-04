<?php
// =========================================================
//   supprimer_membre.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérification : ADMIN seulement
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Vérifier présence ID
if (!isset($_GET["id"]) || intval($_GET["id"]) <= 0) {
    header("Location: liste_membres.php?error=" . urlencode("ID invalide."));
    exit();
}

$id = intval($_GET["id"]);

// Récupérer les infos du membre
$stmt = $pdo->prepare("SELECT photo FROM membres_ajefem WHERE id = :id");
$stmt->execute([":id" => $id]);
$membre = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$membre) {
    header("Location: liste_membres.php?error=" . urlencode("Membre introuvable."));
    exit();
}

// Supprimer photo si existe
if (!empty($membre["photo"])) {
    $photo_path = "uploads/membres/" . $membre["photo"];
    if (file_exists($photo_path)) {
        unlink($photo_path);
    }
}

// Suppression DB
try {
    $del = $pdo->prepare("DELETE FROM membres_ajefem WHERE id = :id");
    $del->execute([":id" => $id]);

    header("Location: liste_membres.php?success=" . urlencode("Membre supprimé avec succès."));
    exit();

} catch (Exception $e) {
    header("Location: liste_membres.php?error=" . urlencode("Erreur lors de la suppression."));
    exit();
}

?>
