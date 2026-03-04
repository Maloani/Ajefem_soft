<?php
// ================================================
//   liste_membresonline.php - AJEFEM (ADMIN ONLY)
// ================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérification : ADMIN uniquement
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

/* --- CONNEXION BD --- */
require_once "config.php";

/* --- SUPPRESSION D'UNE DEMANDE --- */
if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);

    $del = $pdo->prepare("DELETE FROM adhesions_requets WHERE id = :id");
    $del->execute([":id" => $id]);

    header("Location: liste_membresonline.php?success=deleted");
    exit();
}


/* ----- RECHERCHE ----- */
$search = $_GET["search"] ?? "";

$where = "";
$params = [];

if (!empty($search)) {
    $where = "WHERE name LIKE :s OR email LIKE :s OR phone LIKE :s OR profession LIKE :s OR message LIKE :s";
    $params[":s"] = "%$search%";
}


/* ----- PAGINATION ----- */
$limit = 5; // 5 demandes par page
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

/* Calcul total */
$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM adhesions_requets $where");
$stmtTotal->execute($params);
$totalRows = $stmtTotal->fetchColumn();

$totalPages = ceil($totalRows / $limit);

/* Récupération paginée */
$sql = "SELECT * FROM adhesions_requets 
        $where 
        ORDER BY created_at DESC 
        LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$adhesions = $stmt->fetchAll(PDO::FETCH_ASSOC);


/* --- HEADER ADMIN + SIDEBAR --- */
include "header_admin.php";
?>

<h2>👥 Liste des demandes d’Adhésions AJEFEM</h2>

<?php if (isset($_GET["success"])): ?>
    <div style="background:#c8f7c5;padding:10px;border-left:4px solid #2ecc71;color:#145a21;margin-bottom:15px;">
        Adhésion supprimée avec succès.
    </div>
<?php endif; ?>


<!-- ⭐ BARRE DE RECHERCHE -->
<form method="GET" style="margin-top:20px; margin-bottom:20px;">
    <input 
        type="text"
        name="search"
        value="<?= htmlspecialchars($search) ?>"
        placeholder="🔍 Rechercher par nom, email, téléphone, profession..."
        style="padding:10px; width:270px; border-radius:6px; border:1px solid #bbb;">
    <button style="padding:10px 15px; background:#08306b; color:white; border-radius:6px; border:none;">
        Rechercher
    </button>
</form>


<style>
.table-wrapper { overflow-x:auto; }

.admin-table {
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    background:white;
    border-radius:8px;
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

.admin-table tr:hover { background:#f9f9f9; }

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

.pagination {
    margin-top:20px;
    text-align:center;
}

.pagination a {
    padding:8px 14px;
    margin:0 5px;
    background:#08306b;
    color:white;
    border-radius:5px;
    text-decoration:none;
}

.pagination a.disabled {
    background:#ccc;
    pointer-events:none;
}
</style>


<div class="table-wrapper">

<?php if (count($adhesions) == 0): ?>

    <div class="no-data">Aucune demande d’adhésion trouvée.</div>

<?php else: ?>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Nom complet</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Sexe</th>
        <th>Adresse</th>
        <th>Profession</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php foreach ($adhesions as $m): ?>
    <tr>
        <td><?= $m["id"] ?></td>
        <td><?= htmlspecialchars($m["name"]) ?></td>
        <td><?= htmlspecialchars($m["email"]) ?></td>
        <td><?= htmlspecialchars($m["phone"]) ?></td>
        <td><?= htmlspecialchars($m["sex"]) ?></td>
        <td><?= htmlspecialchars($m["address"]) ?></td>
        <td><?= htmlspecialchars($m["profession"]) ?></td>
        <td><?= nl2br(htmlspecialchars($m["message"])) ?></td>
        <td><?= $m["created_at"] ?></td>

        <td>
            <a class="btn-delete"
               href="liste_membresonline.php?delete=<?= $m["id"] ?>"
               onclick="return confirm('Voulez-vous vraiment supprimer cette adhésion ?')">
               Supprimer
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
