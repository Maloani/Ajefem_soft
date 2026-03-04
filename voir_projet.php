<?php
require_once "config.php";
session_start();

// Sécurité : accès réservé aux admins
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

// Vérification ID
if (!isset($_GET["id"])) {
    header("Location: getion_projets.php?error=Aucun projet sélectionné !");
    exit();
}

$id = intval($_GET["id"]);

// Récupérer le projet
$stmt = $pdo->prepare("SELECT * FROM projets_ajefem WHERE id_projet = ?");
$stmt->execute([$id]);
$projet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projet) {
    header("Location: getion_projets.php?error=Projet introuvable !");
    exit();
}
include "header_admin.php";
?>

<main class="content">

<h2 class="page-title">📘 Détails du Projet</h2>

<div class="project-card">
    <div class="project-header">
        <h3><?= htmlspecialchars($projet['titre']) ?></h3>
        <span class="etat <?= strtolower(str_replace(' ', '_', $projet['etat_financement'])) ?>">
            <?= $projet['etat_financement'] ?>
        </span>
    </div>

    <p class="description"><?= nl2br(htmlspecialchars($projet['description'])) ?></p>

    <div class="project-info">
        <p><strong>📌 Catégorie : </strong><?= htmlspecialchars($projet['categorie']) ?></p>
        <p><strong>👤 Responsable : </strong><?= htmlspecialchars($projet['responsable']) ?></p>
        <p><strong>📅 Début : </strong><?= $projet['date_debut'] ?></p>
        <p><strong>📅 Fin : </strong><?= $projet['date_fin'] ?></p>
    </div>

    <div class="finance-box">
        <p><strong>💰 Budget prévisionnel : </strong><?= number_format($projet['budget_previsionnel'],2) ?> USD</p>
        <p><strong>🏦 Montant débloqué : </strong><?= number_format($projet['montant_debloque'],2) ?> USD</p>
    </div>
</div>

<a href="getion_projets.php" class="btn-back">⬅️ Retour</a>
<a href="modifier_projet.php?id=<?= $projet['id_projet'] ?>" class="btn-edit">✏️ Modifier</a>

</main>

<style>
.page-title {
    margin-bottom:20px;
    font-size:24px;
    color:#004aad;
}
.project-card {
    background:#ffffff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1);
    margin-bottom:25px;
}
.project-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.etat {
    padding:6px 12px;
    border-radius:6px;
    font-size:14px;
    color:#fff;
}
.etat.financé { background:#27ae60; }
.etat.non_financé { background:#e74c3c; }
.etat.en_attente { background:#f1c40f; color:#000; }

.description {
    margin:15px 0;
    background:#f8f9fa;
    padding:12px;
    border-radius:6px;
}
.project-info p, 
.finance-box p {
    margin:6px 0;
    font-size:15px;
}

.btn-back, .btn-edit {
    display:inline-block;
    padding:12px 18px;
    margin-right:10px;
    text-decoration:none;
    border-radius:6px;
    font-weight:bold;
    color:#fff;
}

.btn-back { background:#7f8c8d; }
.btn-back:hover { background:#606d6e; }

.btn-edit { background:#2980b9; }
.btn-edit:hover { background:#1b4f72; }
</style>
<?php include "footer_admin.php"; ?>
