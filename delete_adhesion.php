<?php
require_once "config.php";

if (!isset($_GET["id"])) {
    header("Location: liste_membresonline.php?error=" . urlencode("ID introuvable."));
    exit();
}

$id = intval($_GET["id"]);

try {
    $sql = "DELETE FROM adhesions_requets WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":id" => $id]);

    header("Location: liste_membresonline.php?success=" . urlencode("Adhésion supprimée."));
    exit();
}
catch (Exception $e) {
    header("Location: liste_membresonline.php?error=" . urlencode("Erreur lors de la suppression."));
    exit();
}
