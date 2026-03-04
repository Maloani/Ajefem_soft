<?php
// =========================================================
//   points_focaux.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Messages
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

// Pagination
$limit  = 5;
$page   = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

// Recherche
$search = trim($_GET["search"] ?? "");

// Condition de recherche
$where = "WHERE 1";
if ($search !== "") {
    $s = "%$search%";
    $where .= " AND (name LIKE '$s' OR phone LIKE '$s' OR province LIKE '$s')";
}

// Récupération données
$sql = "SELECT * FROM points_focaux $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
$points = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Total pour pagination
$total_sql = "SELECT COUNT(*) FROM points_focaux $where";
$total_rows = $pdo->query($total_sql)->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// Ajout d’un point focal
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["name"]);
    $phone    = trim($_POST["phone"]);
    $sexe     = trim($_POST["sexe"]);
    $province = trim($_POST["province"]);
    $adresse  = trim($_POST["adresse"]);

    if ($name=="" || $phone=="" || $sexe=="" || $province=="" || $adresse=="") {
        header("Location: points_focaux.php?error=" . urlencode("Veuillez remplir tous les champs."));
        exit();
    }

    try {
        $stmt = $pdo->prepare("
            INSERT INTO points_focaux (name, phone, sexe, province, adresse)
            VALUES (:name, :phone, :sexe, :province, :adresse)
        ");
        $stmt->execute([
            ":name"     => $name,
            ":phone"    => $phone,
            ":sexe"     => $sexe,
            ":province" => $province,
            ":adresse"  => $adresse
        ]);

        header("Location: points_focaux.php?success=" . urlencode("Point Focal ajouté avec succès !"));
        exit();

    } catch(Exception $e){
        header("Location: points_focaux.php?error=" . urlencode("Erreur lors de l'enregistrement."));
        exit();
    }
}

include "header_admin.php";
?>

<h2>📍 Gestion des Points Focaux Provinciaux</h2>

<?php if($success): ?><div class="alert-success"><?= $success ?></div><?php endif; ?>
<?php if($error): ?><div class="alert-error"><?= $error ?></div><?php endif; ?>


<style>
.form-box {
    max-width:650px;background:#fff;margin:auto;padding:25px;border-radius:12px;
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
}
.input-group { margin-bottom:15px; }
.input-group label { font-weight:bold;color:#0b3d91;margin-bottom:5px;display:block; }
.input-group input, select {
    width:100%;padding:12px;border:1px solid #ccc;border-radius:6px;
}
.btn-submit {
    width:100%;padding:14px;background:#0b3d91;color:white;border:none;
    border-radius:6px;font-size:17px;font-weight:bold;cursor:pointer;
}
.btn-submit:hover { background:#072f6b; }

table { width:100%;border-collapse:collapse;margin-top:30px; }
table th,td { border:1px solid #ddd;padding:10px;text-align:center; }
table th { background:#0b3d91;color:white; }

.action-btn {
    padding:6px 12px;border-radius:6px;color:white;text-decoration:none;
    font-size:14px;margin:2px;display:inline-block;
}
.btn-edit { background:#f1c40f; }
.btn-delete { background:#e74c3c; }

.search-box { text-align:right;margin-top:20px; }
.search-box input { padding:8px;border-radius:6px;border:1px solid #aaa; }
.pagination { text-align:center;margin-top:20px; }
.pagination a {
    padding:8px 12px;background:#0b3d91;color:white;border-radius:4px;
    text-decoration:none;margin:4px;
}
</style>


<div class="form-box">

<form method="POST">

    <h3>➕ Ajouter un Point Focal</h3><br>

    <div class="input-group">
        <label>Nom complet *</label>
        <input type="text" name="name" required>
    </div>

    <div class="input-group">
        <label>Téléphone *</label>
        <input type="text" name="phone" required>
    </div>

    <div class="input-group">
        <label>Sexe *</label>
        <select name="sexe" required>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
        </select>
    </div>

    <div class="input-group">
        <label>Province *</label>
        <input type="text" name="province" required>
    </div>

    <div class="input-group">
        <label>Adresse *</label>
        <input type="text" name="adresse" required>
    </div>

    <button class="btn-submit">Enregistrer</button>

</form>
</div>


<!-- 🔍 Recherche -->
<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Rechercher..." value="<?= htmlspecialchars($search) ?>">
        <button class="btn-submit" style="width:auto;">🔍</button>
    </form>
</div>


<h3>📋 Liste des Points Focaux</h3>

<table>
<tr>
    <th>Nom</th>
    <th>Téléphone</th>
    <th>Sexe</th>
    <th>Province</th>
    <th>Adresse</th>
    <th>Actions</th>
</tr>

<?php foreach($points as $p): ?>
<tr>
    <td><?= htmlspecialchars($p["name"]) ?></td>
    <td><?= htmlspecialchars($p["phone"]) ?></td>
    <td><?= htmlspecialchars($p["sexe"]) ?></td>
    <td><?= htmlspecialchars($p["province"]) ?></td>
    <td><?= htmlspecialchars($p["adresse"]) ?></td>
    <td>
        <a class="action-btn btn-edit" href="modifier_point_focal.php?id=<?= $p['id'] ?>">✏</a>
        <a class="action-btn btn-delete" 
           onclick="return confirm('Supprimer définitivement ce Point Focal ?')"
           href="supprimer_point_focal.php?id=<?= $p['id'] ?>">🗑</a>
    </td>
</tr>
<?php endforeach; ?>

</table>


<!-- PAGINATION -->
<div class="pagination">

<?php if($page > 1): ?>
    <a href="?page=<?= $page - 1 ?>&search=<?= $search ?>">⬅ Précédent</a>
<?php endif; ?>

<?php if($page < $total_pages): ?>
    <a href="?page=<?= $page + 1 ?>&search=<?= $search ?>">Suivant ➡</a>
<?php endif; ?>

</div>


<?php include "footer_admin.php"; ?>
