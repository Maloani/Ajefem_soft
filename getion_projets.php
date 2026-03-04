<?php
require_once "config.php";
session_start();

// Vérification admin
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

// Ajouter un projet
if(isset($_POST['Ajouter'])){
    $sql = $pdo->prepare("INSERT INTO projets_ajefem 
        (titre, description, categorie, etat_financement, budget_previsionnel, montant_debloque, date_debut, date_fin, responsable)
        VALUES (?,?,?,?,?,?,?,?,?)");
    $sql->execute([
        $_POST['titre'], $_POST['description'], $_POST['categorie'],
        $_POST['etat_financement'], $_POST['budget_previsionnel'], $_POST['montant_debloque'],
        $_POST['date_debut'], $_POST['date_fin'], $_POST['responsable']
    ]);

    $success = "Projet ajouté avec succès ✔️";
}

// Supprimer un projet
if(isset($_GET['supprimer'])){
    $id = $_GET['supprimer'];
    $pdo->query("DELETE FROM projets_ajefem WHERE id_projet = $id");
    $success = "Projet supprimé avec succès 🗑️";
}

$projets = $pdo->query("SELECT * FROM projets_ajefem ORDER BY id_projet DESC")->fetchAll(PDO::FETCH_ASSOC);


include "header_admin.php";
?>

<main class="content">

<h2 class="page-title">📌 Gestion des Projets AJEFEM</h2>
<a href="pdf_projets.php" target="_blank" class="btn-pdf">
    📄 Exporter tous les projets en PDF
</a>

<?php if(isset($success)) : ?>
<p class="alert-success"><?= $success ?></p>
<?php endif; ?>

<!-- Formulaire d’ajout -->
<div class="form-card">
    <h3>➕ Ajouter un nouveau projet</h3>
    <form method="POST">
        <label>Titre du projet *</label>
        <input type="text" name="titre" required>

        <label>Description *</label>
        <textarea name="description" required></textarea>

        <label>Catégorie</label>
        <input type="text" name="categorie" placeholder="Ex: Social, Santé...">

        <label>État du financement</label>
        <select name="etat_financement">
            <option value="Non financé">⛔ Non financé</option>
            <option value="Financé">💰 Financé</option>
            <option value="En attente">⏳ En attente</option>
        </select>

        <label>Budget prévisionnel (USD)</label>
        <input type="number" step="0.01" name="budget_previsionnel">

        <label>Montant débloqué (USD)</label>
        <input type="number" step="0.01" name="montant_debloque">

        <label>Date début</label>
        <input type="date" name="date_debut">

        <label>Date fin</label>
        <input type="date" name="date_fin">

        <label>Responsable du Projet</label>
        <input type="text" name="responsable" placeholder="Responsable du dossier">

        <button type="submit" name="Ajouter" class="btn-add">💾 Enregistrer</button>
    </form>
</div>

<hr>


<h3>📋 Liste des Projets Enregistrés</h3>

<table class="table">
<tr>
    <th>#</th>
    <th>Titre</th>
    <th>Budget</th>
    <th>Financement</th>
    <th>Responsable</th>
    <th>Actions</th>
</tr>

<?php foreach($projets as $p): ?>

<?php
$etat_icon = [
    "Financé" => "💰",
    "Non financé" => "⛔",
    "En attente" => "⏳"
][$p['etat_financement']];
?>

<tr>
    <td><?= $p['id_projet'] ?></td>
    <td><?= htmlspecialchars($p['titre']) ?></td>
    <td><b><?= number_format($p['budget_previsionnel'],2) ?></b> USD</td>
    <td><?= $etat_icon .' '. $p['etat_financement'] ?></td>
    <td><?= htmlspecialchars($p['responsable']) ?></td>
    <td>
        <a class="view-btn" title="Voir les détails"
           href="voir_projet.php?id=<?= $p['id_projet'] ?>">👁️</a>

        <a class="edit-btn" title="Modifier"
           href="modifier_projet.php?id=<?= $p['id_projet'] ?>">✏️</a>
 
        <a class="delete-btn" title="Supprimer"
           onclick="return confirm('Supprimer ce projet ?')"
           href="getion_projets.php?supprimer=<?= $p['id_projet'] ?>">🗑️</a>
    </td>
</tr>

<?php endforeach; ?>
</table>

<?php include "footer_admin.php"; ?>

</main>

<style>
.btn-pdf {
    display:inline-block;
    background:#d32f2f;
    color:#fff;
    padding:10px 15px;
    border-radius:6px;
    text-decoration:none;
    font-weight:bold;
    margin-bottom:15px;
    transition:0.3s;
}

.btn-pdf:hover {
    background:#b71c1c;
}

.view-btn {
    padding:6px 10px;
    text-decoration:none;
    font-size:18px;
    color:#0b3d91;
}

.view-btn:hover {
    color:#0056b3;
}

.page-title { margin-bottom:20px; font-size:22px; color:#004aad; }
.alert-success {
    background:#c8f7c5; padding:10px; border-left:4px solid #2ecc71;
    margin-bottom:15px; color:#1e7a36; font-weight:bold;
}
.form-card {
    background:#fff; border-radius:10px; padding:20px; box-shadow:0 3px 10px rgba(0,0,0,0.1);
}
.form-card input, .form-card textarea, .form-card select {
    width:100%; padding:10px; margin:6px 0 14px;
    border:1px solid #ccc; border-radius:6px;
}
.form-card button {
    background:#0865d3; border:none; color:#fff;
    padding:12px 18px; border-radius:6px;
    cursor:pointer; font-weight:bold;
}
.form-card button:hover { background:#003f9a; }

.table {
    width:100%; border-collapse:collapse; background:#fff;
    border-radius:10px; overflow:hidden;
    box-shadow:0 3px 8px rgba(0,0,0,0.08);
}
.table th, .table td {
    padding:13px; text-align:left; border-bottom:1px solid #ddd;
}
.table tr:hover { background:#f6f9ff; }

.edit-btn, .delete-btn {
    padding:6px 10px; text-decoration:none; font-size:18px;
}
.edit-btn:hover { color:green; }
.delete-btn:hover { color:red; }
</style>
