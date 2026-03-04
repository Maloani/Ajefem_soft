<?php
// ==========================================================
//    RAPPORT PDF - PROJETS AJEFEM
// ==========================================================

require_once "config.php";
require_once "fpdf/fpdf.php";

session_start();
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location: login.php"); exit();
}

// Charger les projets
$stmt = $pdo->query("SELECT * FROM projets_ajefem ORDER BY id_projet DESC");
$projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Totaux financiers
$total_budget = $pdo->query("SELECT SUM(budget_previsionnel) FROM projets_ajefem")->fetchColumn();
$total_financement = $pdo->query("SELECT SUM(montant_debloque) FROM projets_ajefem")->fetchColumn();

// UTF8 → ISO pour FPDF
function utf8($txt){
    return iconv("UTF-8","ISO-8859-1//TRANSLIT",$txt);
}

// Assets Signature + Cachet
$logo = "img/logo_AJEFEM.png";
$cachet = "img/sceau.JPG";
$sign = "img/signatureg.PNG";

// 📄 Création PDF
$pdf = new FPDF("L","mm","A4");
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);

// ======= ENTÊTE =======
if(file_exists($logo)) $pdf->Image($logo, 10, 8, 26);

$pdf->SetFont("Arial","B",18);
$pdf->SetXY(38,10);
$pdf->Cell(0,10,utf8("ACTIONS DE JEUNES ET FEMMES POUR L’ENTRAIDE MUTUELLE (AJEFEM)"),0,1);

$pdf->SetFont("Arial","",12);
$pdf->SetXY(38,20);
$pdf->Cell(0,8,utf8("Rapport des Projets — ".date("d/m/Y")),0,1);

// Ligne bleue
$pdf->Ln(10);
$pdf->SetDrawColor(0,56,168);
$pdf->SetLineWidth(1);
$pdf->Line(10,35,287,35);
$pdf->Ln(8);

// ====== TABLEAU ======
$pdf->SetFont("Arial","B",11);
$pdf->SetFillColor(0,56,168);
$pdf->SetTextColor(255,255,255);

$pdf->Cell(10,10,"#",1,0,'C',true);
$pdf->Cell(65,10,utf8("Titre"),1,0,'C',true);
$pdf->Cell(30,10,utf8("Catégorie"),1,0,'C',true);
$pdf->Cell(35,10,utf8("Budget USD"),1,0,'C',true);
$pdf->Cell(40,10,utf8("Débloqué USD"),1,0,'C',true);
$pdf->Cell(38,10,utf8("Statut"),1,0,'C',true);
$pdf->Cell(30,10,utf8("Début"),1,0,'C',true);
$pdf->Cell(42,10,utf8("Responsable"),1,1,'C',true);

$pdf->SetFont("Arial","",10);
$pdf->SetTextColor(0,0,0);

// Boucle d'affichage
foreach($projets as $p){

    // Gestion des couleurs & icônes de statut
    $statut = $p['etat_financement'];
    $icon = "⏺"; $r=0; $g=0; $b=0;

    if($statut=="Financé"){ $icon="🟢";$r=0;$g=150;$b=0; }
    if($statut=="Non financé"){ $icon="🔴";$r=180;$g=0;$b=0; }
    if($statut=="En attente"){ $icon="🟠";$r=255;$g=133;$b=0; }

    $pdf->Cell(10,10,$p['id_projet'],1,0,'C');
    $pdf->Cell(65,10,utf8($p['titre']),1);
    $pdf->Cell(30,10,utf8($p['categorie']),1,0,'C');

    $pdf->Cell(35,10,number_format($p['budget_previsionnel'],2),1,0,'R');
    $pdf->Cell(40,10,number_format($p['montant_debloque'],2),1,0,'R');

    // Statut coloré
    $pdf->SetTextColor($r,$g,$b);
    $pdf->Cell(38,10,utf8("$icon $statut"),1,0,'C');
    $pdf->SetTextColor(0,0,0);

    $pdf->Cell(30,10,$p['date_debut'],1,0,'C');
    $pdf->Cell(42,10,utf8(substr($p['responsable'],0,20)),1,1,'C');
}

$pdf->Ln(8);

// ===== RÉSUMÉ FINANCIER =====
$pdf->SetFont("Arial","B",13);
$pdf->Cell(0,8,utf8("Résumé Financier"),0,1);

$pdf->SetFont("Arial","",11);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(80,7,utf8("Budget total prévisionnel : "));
$pdf->SetTextColor(0,72,255);
$pdf->Cell(60,7,number_format($total_budget,2)." USD",0,1);

$pdf->SetTextColor(0,0,0);
$pdf->Cell(80,7,utf8("Total financé / débloqué : "));
$pdf->SetTextColor(0,150,0);
$pdf->Cell(60,7,number_format($total_financement,2)." USD",0,1);
$pdf->SetTextColor(0,0,0);

$pdf->Ln(15);

// ====== Signature + Cachet ======
if(file_exists($cachet)) $pdf->Image($cachet,15,175,28);
if(file_exists($sign)) $pdf->Image($sign,50,178,35);

$pdf->SetFont("Arial","B",10);
$pdf->SetXY(50,195);
$pdf->Cell(80,5,utf8("PhD MALOANI SAIDI Georges"));

$pdf->SetFont("Arial","I",9);
$pdf->SetXY(50,200);
$pdf->Cell(80,5,utf8("Coordonnateur National AJEFEM"));

// Footer auto
$pdf->SetY(-15);
$pdf->SetFont("Arial","I",8);
$pdf->SetTextColor(120,120,120);
$pdf->Cell(0,8,utf8("Rapport AJEFEM — Page " . $pdf->PageNo() . "/{nb}"),0,0,'C');

// Sortie PDF
$pdf->Output("I", "Rapport_Projets_AJEFEM.pdf");
exit;
?>
