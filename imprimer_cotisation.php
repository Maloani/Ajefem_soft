<?php 
// ============================================================================
//        REÇU DE COTISATION AJEFEM — PDF OFFICIEL (Version Cachet/Signature)
// ============================================================================

header("Content-Type: application/pdf; charset=UTF-8");
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config.php";
require_once "fpdf/code128.php";
require_once "phpqrcode/qrlib.php";

// Convert UTF-8 → ISO pour compatibilité PDF
function iso($text){
    return iconv('UTF-8','ISO-8859-1//TRANSLIT',$text);
}

// Vérification ID
if (!isset($_GET["id"])) die("ID manquant !");
$id = intval($_GET["id"]);

// Charger la cotisation + membre
$stmt = $pdo->prepare("
    SELECT c.*, m.name, m.code_membre, m.phone
    FROM cotisations_ajefem c
    JOIN membres_ajefem m ON m.code_membre = c.code_membre
    WHERE c.id_cotisation = :id
");
$stmt->execute([":id" => $id]);
$c = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$c) die("Reçu introuvable !");

// Numéro Reçu Unique
$numero_recu = "AJF-" . str_pad($c["id_cotisation"],5,"0",STR_PAD_LEFT);

// Chemin QR
$qr_dir = "uploads/qrcot/";
if (!is_dir($qr_dir)) mkdir($qr_dir,0777,true);
$qr_file = $qr_dir . "qr_cot_" . $id . ".png";

QRcode::png("Reçu AJEFEM\nNom: {$c['name']}\nMontant: {$c['montant']} USD\nDate: {$c['date_paiement']}\nReçu: $numero_recu",
            $qr_file, QR_ECLEVEL_L, 4);

$logo    = "img/logo_AJEFEM.png";
$cachet  = "img/sceau.JPG";
$sign    = "img/signatureg.PNG";

// PDF
$pdf = new FPDF("P","mm","A5");
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();

// En-tête
$pdf->SetFillColor(11,61,145);
$pdf->Rect(0,0,150,18,"F");
$pdf->Image($logo,6,2,14);
$pdf->SetFont("Arial","B",13);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(150,12, iso("REÇU OFFICIEL DE COTISATION AJEFEM"),0,1,"C");

// Bande Jaune
$pdf->SetFillColor(255,205,0);
$pdf->Rect(0,18,150,3,"F");
$pdf->Ln(6);

// Informations
$pdf->SetFont("Arial","B",12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,6, iso("Détails du Paiement :"),0,1);

$pdf->SetFont("Arial","",11);
$l = 7;
$pdf->Ln(3);

$pdf->Cell(0,$l, iso("Nom : ").iso($c["name"]),0,1);
$pdf->Cell(0,$l, iso("Code membre : ").$c["code_membre"],0,1);
$pdf->Cell(0,$l, iso("Téléphone : ").$c["phone"],0,1);

$pdf->SetFont("Arial","B",11);
$pdf->SetTextColor(220,0,0);
$pdf->Cell(0,$l, iso("Montant payé : ").$c["montant"]." USD",0,1);

$pdf->SetFont("Arial","",11);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,$l, iso("Mode : ").$c["mode_paiement"],0,1);
$pdf->Cell(0,$l, iso("Date : ").$c["date_paiement"],0,1);

if (!empty($c["commentaire"])) {
    $pdf->MultiCell(0,$l, iso("Commentaire : ").iso($c["commentaire"]));
}

$pdf->Ln(4);

// QR Code
if (file_exists($qr_file)) {
    $pdf->Image($qr_file,113,30,28);
}


// Pied
$pdf->SetFont("Arial","B",9);
$pdf->SetTextColor(0,51,204);
$pdf->SetXY(5, 115);
$pdf->Cell(140,5, iso("www.ajefem.org — Solidarité & Entraide Mutuelle"),0,0,"C");

$pdf->Output("I","Recu_Cotisation_{$numero_recu}.pdf");
exit;
