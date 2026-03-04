<?php
// ====================================
//  fiches_adhesion.php  - AJEFEM ADMIN
// ====================================

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Messages retour
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

// ----- PARAMÈTRES DE PAGINATION -----
$limit = 5; // 5 affichages par page
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

// ----- RECHERCHE -----
$search = $_GET["search"] ?? "";

$sqlWhere = "";
$params = [];

if (!empty($search)) {
    $sqlWhere = "WHERE name LIKE :s OR email LIKE :s OR phone LIKE :s OR code_membre LIKE :s";
    $params[":s"] = "%$search%";
}

// ----- TOTAL POUR PAGINATION -----
$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM membres_ajefem $sqlWhere");
$stmtTotal->execute($params);
$totalRows = $stmtTotal->fetchColumn();

$totalPages = ceil($totalRows / $limit);

// ----- RÉCUPÉRATION DES MEMBRES PAGINÉS -----
$sql = "SELECT * FROM membres_ajefem $sqlWhere ORDER BY id DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Header admin
include "header_admin.php";
?>

<h2>📄 Liste des fiches d’adhésion AJEFEM Disponibles</h2>

<?php if ($success): ?>
    <div class="alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>


<!-- ⭐ BARRE DE RECHERCHE -->
<form method="GET" style="margin-top:20px; margin-bottom:20px;">
    <input 
        type="text" 
        name="search" 
        placeholder="🔍 Rechercher un membre..." 
        value="<?= htmlspecialchars($search) ?>"
        style="padding:10px; width:260px; border-radius:6px; border:1px solid #bbb;">
    <button style="padding:10px 15px; border-radius:6px; background:#005bbb; color:white; border:none;">
        Rechercher
    </button>
</form>




<style>
.table-wrapper {
    margin-top: 20px;
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.admin-table th {
    background: linear-gradient(90deg,#1e90ff,#005bbb);
    color: white;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

.admin-table td {
    padding: 12px;
    font-size: 14px;
    border-bottom: 1px solid #eee;
}

.admin-table tr:hover {
    background: #f9f9f9;
}

.photo-mini {
    width: 45px;
    height: 45px;
    border-radius: 6px;
    object-fit: cover;
    border: 1px solid #ddd;
}

.btn-action {
    padding: 6px 10px;
    font-size: 13px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    margin-right: 5px;
}

.btn-print {
    background: #27ae60;
    color: white;
}

.btn-print:hover {
    opacity: .85;
}

.no-data {
    padding: 20px;
    text-align: center;
    background: #fff3cd;
    color: #795c00;
    border-left: 4px solid #ffca2c;
    margin-top: 20px;
}

.pagination {
    margin-top:20px;
    text-align:center;
}

.pagination a {
    padding:8px 14px;
    margin:0 5px;
    background:#005bbb;
    color:white;
    text-decoration:none;
    border-radius:5px;
}

.pagination a.disabled {
    background:#ccc;
    pointer-events:none;
}

</style>



<div class="table-wrapper">

<?php if (count($membres) == 0): ?>

    <div class="no-data">Aucun membre trouvé.</div>

<?php else: ?>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Code</th>
        <th>Nom complet</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Sexe</th>
        <th>Adresse</th>
        <th>Rôle</th>
        <th>Action</th>
    </tr>

    <?php foreach ($membres as $m): ?>
    <tr>
        <td><?= $m["id"] ?></td>

        <td>
            <?php if ($m["photo"]): ?>
                <img src="uploads/membres/<?= $m["photo"] ?>" class="photo-mini">
            <?php else: ?>
                <span style="color:#aaa;">Aucune</span>
            <?php endif; ?>
        </td>

        <td><?= htmlspecialchars($m["code_membre"]) ?></td>
        <td><?= htmlspecialchars($m["name"]) ?></td>
        <td><?= htmlspecialchars($m["email"]) ?></td>
        <td><?= htmlspecialchars($m["phone"]) ?></td>
        <td><?= htmlspecialchars($m["sex"]) ?></td>
        <td><?= htmlspecialchars($m["address"]) ?></td>
        <td><?= htmlspecialchars($m["role"]) ?></td>

        <td>
            <a class="btn-action btn-print"
               href="imprimer_fiche.php?id=<?= $m["id"] ?>"
               target="_blank">
               🖨️ Fiche d’adhésion
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>

</div>



<!-- ⭐ PAGINATION -->
<div class="pagination">
    <!-- Bouton précédent -->
    <a 
       href="?page=<?= $page-1 ?>&search=<?= urlencode($search) ?>"
       class="<?= ($page <= 1 ? 'disabled' : '') ?>">
       ⬅️ Précédent
    </a>

    <!-- Bouton suivant -->
    <a 
       href="?page=<?= $page+1 ?>&search=<?= urlencode($search) ?>"
       class="<?= ($page >= $totalPages ? 'disabled' : '') ?>">
       Suivant ➡️
    </a>
</div>


<?php include "footer_admin.php"; ?>
