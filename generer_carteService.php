<?php
// ====================================
//  liste_membres.php  - AJEFEM ADMIN
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

// ----- PAGINATION -----
$limit = 5;
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

// ----- RECHERCHE -----
$search = $_GET["search"] ?? "";

$clause = "";
$params = [];

if (!empty($search)) {
    $clause = "WHERE name LIKE :s OR email LIKE :s OR phone LIKE :s OR code_membre LIKE :s";
    $params[":s"] = "%$search%";
}

// ----- TOTAL POUR PAGINATION -----
$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM membres_ajefem $clause");
$stmtTotal->execute($params);
$totalRows = $stmtTotal->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// ----- RÉCUPÉRATION DES MEMBRES -----
$sql = "SELECT * FROM membres_ajefem $clause ORDER BY id DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Header admin
include "header_admin.php";
?>

<h2>👥 Liste des membres AJEFEM éligibles pour la carte de service</h2>

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
        value="<?= htmlspecialchars($search) ?>" 
        placeholder="🔍 Rechercher nom, email, téléphone, code..."
        style="padding:10px; width:260px; border-radius:6px; border:1px solid #bbb;">
    <button style="padding:10px 15px; border-radius:6px; background:#e67e22; color:white; border:none;">
        Rechercher
    </button>
</form>


<style>
.table-wrapper {
    margin-top: 20px;
    overflow-x:auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    background:#fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.admin-table th {
    background: linear-gradient(90deg,#ff9800,#ff5722);
    color: white;
    padding: 12px;
    text-align: left;
    font-size: 14px;
}

.admin-table td {
    padding: 12px;
    font-size: 14px;
    border-bottom:1px solid #eee;
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
    padding:6px 10px;
    font-size:13px;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
    margin-right:5px;
}

.btn-card { background:#27ae60; color:white; }
.btn-card:hover { opacity: .85; }

.no-data {
    padding:20px;
    text-align:center;
    background:#fff3cd;
    color:#795c00;
    border-left:4px solid #ffca2c;
    margin-top:20px;
}

.pagination {
    margin-top: 20px;
    text-align:center;
}

.pagination a {
    padding:8px 14px;
    margin:0 5px;
    background:#ff5722;
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
            <a class="btn-action btn-card"
               href="generer_carte_membre_service.php?id=<?= $m["id"] ?>"
               target="_blank">
               Carte AJEFEM
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>

<?php endif; ?>
</div>


<!-- ⭐ PAGINATION -->
<div class="pagination">
    <a class="<?= ($page <= 1 ? 'disabled' : '') ?>"
       href="?page=<?= $page-1 ?>&search=<?= urlencode($search) ?>">
       ⬅️ Précédent
    </a>

    <a class="<?= ($page >= $totalPages ? 'disabled' : '') ?>"
       href="?page=<?= $page+1 ?>&search=<?= urlencode($search) ?>">
       Suivant ➡️
    </a>
</div>


<?php include "footer_admin.php"; ?>
