<?php
// ================================================
//  ajouter_realisation.php (AJEFEM ADMIN BILINGUE)
// ================================================
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Messages retour
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

/* ---- Enregistrement ---- */
if (isset($_POST["save"])) {

    $titre_fr  = trim($_POST["titre_fr"]);
    $titre_en  = trim($_POST["titre_en"]);

    $description_fr = trim($_POST["description_fr"]);
    $description_en = trim($_POST["description_en"]);

    $categorie_fr = trim($_POST["categorie_fr"]);
    $categorie_en = trim($_POST["categorie_en"]);

    $date_realisation = $_POST["date_realisation"];

    if (
        empty($titre_fr) || empty($titre_en) ||
        empty($description_fr) || empty($description_en) ||
        empty($categorie_fr) || empty($categorie_en) ||
        empty($date_realisation)
    ) {
        header("Location: realisationsAdd.php?error=Veuillez remplir tous les champs obligatoires.");
        exit();
    }

    // Upload image
    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] != 0) {
        header("Location: realisationsAdd.php?error=Image obligatoire.");
        exit();
    }

    $upload_dir = "uploads/realisations/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $file_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $upload_dir . $file_name;

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // Insert DB
    $stmt = $pdo->prepare("
        INSERT INTO realisations 
        (titre_fr, titre_en, description_fr, description_en,
         categorie_fr, categorie_en, image_principale, date_realisation)
        VALUES (:tfr, :ten, :dfr, :den, :cfr, :cen, :image, :date_realisation)
    ");

    $stmt->execute([
        ":tfr" => $titre_fr,
        ":ten" => $titre_en,
        ":dfr" => $description_fr,
        ":den" => $description_en,
        ":cfr" => $categorie_fr,
        ":cen" => $categorie_en,
        ":image" => $file_name,
        ":date_realisation" => $date_realisation
    ]);

    header("Location: realisationsAdd.php?success=Réalisation ajoutée !");
    exit();
}

include "header_admin.php";
?>

<h2>➕ Ajouter une Réalisation (FR / EN)</h2>

<?php if ($success): ?>
<div style="background:#d4edda;padding:10px;border-left:4px solid #28a745;margin:10px 0;">
    <?= $success ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div style="background:#f8d7da;padding:10px;border-left:4px solid #b71c1c;margin:10px 0;">
    <?= $error ?>
</div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" 
      style="background:#fff;padding:20px;border-radius:8px;border:1px solid #ddd;max-width:750px;">

    <!-- FRANÇAIS -->
    <h3>🇫🇷 Version Française</h3>

    <label>Titre (FR) :</label>
    <input type="text" name="titre_fr" required 
           style="width:100%;padding:8px;margin:5px 0;">

    <label>Description (FR) :</label>
    <textarea name="description_fr" rows="5" required 
              style="width:100%;padding:8px;margin:5px 0;"></textarea>

    <label>Catégorie (FR) :</label>
    <input type="text" name="categorie_fr" required 
           placeholder="Projet, Activité, Sensibilisation…"
           style="width:100%;padding:8px;margin:5px 0;">


    <!-- ANGLAIS -->
    <h3 style="margin-top:25px;">🇬🇧 English Version</h3>

    <label>Title (EN) :</label>
    <input type="text" name="titre_en" required 
           style="width:100%;padding:8px;margin:5px 0;">

    <label>Description (EN) :</label>
    <textarea name="description_en" rows="5" required 
              style="width:100%;padding:8px;margin:5px 0;"></textarea>

    <label>Category (EN) :</label>
    <input type="text" name="categorie_en" required 
           placeholder="Project, Activity, Awareness…"
           style="width:100%;padding:8px;margin:5px 0;">


    <!-- DATE -->
    <h3 style="margin-top:25px;">📅 Date de réalisation</h3>
    <input type="date" name="date_realisation" required 
           style="width:100%;padding:8px;margin:5px 0;">


    <!-- IMAGE -->
    <h3 style="margin-top:25px;">📷 Image principale</h3>
    <input type="file" name="image" required 
           style="padding:8px;margin:5px 0;">


    <!-- SUBMIT -->
    <button type="submit" name="save" 
            style="padding:12px 22px;background:#08306b;color:white;border:none;border-radius:5px;margin-top:15px;">
        Enregistrer la Réalisation
    </button>

</form>

<?php include "footer_admin.php"; ?>
