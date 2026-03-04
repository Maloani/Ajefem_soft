<?php
require_once "config.php";
require_once "fpdf/fpdf.php";

$mois = $_GET["mois"];
$annee = $_GET["annee"];

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->Cell(0,10,"Rapport Mensuel AJEFEM - $mois/$annee",0,1,"C");

// Cotisations
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,10,"Situation Financiere",0,1);

$pdf->SetFont("Arial","",10);

$stmt = $pdo->prepare("
    SELECT * FROM cotisations_ajefem
    WHERE MONTH(date_paiement)=:m AND YEAR(date_paiement)=:y
");
$stmt->execute([":m"=>$mois,":y"=>$annee]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total = 0;
foreach($data as $d){
    $pdf->Cell(95,8,$d["code_membre"],1);
    $pdf->Cell(30,8,$d["montant"]." USD",1);
    $pdf->Cell(65,8,$d["date_paiement"],1,1);
    $total += $d["montant"];
}

$pdf->Ln(5);
$pdf->SetFont("Arial","B",12);
$pdf->Cell(0,10,"Total: $total USD",0,1);

$pdf->Output();
exit;
