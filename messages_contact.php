<?php
// ================================================
//   messages_contact.php - AJEFEM (ADMIN ONLY)
// ================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Vérification ADMIN
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

/* --- CONNEXION BD --- */
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=jfm_ajefemdb;charset=utf8",
        "jfm",
        'LAFCp8&t6jCZY84h'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur DB : " . $e->getMessage());
}

/* --- SUPPRESSION MESSAGE ---- */
if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);
    $delete = $pdo->prepare("DELETE FROM contact_messages WHERE id = :id");
    $delete->execute([":id" => $id]);
    header("Location: messages_contact.php?success=deleted");
    exit();
}


/* --- RECHERCHE --- */
$search = $_GET["search"] ?? "";

$clause = "";
$params = [];

if (!empty($search)) {
    $clause = "WHERE nom LIKE :s OR email LIKE :s OR phone LIKE :s OR message LIKE :s";
    $params[":s"] = "%$search%";
}


/* --- PAGINATION (5 par page) --- */
$limit = 5;
$page  = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

$stmtTotal = $pdo->prepare("SELECT COUNT(*) FROM contact_messages $clause");
$stmtTotal->execute($params);
$totalRows = $stmtTotal->fetchColumn();

$totalPages = ceil($totalRows / $limit);


/* --- RÉCUPÉRATION MESSAGES --- */
$sql = "SELECT * FROM contact_messages 
        $clause 
        ORDER BY date_message DESC 
        LIMIT $limit OFFSET $offset";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Header admin + sidebar
include "header_admin.php";
?>

<h2>📨 Messages de Contact</h2>

<?php if (isset($_GET["success"])): ?>
    <div style="background:#c8f7c5;padding:10px;border-left:4px solid #2ecc71;color:#145a21;margin-bottom:15px;">
        Message supprimé avec succès.
    </div>
<?php endif; ?>


<!-- ⭐ BARRE DE RECHERCHE -->
<form method="GET" style="margin-top:20px; margin-bottom:20px;">
    <input 
        type="text"
        name="search"
        value="<?= htmlspecialchars($search) ?>"
        placeholder="🔍 Rechercher nom, email, téléphone, contenu..."
        style="padding:10px; width:260px; border:1px solid #bbb; border-radius:6px;">
    <button style="padding:10px 15px; border-radius:6px; background:#ff5722; color:white; border:none;">
        Rechercher
    </button>
</form>


<style>
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
    background:linear-gradient(90deg, #ff9800, #ff5722);
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
    background:#f9f9f9;
}

.btn-delete {
    background:#e53935;
    color:white;
    padding:7px 12px;
    border-radius:5px;
    text-decoration:none;
    font-size:13px;
    font-weight:bold;
}

.btn-delete:hover {
    opacity:0.85;
}

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

<?php if (count($messages) == 0): ?>
    <div class="no-data">Aucun message trouvé.</div>
<?php else: ?>

<table class="admin-table">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Message</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php foreach ($messages as $m): ?>
    <tr>
        <td><?= $m["id"] ?></td>
        <td><?= htmlspecialchars($m["nom"]) ?></td>
        <td><?= htmlspecialchars($m["email"]) ?></td>
        <td><?= htmlspecialchars($m["phone"]) ?></td>
        <td><?= nl2br(htmlspecialchars($m["message"])) ?></td>
        <td><?= $m["date_message"] ?></td>
        <td>
            <a class="btn-delete"
               href="messages_contact.php?delete=<?= $m["id"] ?>"
               onclick="return confirm('Voulez-vous vraiment supprimer ce message ?')">
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
