<?php
require_once "config.php";
session_start();

// Vérification admin
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: getion_projets.php?error=Aucun projet sélectionné !");
    exit;
}

$id = intval($_GET['id']);

// Charger les infos du projet
$stmt = $pdo->prepare("SELECT * FROM projets_ajefem WHERE id_projet = ?");
$stmt->execute([$id]);
$projet = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$projet) {
    header("Location: getion_projets.php?error=Projet introuvable !");
    exit;
}

// Traitement de la modification
if (isset($_POST['Modifier'])) {

    $sql = $pdo->prepare("UPDATE projets_ajefem SET
        titre=?, description=?, categorie=?, etat_financement=?, 
        budget_previsionnel=?, montant_debloque=?, date_debut=?, date_fin=?, responsable=?
        WHERE id_projet=?
    ");

    $sql->execute([
        $_POST['titre'], $_POST['description'], $_POST['categorie'],
        $_POST['etat_financement'], $_POST['budget_previsionnel'], $_POST['montant_debloque'],
        $_POST['date_debut'], $_POST['date_fin'], $_POST['responsable'],
        $id
    ]);

    $success = "Projet modifié avec succès ✔️";
}

include "header_admin.php";
?>

<main class="content">

<h2 class="page-title">✏️ Modifier le Projet</h2>

<?php if(isset($success)) : ?>
<p class="alert-success"><?= $success ?></p>
<?php endif; ?>

<div class="form-card">
    <form method="POST">

        <label>Titre du projet *</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($projet['titre']) ?>" required>

        <label>Description *</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($projet['description']) ?></textarea>

        <label>Catégorie</label>
        <input type="text" name="categorie" value="<?= htmlspecialchars($projet['categorie']) ?>">

        <label>État du financement</label>
        <select name="etat_financement">
            <option <?= $projet['etat_financement']=="Non financé"?"selected":"" ?>>Non financé</option>
            <option <?= $projet['etat_financement']=="Financé"?"selected":"" ?>>Financé</option>
            <option <?= $projet['etat_financement']=="En attente"?"selected":"" ?>>En attente</option>
        </select>

        <label>Budget prévisionnel (USD)</label>
        <input type="number" step="0.01" name="budget_previsionnel"
               value="<?= $projet['budget_previsionnel'] ?>">

        <label>Montant débloqué (USD)</label>
        <input type="number" step="0.01" name="montant_debloque"
               value="<?= $projet['montant_debloque'] ?>">

        <label>Date début</label>
        <input type="date" name="date_debut"
               value="<?= $projet['date_debut'] ?>">

        <label>Date fin</label>
        <input type="date" name="date_fin"
               value="<?= $projet['date_fin'] ?>">

        <label>Responsable du Projet</label>
        <input type="text" name="responsable"
               value="<?= htmlspecialchars($projet['responsable']) ?>">

        <button type="submit" name="Modifier" class="btn-mod">💾 Mettre à jour</button>
        <a href="getion_projets.php" class="btn-cancel">↩ Retour</a>

    </form>
</div>

</main>

<style>
.page-title { margin-bottom:20px; font-size:22px; color:#004aad; }
.alert-success {
    background:#c8f7c5; padding:10px; 
    border-left:4px solid #2ecc71;
    margin-bottom:15px; color:#1e7a36; font-weight:bold;
}
.form-card {
    background:#fff; border-radius:10px; padding:20px;
    box-shadow:0 3px 10px rgba(0,0,0,0.1); max-width:800px;
}
.form-card input, .form-card textarea, .form-card select {
    width:100%; padding:10px; margin:6px 0 14px;
    border:1px solid #ccc; border-radius:6px;
}
.btn-mod {
    background:#0077ff; color:white;
    padding:12px 16px; border:none;
    border-radius:6px; cursor:pointer;
}
.btn-mod:hover { background:#004c9e; }
.btn-cancel {
    background:#777; color:white;
    padding:12px 16px; border-radius:6px;
    margin-left:10px; text-decoration:none;
}
.btn-cancel:hover { background:#444; }
</style>
