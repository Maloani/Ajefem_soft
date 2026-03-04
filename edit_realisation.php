<?php
// ================================================
//  edit_realisation.php - AJEFEM ADMIN (BILINGUE)
// ================================================
session_start();
require_once "config.php";

if (!isset($_SESSION["logged_in"])) { 
    header("Location: login.php");
    exit(); 
}

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = intval($_GET["id"]);

/* --- Récupération de la réalisation --- */
$stmt = $pdo->prepare("SELECT * FROM realisations WHERE id = :id");
$stmt->execute([":id" => $id]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$r) {
    die("Réalisation introuvable.");
}

/* --- Mise à jour --- */
if (isset($_POST["update"])) {

    $titre_fr      = trim($_POST["titre_fr"]);
    $titre_en      = trim($_POST["titre_en"]);

    $description_fr = trim($_POST["description_fr"]);
    $description_en = trim($_POST["description_en"]);

    $categorie_fr   = trim($_POST["categorie_fr"]);
    $categorie_en   = trim($_POST["categorie_en"]);

    $date_realisation = $_POST["date_realisation"];

    // Nouvelle image ?
    $newImage = $r["image_principale"];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {

        $uploadDir = "uploads/realisations/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $fileName = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

            // supprimer ancienne image
            $old = $uploadDir . $r["image_principale"];
            if ($r["image_principale"] && file_exists($old)) {
                unlink($old);
            }

            $newImage = $fileName;
        }
    }

    // Update DB
    $update = $pdo->prepare("
        UPDATE realisations
        SET 
            titre_fr        = :tfr,
            titre_en        = :ten,
            description_fr  = :dfr,
            description_en  = :den,
            categorie_fr    = :cfr,
            categorie_en    = :cen,
            image_principale = :img,
            date_realisation = :date_r
        WHERE id = :id
    ");

    $update->execute([
        ":tfr" => $titre_fr,
        ":ten" => $titre_en,
        ":dfr" => $description_fr,
        ":den" => $description_en,
        ":cfr" => $categorie_fr,
        ":cen" => $categorie_en,
        ":img" => $newImage,
        ":date_r" => $date_realisation,
        ":id" => $id
    ]);

    header("Location: liste_realisations.php?success=updated");
    exit();
}

include "header_admin.php";
?>

<h2>✏️ Modifier une Réalisation (FR / EN)</h2>

<form method="POST" enctype="multipart/form-data" 
      style="background:#fff;padding:20px;border-radius:10px;border:1px solid #ccc;max-width:700px;">

    <!-- FRANÇAIS -->
    <h3>🇫🇷 Version Française</h3>

    <label>Titre (FR) :</label>
    <input type="text" name="titre_fr" 
           value="<?= htmlspecialchars($r['titre_fr']) ?>" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Description (FR) :</label>
    <textarea name="description_fr" rows="5" required  
              style="width:100%;padding:8px;margin-bottom:10px;"><?= htmlspecialchars($r['description_fr']) ?></textarea>

    <label>Catégorie (FR) :</label>
    <input type="text" name="categorie_fr" 
           value="<?= htmlspecialchars($r['categorie_fr']) ?>" required
           style="width:100%;padding:8px;margin-bottom:10px;">


    <!-- ANGLAIS -->
    <h3>🇬🇧 English Version</h3>

    <label>Title (EN) :</label>
    <input type="text" name="titre_en" 
           value="<?= htmlspecialchars($r['titre_en']) ?>" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Description (EN) :</label>
    <textarea name="description_en" rows="5" required  
              style="width:100%;padding:8px;margin-bottom:10px;"><?= htmlspecialchars($r['description_en']) ?></textarea>

    <label>Category (EN) :</label>
    <input type="text" name="categorie_en" 
           value="<?= htmlspecialchars($r['categorie_en']) ?>" required
           style="width:100%;padding:8px;margin-bottom:10px;">


    <!-- DATE -->
    <label>Date de réalisation :</label>
    <input type="date" name="date_realisation" 
           value="<?= htmlspecialchars($r['date_realisation']) ?>" required
           style="width:100%;padding:8px;margin-bottom:15px;">


    <!-- IMAGE -->
    <label>Image actuelle :</label><br>
    <img src="uploads/realisations/<?= $r['image_principale'] ?>" 
         style="width:150px;border-radius:8px;margin:10px 0;"><br>

    <label>Nouvelle image (optionnelle) :</label>
    <input type="file" name="image" style="margin-bottom:15px;">


    <!-- ACTIONS -->
    <button type="submit" name="update"
            style="padding:10px 20px;background:#08306b;color:white;border:none;border-radius:5px;">
        💾 Mettre à jour
    </button>

    <a href="liste_realisations.php" 
       style="padding:10px 20px;background:#777;color:white;border-radius:5px;text-decoration:none;">
        ⬅️ Annuler
    </a>

</form>

<?php include "footer_admin.php"; ?>
