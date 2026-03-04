<?php
// =========================================================
//   modifier_membre.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// Récupération ID
$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
if ($id <= 0) {
    header("Location: liste_membres.php?error=" . urlencode("ID invalide."));
    exit();
}

// Charger les données du membre
$stmt = $pdo->prepare("SELECT * FROM membres_ajefem WHERE id = :id");
$stmt->execute([":id" => $id]);
$membre = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$membre) {
    header("Location: liste_membres.php?error=" . urlencode("Membre introuvable."));
    exit();
}

$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

// ========================
//   TRAITEMENT DU FORMULAIRE
// ========================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST["name"]);
    $email   = trim($_POST["email"]);
    $phone   = trim($_POST["phone"]);
    $sex     = trim($_POST["sex"]);
    $address = trim($_POST["address"]);
    $role    = trim($_POST["role"]);

    if ($name == "" || $phone == "" || $sex == "" || $address == "") {
        header("Location: modifier_membre.php?id=$id&error=" . urlencode("Veuillez remplir tous les champs obligatoires."));
        exit();
    }

    // Gestion nouvelle photo
    $photo_name = $membre["photo"]; // garder ancienne photo si aucune nouvelle

    if (!empty($_FILES["photo"]["name"])) {

        $allowed = ["jpg", "jpeg", "png"];
        $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            header("Location: modifier_membre.php?id=$id&error=" . urlencode("Format photo invalide (JPG/PNG)."));
            exit();
        }

        // Nouveau nom
        $photo_name_new = "membre_" . time() . "_" . rand(1000,9999) . "." . $ext;
        $upload_path = "uploads/membres/" . $photo_name_new;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $upload_path)) {
            header("Location: modifier_membre.php?id=$id&error=" . urlencode("Erreur lors de l'upload de la nouvelle photo."));
            exit();
        }

        // Supprimer ancienne photo si existe
        if (!empty($membre["photo"]) && file_exists("uploads/membres/" . $membre["photo"])) {
            unlink("uploads/membres/" . $membre["photo"]);
        }

        // Prendre la nouvelle photo
        $photo_name = $photo_name_new;
    }

    // Mise à jour DB
    try {
        $stmt = $pdo->prepare("
            UPDATE membres_ajefem 
            SET name = :name, email = :email, phone = :phone, sex = :sex, address = :address, role = :role, photo = :photo
            WHERE id = :id
        ");
        $stmt->execute([
            ":name"    => $name,
            ":email"   => $email,
            ":phone"   => $phone,
            ":sex"     => $sex,
            ":address" => $address,
            ":role"    => $role,
            ":photo"   => $photo_name,
            ":id"      => $id
        ]);

        header("Location: modifier_membre.php?id=$id&success=" . urlencode("Modifications enregistrées !"));
        exit();

    } catch (Exception $e) {
        header("Location: modifier_membre.php?id=$id&error=" . urlencode("Erreur lors de l'enregistrement."));
        exit();
    }
}

include "header_admin.php";
?>

<h2>✏️ Modifier un Membre AJEFEM</h2>

<?php if ($success): ?>
    <div class="alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<style>
.form-box {
    max-width: 650px;
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
.input-group select {
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:6px;
}
.photo-preview {
    width:120px;
    height:120px;
    border-radius:10px;
    object-fit:cover;
    border:3px solid #0b3d91;
    margin-bottom:10px;
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

<form method="POST" enctype="multipart/form-data">

    <div class="input-group">
        <label>Code du membre</label>
        <input type="text" value="<?= htmlspecialchars($membre['code_membre']) ?>" readonly>
    </div>

    <div class="input-group">
        <label>Nom complet *</label>
        <input type="text" name="name" required value="<?= htmlspecialchars($membre['name']) ?>">
    </div>

    <div class="input-group">
        <label>Email (optionnel)</label>
        <input type="email" name="email" value="<?= htmlspecialchars($membre['email']) ?>">
    </div>

    <div class="input-group">
        <label>Téléphone *</label>
        <input type="text" name="phone" required value="<?= htmlspecialchars($membre['phone']) ?>">
    </div>

    <div class="input-group">
        <label>Sexe *</label>
        <select name="sex" required>
            <option value="M" <?= $membre["sex"] == "M" ? "selected" : "" ?>>Homme</option>
            <option value="F" <?= $membre["sex"] == "F" ? "selected" : "" ?>>Femme</option>
        </select>
    </div>

    <div class="input-group">
        <label>Adresse *</label>
        <input type="text" name="address" required value="<?= htmlspecialchars($membre['address']) ?>">
    </div>

    <div class="input-group">
        <label>Rôle</label>
        <input type="text" name="role" value="<?= htmlspecialchars($membre['role']) ?>">
    </div>

    <div class="input-group">
        <label>Photo actuelle</label><br>
        <?php if (!empty($membre["photo"])): ?>
            <img src="uploads/membres/<?= htmlspecialchars($membre["photo"]) ?>" class="photo-preview">
        <?php else: ?>
            <img src="img/user_default.png" class="photo-preview">
        <?php endif; ?>
    </div>

    <div class="input-group">
        <label>Changer la photo (optionnel)</label>
        <input type="file" name="photo" accept=".jpg,.jpeg,.png">
    </div>

    <button class="btn-submit">Enregistrer les modifications</button>

</form>

</div>

<?php include "footer_admin.php"; ?>
