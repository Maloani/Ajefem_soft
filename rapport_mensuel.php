<?php
session_start();
require_once "config.php";
require_once "fpdf/fpdf.php";

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

// Sélection du mois
$mois = $_GET["mois"] ?? date("m");
$annee = $_GET["annee"] ?? date("Y");

// Récupératon cotisations mensuelles
$stmt = $pdo->prepare("
    SELECT * FROM cotisations_ajefem
    WHERE MONTH(date_paiement)=:mois AND YEAR(date_paiement)=:annee
    ORDER BY date_paiement ASC
");
$stmt->execute([":mois"=>$mois, ":annee"=>$annee]);
$cotisations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Total mensuel
$total = $pdo->prepare("
    SELECT SUM(montant) FROM cotisations_ajefem
    WHERE MONTH(date_paiement)=:mois AND YEAR(date_paiement)=:annee
");
$total->execute([":mois"=>$mois, ":annee"=>$annee]);
$total_mois = $total->fetchColumn() ?: 0;

// Activités (réalisations)
$act = $pdo->prepare("
    SELECT * FROM realisations
    WHERE MONTH(date_realisation)=:mois AND YEAR(date_realisation)=:annee
    ORDER BY date_realisation ASC
");
$act->execute([":mois"=>$mois, ":annee"=>$annee]);
$realisations = $act->fetchAll(PDO::FETCH_ASSOC);

include "header_admin.php";
?>

<h2>📅 Rapport du Mois : <?= $mois ?>/<?= $annee ?></h2>

<h3>💰 Cotisations</h3>
<table border="1" width="100%" style="border-collapse:collapse;">
<tr>
  <th>Code Membre</th>
  <th>Montant (USD)</th>
  <th>Date</th>
  <th>Mode</th>
</tr>

<?php foreach($cotisations as $c): ?>
<tr>
  <td><?= $c["code_membre"] ?></td>
  <td><?= $c["montant"] ?></td>
  <td><?= $c["date_paiement"] ?></td>
  <td><?= $c["mode_paiement"] ?></td>
</tr>
<?php endforeach; ?>

</table>

<h3>Total du mois : <b style="color:green;"><?= number_format($total_mois,2) ?> USD</b></h3>

<h3>📘 Activités réalisées</h3>
<ul>
<?php foreach($realisations as $r): ?>
  <li><b><?= $r["titre_fr"] ?></b> — <?= $r["date_realisation"] ?></li>
<?php endforeach; ?>
</ul>

<br>
<a href="rapport_mensuel_pdf.php?mois=<?= $mois ?>&annee=<?= $annee ?>" class="action-btn" style="padding:10px;background:#0b3d91;color:white;">
📄 Exporter en PDF
</a>

<?php include "footer_admin.php"; ?>
