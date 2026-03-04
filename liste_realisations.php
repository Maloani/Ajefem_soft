<?php
// ================================================
//  liste_realisations.php - AJEFEM ADMIN (BILINGUE)
// ================================================
session_start();
require_once "config.php";

if (!isset($_SESSION["logged_in"])) { 
    header("Location: login.php");
    exit(); 
}

/* Pagination */
$limit = 5;
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

$total = $pdo->query("SELECT COUNT(*) FROM realisations")->fetchColumn();
$totalPages = ceil($total / $limit);

/* Récupération bilingue */
$stmt = $pdo->prepare("
    SELECT * FROM realisations
    ORDER BY date_realisation DESC
    LIMIT $limit OFFSET $offset
");
$stmt->execute();
$realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Formatage date FR */
setlocale(LC_TIME, "fr_FR.UTF-8", "French_France.1252");

include "header_admin.php";
?>

<style>
.table-wrapper { overflow-x:auto; margin-top:20px; }

.admin-table {
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.admin-table th {
    background:linear-gradient(90deg, #0b3d91, #08306b);
    color:white;
    padding:12px;
    font-size:14px;
    text-align:left;
}

.admin-table td {
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

.admin-table tr:hover { background:#f5f8ff; }

.img-mini {
    width:60px;
    height:60px;
    border-radius:6px;
    object-fit:cover;
    border:1px solid #ddd;
}

.btn-action {
    padding:7px 12px;
    margin-right:5px;
    border-radius:5px;
    font-size:13px;
    font-weight:bold;
    color:white;
    text-decoration:none;
    display:inline-block;
}

.btn-view   { background:#007bff; }
.btn-edit   { background:#ff9800; }
.btn-delete { background:#e53935; }

.btn-view:hover,
.btn-edit:hover,
.btn-delete:hover { opacity:0.85; }

.pagination {
    text-align:center;
    margin-top:20px;
}

.pagination a {
    padding:8px 15px;
    margin:0 5px;
    background:#08306b;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.pagination a:hover {
    background:#0b3d91;
}
</style>


<h2>📘 Réalisations AJEFEM (Version Bilingue)</h2>

<div class="table-wrapper">

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Titre (FR / EN)</th>
        <th>Catégorie (FR / EN)</th>
        <th>Date</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($realisations as $r): ?>
    <?php $date_formatted = strftime("%d %B %Y", strtotime($r["date_realisation"])); ?>

    <tr>
        <td><?= $r["id"] ?></td>

        <td>
            <img src="uploads/realisations/<?= $r["image_principale"] ?>" class="img-mini">
        </td>

        <td>
            <strong><?= htmlspecialchars($r["titre_fr"]) ?></strong>
            <br>
            <em style="color:#777;">(<?= htmlspecialchars($r["titre_en"]) ?>)</em>
        </td>

        <td>
            <?= htmlspecialchars($r["categorie_fr"]) ?>
            <br>
            <em style="color:#777;">(<?= htmlspecialchars($r["categorie_en"]) ?>)</em>
        </td>

        <td>
            <i class="fa-solid fa-calendar"></i> <?= $date_formatted ?>
        </td>

        <td>
            <a href="voir_realisation.php?id=<?= $r["id"] ?>&lang=fr" 
               class="btn-action btn-view">Voir</a>

            <a href="edit_realisation.php?id=<?= $r["id"] ?>" 
               class="btn-action btn-edit">Modifier</a>

            <a href="supprimer_realisation.php?id=<?= $r["id"] ?>"
               class="btn-action btn-delete"
               onclick="return confirm('Voulez-vous vraiment supprimer cette réalisation ?')">
               Supprimer
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</div>

<!-- Pagination -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?= $page-1 ?>">⬅️ Précédent</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page+1 ?>">Suivant ➡️</a>
    <?php endif; ?>
</div>

<?php include "footer_admin.php"; ?>
