<?php
// =========================================================
//   modifier_cotisation.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

$id = intval($_GET["id"] ?? 0);
if (!$id) {
    header("Location: gestion_cotisations.php?error=" . urlencode("ID invalide."));
    exit();
}

// Récupérer les détails de la cotisation
$stmt = $pdo->prepare("
    SELECT * FROM cotisations_ajefem WHERE id_cotisation = :id
");
$stmt->execute([":id" => $id]);
$cotisation = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cotisation) {
    header("Location: gestion_cotisations.php?error=" . urlencode("Cotisation introuvable."));
    exit();
}

// Récupérer membres
$membres = $pdo->query("SELECT code_membre, name FROM membres_ajefem ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

// Traitement modification
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code_membre   = trim($_POST["code_membre"]);
    $montant       = trim($_POST["montant"]);
    $date_paiement = trim($_POST["date_paiement"]);
    $mode_paiement = trim($_POST["mode_paiement"]);
    $commentaire   = trim($_POST["commentaire"]);

    try {
        $update = $pdo->prepare("
            UPDATE cotisations_ajefem
            SET code_membre=:cm, montant=:m, date_paiement=:dp, mode_paiement=:mp, commentaire=:c
            WHERE id_cotisation=:id
        ");
        $update->execute([
            ":cm" => $code_membre,
            ":m"  => $montant,
            ":dp" => $date_paiement,
            ":mp" => $mode_paiement,
            ":c"  => $commentaire,
            ":id" => $id
        ]);

        header("Location: gestion_cotisations.php?success=" . urlencode("Modification réussie !"));
        exit();
        
    } catch (Exception $e) {
        header("Location: modifier_cotisation.php?id=$id&error=" . urlencode("Erreur lors de la mise à jour."));
        exit();
    }
}

include "header_admin.php";
?>

<h2>✏ Modifier la Cotisation</h2>

<style>
.form-box {
    max-width:650px;background:white;margin:auto;padding:25px;
    border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,0.1);
}
.input-group { margin-bottom:15px; }
.input-group label { font-weight:bold;display:block;color:#0b3d91;margin-bottom:5px; }
.input-group input, select, textarea {
    width:100%;padding:10px;border:1px solid #ccc;border-radius:6px;
}
.btn-submit { width:100%;padding:14px;background:#0b3d91;color:white;font-size:17px;border:none;border-radius:6px;margin-top:10px;cursor:pointer;font-weight:bold; }
.btn-submit:hover { background:#072f6b; }
</style>

<div class="form-box">
<form method="POST">

    <div class="input-group">
        <label>Membre *</label>
        <select name="code_membre" required>
            <?php foreach($membres as $m): ?>
                <option value="<?= $m['code_membre']; ?>" <?= $cotisation['code_membre']==$m['code_membre']?'selected':''; ?>>
                    <?= $m['name']; ?> (<?= $m['code_membre']; ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group"><label>Montant *</label><input type="number" name="montant" step="0.01" value="<?= $cotisation['montant']; ?>"></div>
    <div class="input-group"><label>Date *</label><input type="date" name="date_paiement" value="<?= $cotisation['date_paiement']; ?>"></div>

    <div class="input-group">
        <label>Mode paiement</label>
        <select name="mode_paiement">
            <?php foreach(["Cash","Mobile Money","Virement Bancaire"] as $mode): ?>
                <option <?= $cotisation['mode_paiement']==$mode?'selected':''; ?>><?= $mode ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group">
        <label>Commentaire</label>
        <textarea name="commentaire" rows="3"><?= $cotisation['commentaire']; ?></textarea>
    </div>

    <button class="btn-submit">💾 Enregistrer les modifications</button>

</form>
</div>

<?php include "footer_admin.php"; ?>
