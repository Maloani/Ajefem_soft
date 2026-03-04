<?php
// ================================================
//   liste_membres.php - AJEFEM (ADMIN ONLY)
// ================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérification ADMIN
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Messages
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

// Recherche
$search = trim($_GET['q'] ?? "");

// Pagination
$limit = 10;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

// Construction SQL
$where = "";
$params = [];

if ($search !== "") {
    $where = "WHERE name LIKE :q OR phone LIKE :q OR email LIKE :q OR code_membre LIKE :q";
    $params[':q'] = "%$search%";
}

// Total membres
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM membres_ajefem $where");
$countStmt->execute($params);
$total = $countStmt->fetchColumn();
$totalPages = ceil($total / $limit);

// Liste membres paginée
$sql = "SELECT * FROM membres_ajefem $where ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

foreach ($params as $k => $v) {
    $stmt->bindValue($k, $v, PDO::PARAM_STR);
}
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Header
include "header_admin.php";
?>

<h2>👥 Liste des Membres AJEFEM</h2>

<?php if ($success): ?>
<div class="alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($error): ?>
<div class="alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>


<form method="get" style="margin:15px 0; display:flex; gap:10px; align-items:center;">
    <input type="text" name="q" placeholder="Rechercher un membre..."
           value="<?= htmlspecialchars($search) ?>"
           style="padding:10px; width:260px; border-radius:5px; border:1px solid #ccc;">

    <button type="submit" class="btn-search">🔍 Rechercher</button>

    <!-- 🖨️ BOUTON PDF -->
    <a href="imprimer_membres_pdf.php?q=<?= urlencode($search) ?>"
       target="_blank"
       class="btn-pdf">
       🖨️ Imprimer PDF
    </a>
</form>

<style>
.btn-pdf {
    background:#2e7d32;
    color:white;
    padding:10px 16px;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
}
.btn-pdf:hover {
    opacity:0.85;
}

.table-wrapper {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background:#fff;
    border-radius: 8px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.admin-table th {
    background:linear-gradient(90deg, #0b3d91, #08306b);
    color:#fff;
    padding:12px;
    font-size:14px;
    text-align:left;
}

.admin-table td {
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

.admin-table tr:hover {
    background:#f5f7fa;
}

.mini-photo {
    width:50px;
    height:50px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid #0b3d91;
}

.btn-edit {
    background:#ff9800;
    color:white;
    padding:7px 12px;
    border-radius:5px;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
}

.btn-edit:hover { opacity:0.8; }

.btn-delete {
    background:#e53935;
    color:white;
    padding:7px 12px;
    border-radius:5px;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
}

.btn-delete:hover { opacity:0.85; }

.no-data {
    padding:20px;
    background:#fff3cd;
    border-left:4px solid #ffcc00;
    color:#6d5200;
    margin-top:20px;
    border-radius:5px;
}
.btn-search {
    background:#0b3d91;
    color:white;
    border:none;
    padding:10px 16px;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
}
.btn-search:hover { opacity:0.85; }

.pagination {
    display:flex;
    justify-content:center;
    margin:20px 0;
    gap:10px;
}
.pagination a {
    padding:8px 14px;
    background:#08306b;
    color:white;
    border-radius:5px;
    text-decoration:none;
    font-weight:bold;
}
.pagination a.disabled {
    background:#ccc;
    pointer-events:none;
}
.pagination a.active {
    background:#ff9800;
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
    <th>Nom</th>
    <th>Code</th>
    <th>Téléphone</th>
    <th>Email</th>
    <th>Sexe</th>
    <th>Adresse</th>
    <th>Rôle</th>
    <th>Action</th>
</tr>

<?php foreach ($membres as $m): ?>
<tr>
    <td><?= $m['id'] ?></td>
    <td>
        <img src="<?= $m['photo'] ? 'uploads/membres/'.htmlspecialchars($m['photo']) : 'img/user_default.png' ?>"
             class="mini-photo">
    </td>
    <td><?= htmlspecialchars($m['name']) ?></td>
    <td><strong><?= htmlspecialchars($m['code_membre']) ?></strong></td>
    <td><?= htmlspecialchars($m['phone']) ?></td>
    <td><?= htmlspecialchars($m['email']) ?></td>
    <td><?= htmlspecialchars($m['sex']) ?></td>
    <td><?= htmlspecialchars($m['address']) ?></td>
    <td><?= htmlspecialchars($m['role']) ?></td>
    <td>
        <a class="btn-edit" href="modifier_membre.php?id=<?= $m['id'] ?>">Modifier</a>
        <a class="btn-delete"
           href="supprimer_membre.php?id=<?= $m['id'] ?>"
           onclick="return confirm('Supprimer ce membre ?')">Supprimer</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<!-- ⏮️ PAGINATION -->
<div class="pagination">
    <a class="<?= $page <= 1 ? 'disabled' : '' ?>"
       href="?page=<?= $page - 1 ?>&q=<?= urlencode($search) ?>">⏮ Précédent</a>

    <a class="active"><?= $page ?> / <?= $totalPages ?></a>

    <a class="<?= $page >= $totalPages ? 'disabled' : '' ?>"
       href="?page=<?= $page + 1 ?>&q=<?= urlencode($search) ?>">Suivant ⏭</a>
</div>

<?php endif; ?>
</div>

<?php include "footer_admin.php"; ?>
