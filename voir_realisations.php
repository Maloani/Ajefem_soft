<?php
// ================================================
//  voir_realisation.php - Page publique AJEFEM
// ================================================
require_once "config.php";

if (!isset($_GET["id"])) {
    die("ID manquant.");
}

$id = intval($_GET["id"]);

/* --- Charger la réalisation --- */
$stmt = $pdo->prepare("SELECT * FROM realisations WHERE id = :id");
$stmt->execute([":id" => $id]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$r) {
    die("Réalisation introuvable.");
}

/* --- Compteur de vues --- */
$update = $pdo->prepare("UPDATE realisations SET vues = vues + 1 WHERE id = :id");
$update->execute([":id" => $id]);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($r["titre"]) ?> - AJEFEM</title>

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* Conteneur principal */
.rea-view-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 15px;
}

/* Image principale */
.rea-image {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

/* Titre */
.rea-title {
    font-size: 32px;
    font-weight: bold;
    margin-top: 25px;
    color: #0b3d91;
}

/* Catégorie + date */
.rea-meta {
    margin: 10px 0 20px;
    font-size: 15px;
    color: #666;
}

/* Description */
.rea-description {
    font-size: 18px;
    line-height: 1.7;
    color: #444;
    margin-bottom: 30px;
}

/* Lire plus / Voir moins */
.show-more {
    color: #0b3d91;
    font-weight: bold;
    cursor: pointer;
    display: inline-block;
    margin-top: 10px;
}

.back-btn {
    padding: 12px 20px;
    background:#0b3d91;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:16px;
}

.back-btn:hover {
    background:#062e67;
}
</style>

</head>
<body>

<div class="rea-view-container">

    <img src="uploads/realisations/<?= $r['image_principale'] ?>" class="rea-image">

    <h1 class="rea-title"><?= htmlspecialchars($r['titre']) ?></h1>

    <div class="rea-meta">
        <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($r["categorie"]) ?>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <i class="fa-solid fa-calendar"></i> <?= $r["date_realisation"] ?>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <i class="fa-solid fa-eye"></i> <?= $r["vues"] ?> vues
    </div>

    <!-- =============================== -->
    <!--  DESCRIPTION AVEC LIRE + / -   -->
    <!-- =============================== -->
    <div id="textContent" class="rea-description">
        <?= nl2br(htmlspecialchars($r["description"])) ?>
    </div>

    <span id="toggleBtn" class="show-more">Lire plus</span>

    <br><br>

    <a href="realisations.php" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> Retour aux réalisations
    </a>

</div>

<script>
// Limite d'affichage avant bouton Lire plus
const maxLength = 600;

const content = document.getElementById("textContent");
const toggleBtn = document.getElementById("toggleBtn");

let fullText = content.innerHTML.replace(/\n/g, "<br>");
let shortText = fullText.substring(0, maxLength) + "...";

if (fullText.length <= maxLength) {
    toggleBtn.style.display = "none";  // Pas besoin de bouton
} else {
    content.innerHTML = shortText;
}

let expanded = false;

toggleBtn.addEventListener("click", () => {
    expanded = !expanded;

    if (expanded) {
        content.innerHTML = fullText;
        toggleBtn.textContent = "Voir moins";
    } else {
        content.innerHTML = shortText;
        toggleBtn.textContent = "Lire plus";
    }
});
</script>

</body>
</html>
