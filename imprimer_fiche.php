<?php
// ================================================================
//  FICHE D’ADHÉSION AJEFEM – VERSION A4 VERTICALE AVEC PHOTO
// ================================================================

header("Content-Type: application/pdf");
require_once "config.php";
require_once "fpdf/fpdf.php";
require_once "phpqrcode/qrlib.php";

// ----- Convertisseur UTF-8 → ISO pour FPDF -----
function txt($t) {
    return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $t);
}

// Vérification ID
if (!isset($_GET["id"])) die("ID manquant.");
$id = intval($_GET["id"]);

// Charger membre
$stmt = $pdo->prepare("SELECT * FROM membres_ajefem WHERE id=:id");
$stmt->execute([":id"=>$id]);
$m = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$m) die("Membre introuvable.");

// Numéro d'adhésion
$numero_adhesion = "AJEFEM-".strtoupper(substr($m["name"],0,3))."-".date("Y")."-".str_pad($m["id"],3,"0",STR_PAD_LEFT);

// Chemins images
$photo   = "uploads/membres/".$m["photo"];
$logo    = "img/logo_AJEFEM.png";
$drapeau = "img/drc.png";
$cachet  = "img/sceau.JPG";  // ⚠️ mettez votre cachet ici
$sign    = "img/signatureg.PNG";

// QR CODE
$qr_dir = "uploads/qrcodes/";
if (!is_dir($qr_dir)) mkdir($qr_dir,0777,true);

$qr_file = $qr_dir . "qr_fiche_" . $m["id"] . ".png";
QRcode::png(
    "FICHE OFFICIELLE D'ADHESION AJEFEM ASBL\nNom: ".$m['name']."\nCode: ".$m['code_membre'].
    "\nTel: ".$m['phone']."\nFonction: ".$m['role']."\nID: ".$numero_adhesion,
    $qr_file,
    QR_ECLEVEL_L,
    5
);

// ================================================================
//  PDF A4
// ================================================================
$pdf = new FPDF("P","mm","A4");
$pdf->AddPage();

// ===================== MARGES INTERNES =========================
// Aucune information ne touchera les bordures
$leftMargin  = 15;
$rightMargin = 195;
$pdf->SetLeftMargin($leftMargin);
$pdf->SetRightMargin(210 - $rightMargin);
$pdf->SetXY($leftMargin, 10);

// ================================================================
//  BORDURES MULTICOLORES RDC
// ================================================================
$bleu=[11,61,145];
$jaune=[255,205,0];
$rouge=[220,33,39];

// --- Haut ---
$pdf->SetFillColor(...$bleu);  $pdf->Rect(5,5,200,2,"F");
$pdf->SetFillColor(...$jaune); $pdf->Rect(5,7,200,2,"F");
$pdf->SetFillColor(...$rouge); $pdf->Rect(5,9,200,2,"F");

// --- Bas ---
$pdf->SetFillColor(...$bleu);  $pdf->Rect(5,287,200,2,"F");
$pdf->SetFillColor(...$jaune); $pdf->Rect(5,289,200,2,"F");
$pdf->SetFillColor(...$rouge); $pdf->Rect(5,291,200,2,"F");

// --- Gauche ---
$pdf->SetFillColor(...$bleu);  $pdf->Rect(5,10,2,279,"F");
$pdf->SetFillColor(...$jaune); $pdf->Rect(7,10,2,279,"F");
$pdf->SetFillColor(...$rouge); $pdf->Rect(9,10,2,279,"F");

// --- Droite ---
$pdf->SetFillColor(...$bleu);  $pdf->Rect(203,10,2,279,"F");
$pdf->SetFillColor(...$jaune); $pdf->Rect(205,10,2,279,"F");
$pdf->SetFillColor(...$rouge); $pdf->Rect(207,10,2,279,"F");

// ================================================================
//  EN-TÊTE
// ================================================================
$pdf->Image($drapeau, $leftMargin, 18, 22);
$pdf->Image($logo,    $rightMargin - 22, 18, 22);

// ===== TITRE 1 : AJEFEM =====
$pdf->SetFont("Arial","B",14);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY($leftMargin, 10);
$pdf->Cell(180,10,txt("ACTIONS DE JEUNES ET FEMMES POUR L’ENTRAIDE MUTUELLE"),0,1,"C");

// Petit espace
$pdf->Ln(2);

// ===== TITRE 2 : AJEFEM ASBL =====
$pdf->SetFont("Arial","B",18);
$pdf->SetTextColor(0,150,0);
$pdf->SetXY($leftMargin, 22);
$pdf->Cell(180,10,txt("AJEFEM ASBL"),0,1,"C");

$pdf->Ln(2);

// ================================================================
//  DÉGRADÉ
// ================================================================
$startY = 40;
$height = 12;

$startR = 180; $startG = 200; $startB = 255;
$endR   = 230; $endG   = 240; $endB   = 255;

for ($i = 0; $i < $height; $i++) {
    $r = $startR + ($endR - $startR) * ($i / $height);
    $g = $startG + ($endG - $startG) * ($i / $height);
    $b = $startB + ($endB - $startB) * ($i / $height);

    $pdf->SetFillColor($r, $g, $b);
    $pdf->Rect($leftMargin, $startY + $i, 180, 1, "F");
}

// ===== TITRE OFFICIEL =====
$pdf->SetFont("Arial","B",19);
$pdf->SetTextColor(0,0,120);
$pdf->SetXY($leftMargin, $startY + 2);
$pdf->Cell(180,10,txt("FICHE D’ADHÉSION OFFICIELLE"),0,1,"C");

$pdf->Ln(5);

// ================================================================
//  PHOTO
// ================================================================
if (file_exists($photo)) {
    $pdf->Image($photo, $rightMargin - 40, 55, 40, 45);
}

$pdf->SetFont("Arial","B",14);
$pdf->Cell(180,10,txt("Informations du membre"),0,1,"C");

// ================================================================
//  DONNÉES MEMBRE
// ================================================================
$pdf->SetFont("Arial","",12);

function lineInfo($label,$value,$color=null){
    global $pdf, $leftMargin;
    $pdf->SetX($leftMargin);
    $pdf->SetFont("Arial","B",12);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(50,8,txt($label),0,0);

    if ($color) $pdf->SetTextColor($color[0],$color[1],$color[2]);
    else $pdf->SetTextColor(0,0,0);

    $pdf->SetFont("Arial","",12);
    $pdf->Cell(0,8,txt($value),0,1);
}

lineInfo("Nom complet :", $m["name"]);
lineInfo("Code membre :", $m["code_membre"], [200,0,0]);
lineInfo("Sexe :", $m["sex"]);
lineInfo("Téléphone :", $m["phone"]);
lineInfo("Adresse :", $m["address"]);
lineInfo("Fonction :", $m["role"], [255,120,0]);
lineInfo("N° d’adhésion :", $numero_adhesion, [0,51,204]);

$pdf->Ln(6);

// ================================================================
//  MESSAGE D’ADHÉSION
// ================================================================
$pdf->SetFont("Arial","",10);
$pdf->SetTextColor(0,0,0);
$pdf->MultiCell(180, 6, txt(
    "Votre adhésion à l’AJEFEM confirme votre engagement à promouvoir ".
    "la solidarité, le développement communautaire, la paix et l’autonomisation ".
    "des femmes et des jeunes."
));

$pdf->Ln(6);

$pdf->SetFont("Arial","I",10);
$pdf->MultiCell(180, 6, txt(
    "Nous vous souhaitons la bienvenue au sein de l’ASBL."
));

$pdf->Ln(6);

// ================================================================
//  QR CODE
// ================================================================
$pdf->SetFont("Arial","B",12);
$pdf->Cell(180,8,txt("QR Code de contrôle"),0,1,"C");

$qr_y = $pdf->GetY();
$pdf->Image($qr_file, $leftMargin + 20, $qr_y, 45);
$pdf->Ln(58);

// ================================================================
//  SIGNATURE + CACHET
// ================================================================
// ================================================================


// ================================================================
//  SIGNATURE + CACHET (cachet rapproché de la signature)
// ================================================================

// Cachet AJEFEM à droite, proche de la signature
// ↓↓↓ Ajustement : rapproché de +18 mm vers la gauche et +3 mm plus haut
$pdf->Image($cachet, $leftMargin + 130, 223, 22);

// Nom (centré horizontalement)
$pdf->SetFont("Arial","B",10);
$pdf->SetXY($leftMargin + 55,220);
$pdf->Cell(100,6,txt("PhD. MALOANI SAIDI Georges"),0,1,"C");

// Signature centrée sous le nom
if (file_exists($sign)) {
    $pdf->Image($sign, $leftMargin + 80, 228, 25);
}

// Fonction / Titre (centré)
$pdf->SetFont("Arial","I",10);
$pdf->SetXY($leftMargin + 55,246);
$pdf->Cell(100,6,txt("Coordonnateur National"),0,1,"C");


// ================================================================
//  CONTACT
// ================================================================
$pdf->Ln(4);   // ← AVANT : 10 (réduit pour remonter tout le bloc)
$pdf->SetFont("Arial","B",9);
$pdf->SetTextColor(0,0,150);
$pdf->SetXY($leftMargin, $pdf->GetY());
$pdf->Cell(180,7,txt("Contact : ajefemasbl@gmail.com"),0,1,"C");

// ================================================================
//  AVERTISSEMENT (NB remonté)
// ================================================================
$pdf->Ln(1);   // ← AVANT : 3 (rapproche davantage)
$pdf->SetFont("Arial","I",8);
$pdf->SetTextColor(180,0,0);

$y = $pdf->GetY();
$pdf->SetDrawColor(180,0,0);
$pdf->SetLineWidth(0.2);

// Box NB plus proche du contact
$pdf->SetXY($leftMargin, $y);
$pdf->MultiCell(180, 5, txt(
    "NB : En cas de perte de cette fiche d’adhésion, aucun duplicata ne sera délivré. Veuillez la conserver soigneusement."
), 1, "C");


// ================================================================
//  FIN
// ================================================================
$pdf->Output("I","FICHE_ADHESION_{$m['id']}.pdf");
exit;
?>
