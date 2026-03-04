<?php
session_start();
require_once "config.php";

// Vérifier ID
if (!isset($_GET["id"])) {
    die("ID manquant.");
}
$id = intval($_GET["id"]);

// Charger membre
$stmt = $pdo->prepare("SELECT * FROM membres_ajefem WHERE id = :id");
$stmt->execute([":id" => $id]);
$m = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$m) {
    die("<h2 style='color:red;text-align:center;'>Membre introuvable.</h2>");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Fiche Membre AJEFEM</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {
    font-family: Arial, sans-serif;
    background:#f2f5f9;
    padding:20px;
}
.container {
    max-width:600px;
    margin:auto;
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
}
.photo {
    width:120px;
    height:150px;
    border-radius:6px;
    object-fit:cover;
    border:2px solid #0b3d91;
}
h2 {
    text-align:center;
    color:#0b3d91;
    margin-bottom:20px;
}
.info {
    margin-bottom:12px;
    font-size:16px;
}
.label {
    font-weight:bold;
    color:#0b3d91;
}
</style>
</head>

<body>

<div class="container">

<h2><i class="fa-solid fa-id-card"></i> Fiche Membre AJEFEM</h2>

<div style="text-align:center;">
    <img class="photo" src="uploads/membres/<?= $m['photo'] ?>">
</div>

<br>

<div class="info"><span class="label">Nom complet :</span> <?= htmlspecialchars($m["name"]) ?></div>
<div class="info"><span class="label">Code Membre :</span> <?= htmlspecialchars($m["code_membre"]) ?></div>
<div class="info"><span class="label">Téléphone :</span> <?= htmlspecialchars($m["phone"]) ?></div>
<div class="info"><span class="label">Sexe :</span> <?= htmlspecialchars($m["sex"]) ?></div>
<div class="info"><span class="label">Adresse :</span> <?= htmlspecialchars($m["address"]) ?></div>
<div class="info"><span class="label">Rôle :</span> <?= htmlspecialchars($m["role"]) ?></div>

<div style="text-align:center;margin-top:20px;">
    <a href="generer_carte_recto_verso.php?id=<?= $m["id"] ?>"
       style="background:#27ae60;color:white;padding:12px 18px;border-radius:6px;text-decoration:none;">
       Télécharger la Carte Officielle (PDF)
    </a>
</div>

</div>

</body>
</html>
