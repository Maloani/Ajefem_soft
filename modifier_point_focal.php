<?php
// =========================================================
//   modifier_point_focal.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// ID validation
$id = intval($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: points_focaux.php?error=" . urlencode("ID invalide"));
    exit();
}

// Fetch data
$stmt = $pdo->prepare("SELECT * FROM points_focaux WHERE id=:id");
$stmt->execute([":id"=>$id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$p) {
    header("Location: points_focaux.php?error=" . urlencode("Point Focal introuvable"));
    exit();
}

// Form submission update
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name     = trim($_POST["name"]);
    $phone    = trim($_POST["phone"]);
    $sexe     = trim($_POST["sexe"]);
    $province = trim($_POST["province"]);
    $adresse  = trim($_POST["adresse"]);

    if ($name=="" || $phone=="" || $sexe=="" || $province=="" || $adresse=="") {
        header("Location: modifier_point_focal.php?id=$id&error=" . urlencode("Veuillez remplir tous les champs."));
        exit();
    }

    $update = $pdo->prepare("UPDATE points_focaux
                             SET name=:name, phone=:phone, sexe=:sexe, province=:province, adresse=:adresse
                             WHERE id=:id");

    $update->execute([
        ":name"=>$name, ":phone"=>$phone, ":sexe"=>$sexe,
        ":province"=>$province, ":adresse"=>$adresse, ":id"=>$id
    ]);

    header("Location: points_focaux.php?success=" . urlencode("Mise à jour réussie !"));
    exit();
}

include "header_admin.php";
?>

<h2>✏ Modifier Point Focal</h2>

<?php if(isset($_GET["error"])): ?>
    <div class="alert-error"><?= $_GET["error"] ?></div>
<?php endif; ?>

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
</style>

<div class="form-box">

<form method="POST">

    <div class="input-group">
        <label>Nom complet *</label>
        <input type="text" name="name" value="<?= htmlspecialchars($p['name']) ?>" required>
    </div>

    <div class="input-group">
        <label>Téléphone *</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($p['phone']) ?>" required>
    </div>

    <div class="input-group">
        <label>Sexe *</label>
        <select name="sexe" required>
            <option value="M" <?= $p['sexe']=="M"?"selected":"" ?>>Homme</option>
            <option value="F" <?= $p['sexe']=="F"?"selected":"" ?>>Femme</option>
        </select>
    </div>

    <div class="input-group">
        <label>Province *</label>
        <input type="text" name="province" value="<?= htmlspecialchars($p['province']) ?>" required>
    </div>

    <div class="input-group">
        <label>Adresse *</label>
        <input type="text" name="adresse" value="<?= htmlspecialchars($p['adresse']) ?>" required>
    </div>

    <button class="btn-submit">💾 Enregistrer les modifications</button>

</form>
</div>

<?php include "footer_admin.php"; ?>
