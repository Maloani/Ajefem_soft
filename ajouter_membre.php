<?php
// =========================================================
//   ajouter_membre.php - AJEFEM (ADMIN ONLY)
// =========================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// =======================
// Vérification ADMIN
// =======================
if (
    !isset($_SESSION["logged_in"]) ||
    $_SESSION["logged_in"] !== true ||
    strtolower($_SESSION["role"]) !== "admin"
) {
    header("Location: login.php");
    exit();
}

require_once "config.php";

// =======================
// Messages
// =======================
$success = $_GET["success"] ?? "";
$error   = $_GET["error"] ?? "";

// =======================
// Génération code membre UNIQUE
// =======================
function genererCodeMembreDepuisNom($name) {
    $year = date("Y");
    $name = trim(preg_replace('/\s+/', ' ', $name));
    $parts = explode(" ", $name);

    $abbr = "";
    foreach ($parts as $p) {
        $abbr .= strtoupper(substr($p, 0, 1));
    }

    // Ajout aléatoire pour éviter les doublons
    return "AJEFEM-" . $abbr . "-" . $year . "-" . rand(100, 999);
}

// =======================
// Traitement formulaire
// =======================
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST["name"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $phone   = trim($_POST["phone"] ?? "");
    $sex     = trim($_POST["sex"] ?? "");
    $address = trim($_POST["address"] ?? "");
    $role    = trim($_POST["role"] ?? "membre");

    // =======================
    // Vérifications
    // =======================
    if ($name === "" || $phone === "" || $sex === "" || $address === "") {
        header("Location: ajouter_membre.php?error=" . urlencode(
            "Veuillez remplir tous les champs obligatoires (sauf email)."
        ));
        exit();
    }

    // =======================
    // Génération code membre
    // =======================
    $code_membre = genererCodeMembreDepuisNom($name);

    // =======================
    // Upload PHOTO
    // =======================
    $photo_name = null;
    $upload_dir = __DIR__ . "/uploads/membres/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    if (!empty($_FILES["photo"]["name"])) {

        $allowed = ["jpg", "jpeg", "png"];
        $ext = strtolower(pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            header("Location: ajouter_membre.php?error=" . urlencode(
                "Format de photo invalide (jpg, jpeg, png)."
            ));
            exit();
        }

        $photo_name = "membre_" . time() . "_" . rand(1000, 9999) . "." . $ext;
        $upload_path = $upload_dir . $photo_name;

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $upload_path)) {
            header("Location: ajouter_membre.php?error=" . urlencode(
                "Erreur lors de l'upload de la photo."
            ));
            exit();
        }
    }

    // =======================
    // Enregistrement DB
    // =======================
    try {

        $stmt = $pdo->prepare("
            INSERT INTO membres_ajefem 
            (code_membre, name, email, phone, sex, address, photo, `role`)
            VALUES 
            (:code_membre, :name, :email, :phone, :sex, :address, :photo, :role)
        ");

        $stmt->execute([
            ":code_membre" => $code_membre,
            ":name"        => $name,
            ":email"       => ($email !== "") ? $email : null,
            ":phone"       => $phone,
            ":sex"         => $sex,
            ":address"     => $address,
            ":photo"       => $photo_name,
            ":role"        => $role
        ]);

        header("Location: ajouter_membre.php?success=" . urlencode(
            "Membre ajouté avec succès !"
        ));
        exit();

    } catch (PDOException $e) {
        // Affichage temporaire pour debug (à enlever en production)
        die("<pre>ERREUR SQL : " . $e->getMessage() . "</pre>");
    }
}

include "header_admin.php";
?>


<h2>➕ Ajouter un Membre AJEFEM</h2>

<?php if ($success): ?>
    <div class="alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert-error"><?= $error ?></div>
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
        <label>Code du membre (généré automatiquement)</label>
        <input type="text" id="preview_code" readonly placeholder="Généré automatiquement après saisie du nom">
    </div>

    <script>
    function genererApercuCode() {
        let nom = document.querySelector("input[name='name']").value.trim();
        if (nom.length === 0) {
            document.getElementById("preview_code").value = "";
            return;
        }

        let parts = nom.split(" ");
        let abbr = "";
        parts.forEach(p => { if (p.length > 0) abbr += p[0].toUpperCase(); });

        let year = new Date().getFullYear();
        document.getElementById("preview_code").value = "AJEFEM-" + abbr + "-" + year;
    }
    document.addEventListener("input", genererApercuCode);
    </script>

    <div class="input-group">
        <label>Nom complet *</label>
        <input type="text" name="name" required>
    </div>

    <div class="input-group">
        <label>Email (optionnel)</label>
        <input type="email" name="email">
    </div>

    <div class="input-group">
        <label>Téléphone *</label>
        <input type="text" name="phone" required>
    </div>

    <div class="input-group">
        <label>Sexe *</label>
        <select name="sex" required>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
        </select>
    </div>

    <div class="input-group">
        <label>Adresse complète *</label>
        <input type="text" name="address" required>
    </div>

    <div class="input-group">
        <label>Photo du membre (JPG/PNG)</label>
        <input type="file" name="photo" accept=".jpg,.jpeg,.png">
    </div>

    <div class="input-group">
        <label>Rôle dans AJEFEM</label>
        <input type="text" name="role">
    </div>

    <button class="btn-submit">Ajouter le membre</button>

</form>

</div>

<?php include "footer_admin.php"; ?>
