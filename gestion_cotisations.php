<?php
// =========================================================
//   gestion_cotisations.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
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
$limit = 5;
$page = isset($_GET["page"]) ? intval($_GET["page"]) : 1;
$offset = ($page - 1) * $limit;

// Recherche
$search = isset($_GET['search']) ? trim($_GET['search']) : "";

// Récupération des membres pour le formulaire
$stmt = $pdo->query("SELECT code_membre, name FROM membres_ajefem ORDER BY name ASC");
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement ajout cotisation
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code_membre   = trim($_POST["code_membre"]);
    $montant       = trim($_POST["montant"]);
    $date_paiement = trim($_POST["date_paiement"]);
    $mode_paiement = trim($_POST["mode_paiement"]);
    $commentaire   = trim($_POST["commentaire"]);
    $admin_name    = $_SESSION["username"] ?? "admin";

    if ($code_membre == "" || $montant == "" || $date_paiement == "") {
        header("Location: gestion_cotisations.php?error=" . urlencode("Veuillez remplir tous les champs obligatoires."));
        exit();
    }

    $insert = $pdo->prepare("
        INSERT INTO cotisations_ajefem (code_membre, montant, date_paiement, mode_paiement, commentaire, enregistré_par)
        VALUES (:cm, :m, :dp, :mp, :c, :admin)
    ");
    $insert->execute([
        ":cm" => $code_membre,
        ":m"  => $montant,
        ":dp" => $date_paiement,
        ":mp" => $mode_paiement,
        ":c"  => $commentaire,
        ":admin" => $admin_name
    ]);

    header("Location: gestion_cotisations.php?success=" . urlencode("Cotisation enregistrée avec succès !"));
    exit();
}

include "header_admin.php";
?>

<h2>💰 Gestion des Cotisations</h2>

<?php if($success): ?><div class="alert-success"><?= $success ?></div><?php endif; ?>
<?php if($error): ?><div class="alert-error"><?= $error ?></div><?php endif; ?>

<style>
table {
    width:100%;border-collapse:collapse;margin-top:25px;
}
table th, td {
    border:1px solid #ddd;padding:10px;text-align:center;
}
table th {background:#0b3d91;color:#fff;}
.action-btn {
    padding:6px 10px;border-radius:5px;font-size:14px;text-decoration:none;color:white;margin:2px;display:inline-block;
}
.btn-edit { background:#f1c40f; }
.btn-delete { background:#e74c3c; }
.btn-print { background:#27ae60; }
.pagination { text-align:center;margin-top:20px; }
.pagination a {
    padding:8px 12px;background:#0b3d91;color:white;text-decoration:none;border-radius:4px;margin:0 5px;
}
.search-box { margin-top:20px;text-align:right; }
.search-box input { padding:8px;border-radius:6px;border:1px solid #ccc; }
</style>
<style>
.form-box {
    max-width:650px;
    background:white;
    margin:auto;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.input-group { margin-bottom:15px; }
.input-group label {
    font-weight:bold;
    display:block;
    margin-bottom:5px;
    color:#0b3d91;
}
.input-group input,
.input-group select,
textarea {
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
}
.btn-submit {
    width:100%; 
    padding:14px;
    background:#0b3d91;
    border:none;
    color:white;
    font-size:17px;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}
.btn-submit:hover { background:#072f6b; }
.alert-success {
    background:#c8f7c5;padding:10px;border-left:4px solid #2ecc71;
    color:#145a21;margin-bottom:15px;border-radius:6px;
}
.alert-error {
    background:#f7c5c5;padding:10px;border-left:4px solid #e74c3c;
    color:#7b0000;margin-bottom:15px;border-radius:6px;
}
</style>
<div class="form-box">
<form method="POST">
    <div class="input-group">
        <label>Membre *</label>
        <select name="code_membre" required>
            <option value="">-- Sélectionnez --</option>
            <?php foreach($membres as $m): ?>
                <option value="<?= $m['code_membre']; ?>"><?= $m['name']; ?> (<?= $m['code_membre']; ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group"><label>Montant (USD) *</label><input type="number" step="0.01" name="montant" required></div>
    <div class="input-group"><label>Date de paiement *</label><input type="date" name="date_paiement" required></div>

    <div class="input-group">
        <label>Mode</label>
        <select name="mode_paiement">
            <option>Cash</option><option>Mobile Money</option><option>Virement Bancaire</option>
        </select>
    </div>

    <div class="input-group"><label>Commentaire</label><textarea name="commentaire" rows="3"></textarea></div>

    <button class="btn-submit">Enregistrer</button>
</form>
</div>


<!-- 🔍 Barre Recherche -->
<div class="search-box">
    <form method="GET">
        <input type="text" name="search" placeholder="Recherche..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit" class="btn-submit" style="width:auto;padding:8px 15px;">Rechercher</button>
    </form>
</div>


<?php
// 📌 Affichage des cotisations avec filtre + pagination
$where = $search ? "WHERE c.code_membre LIKE '%$search%' OR m.name LIKE '%$search%'" : "";

$sql = "
    SELECT c.*, m.name
    FROM cotisations_ajefem c
    JOIN membres_ajefem m ON m.code_membre = c.code_membre
    $where
    ORDER BY c.id_cotisation DESC
    LIMIT $limit OFFSET $offset
";

$data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Nombre total pour pagination
$total_sql = "SELECT COUNT(*) FROM cotisations_ajefem c JOIN membres_ajefem m ON m.code_membre=c.code_membre $where";
$total = $pdo->query($total_sql)->fetchColumn();
$total_pages = ceil($total / $limit);
?>


<h3>📋 Liste des Cotisations</h3>
<table>
<tr>
    <th>Membre</th><th>Montant</th><th>Date</th><th>Mode</th><th>Enregistré par</th><th>Actions</th>
</tr>

<?php foreach($data as $row): ?>
<tr>
    <td><?= $row['name']; ?> (<?= $row['code_membre']; ?>)</td>
    <td><?= $row['montant']; ?> $</td>
    <td><?= $row['date_paiement']; ?></td>
    <td><?= $row['mode_paiement']; ?></td>
    <td><?= $row['enregistré_par']; ?></td>
    <td>
        <a class="action-btn btn-edit" href="modifier_cotisation.php?id=<?= $row['id_cotisation']; ?>">✏</a>
        <a class="action-btn btn-delete" onclick="return confirm('Supprimer ?')" href="supprimer_cotisation.php?id=<?= $row['id_cotisation']; ?>">❌</a>
        <a class="action-btn btn-print" href="imprimer_cotisation.php?id=<?= $row['id_cotisation']; ?>" target="_blank">🖨</a>
    </td>
</tr>
<?php endforeach; ?>

</table>


<!-- 📌 Pagination -->
<div class="pagination">
<?php if($page > 1): ?>
    <a href="?page=<?= $page-1 ?>&search=<?= $search ?>">⬅ Précédent</a>
<?php endif; ?>

<?php if($page < $total_pages): ?>
    <a href="?page=<?= $page+1 ?>&search=<?= $search ?>">Suivant ➡</a>
<?php endif; ?>
</div>


<?php include "footer_admin.php"; ?>
