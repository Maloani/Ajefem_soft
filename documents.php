<?php
// ================================================
//   documents.php - AJEFEM (Gestion avancée)
// ================================================
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Messages alert
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";


/* ============================================================
   1. ENREGISTREMENT D’UN DOCUMENT
   ============================================================ */
if (isset($_POST["upload"])) {

    $titre     = trim($_POST["titre"]);
    $service   = $_POST["service"];
    $categorie = $_POST["categorie"];

    if (empty($titre)) {
        header("Location: documents.php?error=Titre obligatoire.");
        exit();
    }

    if (!isset($_FILES["doc"]) || $_FILES["doc"]["error"] != 0) {
        header("Location: documents.php?error=Fichier manquant.");
        exit();
    }

    // PATH UPLOAD
    $upload_dir = "uploads/documents/";
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    $file_name = time() . "_" . basename($_FILES["doc"]["name"]);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES["doc"]["tmp_name"], $target_file)) {

        $type_doc = pathinfo($file_name, PATHINFO_EXTENSION);

        $insert = $pdo->prepare("
            INSERT INTO documents (titre, filename, type_doc, service, categorie)
            VALUES (:titre, :filename, :type_doc, :service, :categorie)
        ");
        $insert->execute([
            ":titre"     => $titre,
            ":filename"  => $file_name,
            ":type_doc"  => $type_doc,
            ":service"   => $service,
            ":categorie" => $categorie
        ]);

        header("Location: documents.php?success=Document ajouté !");
        exit();

    } else {
        header("Location: documents.php?error=Erreur d’upload.");
        exit();
    }
}


/* ============================================================
   2. SUPPRESSION DOCUMENT
   ============================================================ */
if (isset($_GET["delete"])) {
    $id = intval($_GET["delete"]);

    $get = $pdo->prepare("SELECT filename FROM documents WHERE id = :id");
    $get->execute([":id" => $id]);
    $file = $get->fetchColumn();

    if ($file && file_exists("uploads/documents/".$file)) {
        unlink("uploads/documents/".$file);
    }

    $del = $pdo->prepare("DELETE FROM documents WHERE id = :id");
    $del->execute([":id" => $id]);

    header("Location: documents.php?success=Document supprimé.");
    exit();
}


/* ============================================================
   3. RECHERCHE & FILTRES
   ============================================================ */
$search    = $_GET["search"] ?? "";
$filtre_service   = $_GET["service"] ?? "";
$filtre_categorie = $_GET["categorie"] ?? "";

$where  = "WHERE 1 ";
$params = [];

if (!empty($search)) {
    $where .= "AND titre LIKE :s ";
    $params[":s"] = "%$search%";
}

if (!empty($filtre_service)) {
    $where .= "AND service = :srv ";
    $params[":srv"] = $filtre_service;
}

if (!empty($filtre_categorie)) {
    $where .= "AND categorie = :cat ";
    $params[":cat"] = $filtre_categorie;
}


/* ============================================================
   4. RÉCUPÉRATION DOCUMENTS
   ============================================================ */
$stmt = $pdo->prepare("SELECT * FROM documents $where ORDER BY created_at DESC");
$stmt->execute($params);
$docs = $stmt->fetchAll(PDO::FETCH_ASSOC);


// HEADER ADMIN
include "header_admin.php";
?>

<h2>📂 Gestion avancée des documents AJEFEM</h2>

<?php if ($success): ?>
<div style="background:#d4edda;color:#155724;padding:10px;border-left:4px solid #28a745;margin-bottom:15px;">
    <?= htmlspecialchars($success) ?>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div style="background:#f8d7da;color:#721c24;padding:10px;border-left:4px solid #c82333;margin-bottom:15px;">
    <?= htmlspecialchars($error) ?>
</div>
<?php endif; ?>


<style>
.upload-box {
    background:white;
    padding:20px;
    border-radius:8px;
    border:1px solid #ddd;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.table-wrapper { margin-top: 15px; overflow-x:auto; }

.admin-table {
    width:100%; border-collapse:collapse; background:white;
    border-radius:8px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.admin-table th {
    background:linear-gradient(90deg,#0b3d91,#08306b);
    color:white; padding:12px; text-align:left; font-size:14px;
}

.admin-table td {
    padding:12px; border-bottom:1px solid #eee;
}

.btn-view { background:#007bff;color:white;padding:7px 12px;border-radius:5px;text-decoration:none;font-size:13px; }
.btn-download { background:#1e90ff;color:white;padding:7px 12px;border-radius:5px;text-decoration:none;font-size:13px; }
.btn-delete { background:#e53935;color:white;padding:7px 12px;border-radius:5px;text-decoration:none;font-size:13px; }

.filter-box { padding:15px; background:white; border-radius:8px; border:1px solid #ddd; margin-bottom:20px; }
</style>


<!-- ============================================================
     FORMULAIRE UPLOAD
     ============================================================ -->
<div class="upload-box">
    <h3>➕ Ajouter un document</h3>

    <form method="POST" enctype="multipart/form-data">

        <label>Titre :</label><br>
        <input type="text" name="titre" required style="padding:8px;width:300px;"><br><br>

        <label>Service :</label><br>
        <select name="service" required style="padding:8px;width:300px;">
            <option value="">-- Choisir --</option>
            <option>RH</option>
            <option>Finance</option>
            <option>Projets</option>
            <option>Administration</option>
            <option>Communication</option>
            <option>Juridique</option>
            <option>Autres</option>
        </select><br><br>

        <label>Catégorie :</label><br>
        <select name="categorie" required style="padding:8px;width:300px;">
            <option value="">-- Choisir --</option>
            <option>Rapports</option>
            <option>Statuts</option>
            <option>Procès-verbaux</option>
            <option>Budgets</option>
            <option>Plans stratégiques</option>
            <option>Correspondances</option>
            <option>Contrats</option>
            <option>Archives</option>
        </select><br><br>

        <label>Fichier :</label><br>
        <input type="file" name="doc" required><br><br>

        <button type="submit" name="upload"
                style="padding:10px 20px;background:#08306b;color:white;border:none;border-radius:6px;">
            📤 Enregistrer
        </button>
    </form>
</div>


<!-- ============================================================
     RECHERCHE + FILTRES
     ============================================================ -->
<div class="filter-box">

    <h3>🔍 Recherche & Filtres</h3>

    <form method="GET">

        <input 
            type="text"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
            placeholder="Rechercher un document..."
            style="padding:8px;width:250px;">

        <select name="service" style="padding:8px;width:200px;">
            <option value="">Service...</option>
            <option <?= $filtre_service=="RH"?"selected":"" ?>>RH</option>
            <option <?= $filtre_service=="Finance"?"selected":"" ?>>Finance</option>
            <option <?= $filtre_service=="Projets"?"selected":"" ?>>Projets</option>
            <option <?= $filtre_service=="Administration"?"selected":"" ?>>Administration</option>
            <option <?= $filtre_service=="Communication"?"selected":"" ?>>Communication</option>
            <option <?= $filtre_service=="Juridique"?"selected":"" ?>>Juridique</option>
            <option <?= $filtre_service=="Autres"?"selected":"" ?>>Autres</option>
        </select>

        <select name="categorie" style="padding:8px;width:200px;">
            <option value="">Catégorie...</option>
            <option <?= $filtre_categorie=="Rapports"?"selected":"" ?>>Rapports</option>
            <option <?= $filtre_categorie=="Statuts"?"selected":"" ?>>Statuts</option>
            <option <?= $filtre_categorie=="Procès-verbaux"?"selected":"" ?>>Procès-verbaux</option>
            <option <?= $filtre_categorie=="Budgets"?"selected":"" ?>>Budgets</option>
            <option <?= $filtre_categorie=="Plans stratégiques"?"selected":"" ?>>Plans stratégiques</option>
            <option <?= $filtre_categorie=="Correspondances"?"selected":"" ?>>Correspondances</option>
            <option <?= $filtre_categorie=="Contrats"?"selected":"" ?>>Contrats</option>
            <option <?= $filtre_categorie=="Archives"?"selected":"" ?>>Archives</option>
        </select>

        <button style="padding:8px 15px;background:#0b3d91;color:white;border:none;border-radius:5px;">
            Filtrer
        </button>

    </form>
</div>


<!-- ============================================================
     LISTE DOCUMENTS AVEC LECTEUR PDF INTÉGRÉ
     ============================================================ -->
<!-- ============================================================
     LISTE DOCUMENTS MODERNE + PAGINATION + COPIE DE LIEN
============================================================ -->

<?php
/* PAGINATION */
$docsPerPage = 5;

$totalDocsStmt = $pdo->prepare("SELECT COUNT(*) FROM documents $where");
$totalDocsStmt->execute($params);
$totalDocs = $totalDocsStmt->fetchColumn();

$totalPages = max(1, ceil($totalDocs / $docsPerPage));
$page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
$offset = ($page - 1) * $docsPerPage;

/* NOUVELLE REQUÊTE AVEC LIMIT (CORRECTIF SQL) */
$sql = "SELECT * FROM documents $where ORDER BY created_at DESC LIMIT :offset, :limit";
$stmt = $pdo->prepare($sql);

/* On applique d'abord les paramètres de recherche */
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}

/* On applique ensuite offset + limit */
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);
$stmt->bindValue(":limit", $docsPerPage, PDO::PARAM_INT);

$stmt->execute();
$docs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
.modern-table {
    width:100%;
    border-collapse: collapse;
    background:white;
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 4px 16px rgba(0,0,0,0.1);
}

.modern-table th {
    background:#0b3d91;
    color:white;
    padding:14px;
    text-align:left;
    font-size:14px;
    letter-spacing:0.5px;
}

.modern-table td {
    padding:12px;
    border-bottom:1px solid #eee;
    font-size:14px;
}

.action-btn {
    padding:7px 14px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
    margin-right:5px;
}

.btn-view { background:#007bff; color:white; }
.btn-download { background:#1e90ff; color:white; }
.btn-copy { background:#6a1b9a; color:white; }
.btn-delete { background:#e53935; color:white; }

.pagination-box {
    margin-top:15px;
    text-align:center;
}

.pagination-box a {
    padding:8px 14px;
    background:#0b3d91;
    color:white;
    border-radius:6px;
    text-decoration:none;
    margin:3px;
}

.pagination-box span {
    font-weight:bold;
    padding:8px 14px;
}
</style>

<div class="table-wrapper">
<table class="modern-table">
    <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Service</th>
        <th>Catégorie</th>
        <th>Type</th>
        <th>Fichier</th>
        <th>Date</th>
        <th>Action</th>
    </tr>

    <?php foreach ($docs as $d): 
        $fileUrl = "uploads/documents/" . $d["filename"];
        $absoluteUrl = (isset($_SERVER["HTTPS"]) ? "https://" : "http://") . $_SERVER["HTTP_HOST"] . "/" . $fileUrl;
    ?>
    <tr>
        <td><?= $d["id"] ?></td>
        <td><?= htmlspecialchars($d["titre"]) ?></td>
        <td><?= htmlspecialchars($d["service"]) ?></td>
        <td><?= htmlspecialchars($d["categorie"]) ?></td>
        <td><?= strtoupper($d["type_doc"]) ?></td>

        <td>
            <?php if (strtolower($d["type_doc"]) == "pdf"): ?>
                <a class="action-btn btn-view" href="#" 
                   onclick="openPDF('<?= $fileUrl ?>'); return false;">👁️ Voir</a>
            <?php endif; ?>

            <a class="action-btn btn-download" href="<?= $fileUrl ?>" target="_blank">
                ⬇️ Télécharger
            </a>

            <button class="action-btn btn-copy" onclick="copyLink('<?= $absoluteUrl ?>')">
                📋 Copier lien
            </button>
        </td>

        <td><?= $d["created_at"] ?></td>

        <td>
            <a class="action-btn btn-delete"
               href="documents.php?delete=<?= $d["id"] ?>&page=<?= $page ?>&search=<?= urlencode($search) ?>&service=<?= urlencode($filtre_service) ?>&categorie=<?= urlencode($filtre_categorie) ?>"
               onclick="return confirm('Supprimer ce document ?')">
               🗑️
            </a>
        </td>
    </tr>
    <?php endforeach; ?>

</table>
</div>

<!-- ============================================================
     PAGINATION
============================================================ -->
<div class="pagination-box">
    <span>Page <?= $page ?> / <?= $totalPages ?></span><br><br>

    <?php if ($page > 1): ?>
        <a href="?page=<?= $page-1 ?>&search=<?= urlencode($search) ?>&service=<?= urlencode($filtre_service) ?>&categorie=<?= urlencode($filtre_categorie) ?>">⬅️ Précédent</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?= $page+1 ?>&search=<?= urlencode($search) ?>&service=<?= urlencode($filtre_service) ?>&categorie=<?= urlencode($filtre_categorie) ?>">Suivant ➡️</a>
    <?php endif; ?>
</div>

<script>
function copyLink(link) {
    navigator.clipboard.writeText(link)
        .then(() => { alert("Lien copié !"); })
        .catch(() => { alert("Erreur lors de la copie."); });
}
</script>


<!-- ============================================================
     POPUP LECTEUR PDF
     ============================================================ -->
<div id="pdfViewer" 
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
            background:rgba(0,0,0,0.8);z-index:9000;text-align:center;">
    
    <div style="margin-top:30px;">
        <button onclick="closePDF()" 
                style="padding:10px 20px;background:#e53935;color:white;border:none;border-radius:5px;">
            ❌ Fermer
        </button>
    </div>

    <iframe id="pdfFrame" style="width:80%;height:85%;margin-top:15px;border:1px solid white;"></iframe>
</div>

<script>
function openPDF(url) {
    document.getElementById('pdfViewer').style.display = 'block';
    document.getElementById('pdfFrame').src = url;
}

function closePDF() {
    document.getElementById('pdfViewer').style.display = 'none';
    document.getElementById('pdfFrame').src = "";
}
</script>

<?php include "footer_admin.php"; ?>
