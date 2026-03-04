<?php
// ====================================
//  dashboard.php  - AJEFEM (ADMIN ONLY)
// ====================================
session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION["fullname"];
$role     = $_SESSION["role"];
$email    = $_SESSION["email"];

if (strtolower($role) !== "admin") {
    echo "<h2 style='color:red;text-align:center;margin-top:40px;'>⛔ Accès refusé : Cette page est réservée aux administrateurs.</h2>";
    exit();
}

require_once "config.php";

// ---- RÉCUPÉRATION STATISTIQUES ---- //
$total_membres         = $pdo->query("SELECT COUNT(*) FROM membres_ajefem")->fetchColumn();
$total_adhesions       = $pdo->query("SELECT COUNT(*) FROM adhesions_requets")->fetchColumn();
$total_messages        = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$total_hommes          = $pdo->query("SELECT COUNT(*) FROM membres_ajefem WHERE sex='M'")->fetchColumn();
$total_femmes          = $pdo->query("SELECT COUNT(*) FROM membres_ajefem WHERE sex='F'")->fetchColumn();
$total_points_focaux   = $pdo->query("SELECT COUNT(*) FROM points_focaux")->fetchColumn();
$total_staff           = $pdo->query("SELECT COUNT(*) FROM membres_ajefem WHERE role='staff'")->fetchColumn();
$total_admin           = $pdo->query("SELECT COUNT(*) FROM membres_ajefem WHERE role='admin'")->fetchColumn();
$total_cotisations     = $pdo->query("SELECT COUNT(*) FROM cotisations_ajefem")->fetchColumn();
// ---- STATS PROJETS ---- //
$total_projets_finances = $pdo->query("SELECT COUNT(*) FROM projets_ajefem WHERE etat_financement='Financé'")->fetchColumn();
$total_projets_non_finances = $pdo->query("SELECT COUNT(*) FROM projets_ajefem WHERE etat_financement='Non financé'")->fetchColumn();
$total_projets_attente = $pdo->query("SELECT COUNT(*) FROM projets_ajefem WHERE etat_financement='En attente'")->fetchColumn();

$total_finance_debloque = $pdo->query("SELECT COALESCE(SUM(montant_debloque),0) FROM projets_ajefem WHERE etat_financement='Financé'")->fetchColumn();
$total_budget_non_finance = $pdo->query("SELECT COALESCE(SUM(montant_debloque),0) FROM projets_ajefem")->fetchColumn();
$total_budget_non_finance2 = $pdo->query("SELECT COALESCE(SUM(budget_previsionnel - montant_debloque),0) FROM projets_ajefem")->fetchColumn();


// 💰 Montant total toutes cotisations
$total_montant         = $pdo->query("SELECT COALESCE(SUM(montant),0) FROM cotisations_ajefem")->fetchColumn();

include 'header_admin.php';
?>

<h2>Bienvenue, <?= htmlspecialchars($fullname) ?> 👋</h2>
<span class="admin-badge">Administrateur AJEFEM</span>

<p><strong>Email :</strong> <?= htmlspecialchars($email) ?></p>

<hr><br>

<h3>📊 Statistiques Générales AJEFEM</h3>

<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-top: 25px;
}
.stat-card {
    background: #fff;
    padding: 22px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.10);
    transition: .2s;
}
.stat-card:hover {
    transform: scale(1.04);
    box-shadow: 0 8px 18px rgba(0,0,0,0.15);
}
.stat-icon {
    font-size: 40px;
    color: #0b3d91;
    margin-bottom: 10px;
}
.stat-number {
    font-size: 32px;
    font-weight: bold;
    color:#ff5722;
}
.stat-label {
    font-size: 16px;
    color:#444;
}
</style>

<div class="stats-grid">

    <!-- Total Membres -->
    <div class="stat-card">
        <div class="stat-icon">👥</div>
        <div class="stat-number"><?= $total_membres ?></div>
        <div class="stat-label">Membres AJEFEM</div>
    </div>

    <!-- Adhésions -->
    <div class="stat-card">
        <div class="stat-icon">📝</div>
        <div class="stat-number"><?= $total_adhesions ?></div>
        <div class="stat-label">Adhésions en ligne</div>
    </div>

    <!-- Messages -->
    <div class="stat-card">
        <div class="stat-icon">✉️</div>
        <div class="stat-number"><?= $total_messages ?></div>
        <div class="stat-label">Messages reçus</div>
    </div>

    <!-- Total Cotisations -->
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-number"><?= $total_cotisations ?></div>
        <div class="stat-label">Cotisations enregistrées</div>
    </div>

    <!-- 💵 NOUVEAU : Montant total des cotisations -->
    <div class="stat-card">
        <div class="stat-icon">🏦</div>
        <div class="stat-number"><?= number_format($total_montant,2,","," ") ?> $</div>
        <div class="stat-label">Montant total cotisé</div>
    </div>

    <!-- Hommes -->
    <div class="stat-card">
        <div class="stat-icon">👨</div>
        <div class="stat-number"><?= $total_hommes ?></div>
        <div class="stat-label">Hommes</div>
    </div>

    <!-- Femmes -->
    <div class="stat-card">
        <div class="stat-icon">👩</div>
        <div class="stat-number"><?= $total_femmes ?></div>
        <div class="stat-label">Femmes</div>
    </div>

    <!-- Points Focaux -->
    <div class="stat-card">
        <div class="stat-icon">📌</div>
        <div class="stat-number"><?= $total_points_focaux ?></div>
        <div class="stat-label">Points Focaux</div>
    </div>

       <!-- Projets financés -->
    <div class="stat-card">
        <div class="stat-icon">🟢</div>
        <div class="stat-number"><?= $total_projets_finances ?></div>
        <div class="stat-label">Projets financés</div>
    </div>

    <!-- Projets non financés -->
    <div class="stat-card">
        <div class="stat-icon">🔴</div>
        <div class="stat-number"><?= $total_projets_non_finances ?></div>
        <div class="stat-label">Non financés</div>
    </div>

    <!-- Projets en attente -->
    <div class="stat-card">
        <div class="stat-icon">🟠</div>
        <div class="stat-number"><?= $total_projets_attente ?></div>
        <div class="stat-label">En attente financement</div>
    </div>

    <!-- Montant financé -->
    <div class="stat-card">
        <div class="stat-icon">💰</div>
        <div class="stat-number"><?= number_format($total_finance_debloque,2,","," ") ?> $</div>
        <div class="stat-label">Montant financé</div>
    </div>

    <!-- Budget restant à financer -->
    <div class="stat-card">
        <div class="stat-icon">📉</div>
        <div class="stat-number"><?= number_format($total_budget_non_finance2,2,","," ") ?> $</div>
        <div class="stat-label">Ecart Budget non financé</div>
    </div>
    
     <!-- Budget restant à financer -->
    <div class="stat-card">
        <div class="stat-icon">📉</div>
        <div class="stat-number"><?= number_format($total_budget_non_finance,2,","," ") ?> $</div>
        <div class="stat-label">Budget non financé</div>
    </div>


</div>

<?php include 'footer_admin.php'; ?>
