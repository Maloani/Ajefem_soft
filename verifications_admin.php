<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}


require_once "config.php"; // adapter si besoin

// Filtres
$where = [];
$params = [];

if (!empty($_GET["code_membre"])) {
    $where[] = "code_membre LIKE :code";
    $params[":code"] = "%".$_GET["code_membre"]."%";
}

if (!empty($_GET["statut"])) {
    $where[] = "statut = :statut";
    $params[":statut"] = $_GET["statut"];
}

if (!empty($_GET["date_debut"]) && !empty($_GET["date_fin"])) {
    $where[] = "DATE(created_at) BETWEEN :d1 AND :d2";
    $params[":d1"] = $_GET["date_debut"];
    $params[":d2"] = $_GET["date_fin"];
}

$sql = "SELECT v.*, m.name 
        FROM ajefem_verifications v
        LEFT JOIN membres_ajefem m
        ON v.code_membre = m.code_membre";

if ($where) {
    $sql .= " WHERE ".implode(" AND ", $where);
}

$sql .= " ORDER BY v.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$verifs = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ===== STATISTIQUES =====

// Nombre total scans
$total_scans = $pdo->query("SELECT COUNT(*) FROM ajefem_verifications")->fetchColumn();

// Scans valides
$total_ok = $pdo->query("SELECT COUNT(*) FROM ajefem_verifications WHERE statut='SUCCESS'")->fetchColumn();

// Scans invalides
$total_fail = $pdo->query("SELECT COUNT(*) FROM ajefem_verifications WHERE statut='FAILED'")->fetchColumn();

// Top cartes utilisées
$top_cards = $pdo->query("
    SELECT code_membre, COUNT(*) AS nb 
    FROM ajefem_verifications 
    GROUP BY code_membre 
    ORDER BY nb DESC 
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

// Pagination
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Compter le total filtré
$sql_count = "SELECT COUNT(*) FROM ajefem_verifications v 
              LEFT JOIN membres_ajefem m ON v.code_membre = m.code_membre";

if ($where) {
    $sql_count .= " WHERE ".implode(" AND ", $where);
}

$stmt_count = $pdo->prepare($sql_count);
$stmt_count->execute($params);
$total_rows = $stmt_count->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// Requête paginée
$sql .= " LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$verifs = $stmt->fetchAll(PDO::FETCH_ASSOC);


include "header_admin.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Logs Vérification | AJEFEM Admin</title>
<style>
body{
    font-family: Arial;
    background:#f4f6f9;
    padding:20px;
}
.container{
    width:95%;
    margin:auto;
}
h2{ color:#0b3d91; }
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    margin-top:15px;
}
th,td{
    padding:8px;
    border:1px solid #ccc;
    font-size:12px;
}
th{
    background:#0b3d91;
    color:white;
}
.ok{ color:green; font-weight:bold; }
.fail{ color:#c00; font-weight:bold; }
.card{
    background:#fff;
    padding:12px;
    border-radius:8px;
    margin-bottom:15px;
    box-shadow: 0 0 5px rgba(0,0,0,0.1);
}
.filter{
    background:#fff;
    padding:15px;
    border-radius:6px;
}
input, select{
    padding:5px;
    font-size:12px;
}
button{
    padding:7px 10px;
    background:#0b3d91;
    color:white;
    border:none;
    border-radius:4px;
    cursor:pointer;
}
</style>
</head>
<body>

<div class="container">

    <h2>📊 Journal de Vérification — AJEFEM</h2>

    <div class="card">
        <strong>Total Scans :</strong> <?= $total_scans ?> |
        <span class="ok">Valides : <?= $total_ok ?></span> |
        <span class="fail">Échecs : <?= $total_fail ?></span>
        <br><br>
        <strong>🔥 Top 5 cartes les plus vérifiées :</strong><br>
        <?php foreach($top_cards as $t): ?>
            ▸ <?= $t["code_membre"] ?> → <?= $t["nb"] ?> scans<br>
        <?php endforeach; ?>
    </div>

    <!-- 🔍 FILTRES -->
    <div class="filter">
        <form>
            Code membre:
            <input type="text" name="code_membre" placeholder="Ex: AJF123" value="<?= $_GET['code_membre'] ?? '' ?>">

            Statut:
            <select name="statut">
                <option value="">Tous</option>
                <option value="SUCCESS" <?php if(($_GET['statut'] ?? '')=='SUCCESS') echo 'selected'; ?>>SUCCESS</option>
                <option value="FAILED" <?php if(($_GET['statut'] ?? '')=='FAILED') echo 'selected'; ?>>FAILED</option>
            </select>

            Du:
            <input type="date" name="date_debut" value="<?= $_GET['date_debut'] ?? '' ?>">
            
            Au:
            <input type="date" name="date_fin" value="<?= $_GET['date_fin'] ?? '' ?>">

            <button type="submit">Filtrer</button>
        </form>
    </div>

    <table>
        <tr>
            <th>Code membre</th>
            <th>Nom membre</th>
            <th>Statut</th>
            <th>Adresse IP</th>
            <th>Device / Navigateur</th>
            <th>Date & Heure</th>
        </tr>

        <?php foreach($verifs as $v): ?>
        <tr>
            <td><?= $v["code_membre"] ?></td>
             <td><?= $v["name"] ?></td>
            <td class="<?= $v['statut']=='SUCCESS'?'ok':'fail' ?>">
                <?= $v["statut"] ?>
            </td>
            <td><?= $v["ip"] ?></td>
            <td><?= substr($v["user_agent"],0,35)."..." ?></td>
            <td><?= $v["created_at"] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
<!-- PAGINATION -->
<div style="margin-top:12px; text-align:center;">
    <?php if ($page > 1): ?>
        <a href="?<?= http_build_query(array_merge($_GET,['page'=>$page-1])) ?>" 
           style="padding:6px 14px; background:#0b3d91; color:white; text-decoration:none; border-radius:4px;">
            ⬅ Précédent
        </a>
    <?php endif; ?>

    <span style="padding:8px;">Page <?= $page ?> / <?= max(1,$total_pages) ?></span>

    <?php if ($page < $total_pages): ?>
        <a href="?<?= http_build_query(array_merge($_GET,['page'=>$page+1])) ?>" 
           style="padding:6px 14px; background:#0b3d91; color:white; text-decoration:none; border-radius:4px;">
            Suivant ➜
        </a>
    <?php endif; ?>
</div>

</div>

</body>
</html>
