<?php 
// ============================================================================
//        CARTE AJEFEM — Edition 2025 (UTF-8 Fix + Alignements Pro)
// ============================================================================

// Force l'encodage UTF-8
header("Content-Type: text/html; charset=UTF-8");
ini_set('default_charset', 'UTF-8');

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "config.php";
require_once "fpdf/code128.php";
require_once "phpqrcode/qrlib.php";

// Convertisseur UTF-8 → ISO pour FPDF
function utf8($s){
    return iconv("UTF-8","ISO-8859-1//TRANSLIT", $s);
}

// Vérification ID
if (!isset($_GET["id"])) die("ID manquant.");
$id = intval($_GET["id"]);

// Charger membre
$stmt = $pdo->prepare("SELECT * FROM membres_ajefem WHERE id = :id");
$stmt->execute([":id" => $id]);
$m = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$m) die("Membre introuvable.");

// Numéro adhésion
$numero_adhesion =
    "AJEFEM-" . strtoupper(substr($m["name"],0,3)) . "-" . date("Y") . "-" .
    str_pad($m["id"],3,"0",STR_PAD_LEFT);

// Chemins
$qr_dir = "uploads/qrcodes/";
$photo  = "uploads/membres/" . $m["photo"];
$drapeau = "img/drc.png";
$logo    = "img/logo_AJEFEM.png";
$cachet  = "img/sceau.JPG";
$sign    = "img/signatureg.PNG";
$hologram= "img/horlg.png";

if (!is_dir($qr_dir)) mkdir($qr_dir, 0777, true);

// QR
$qr_file = $qr_dir . "qr_" . $m["id"] . ".png";
QRcode::png("AJEFEM\nNom: {$m['name']}\nCode: {$m['code_membre']}\nTel: {$m['phone']}\nID: $numero_adhesion",
            $qr_file, QR_ECLEVEL_L, 4);

// PDF
$pdf = new PDF_Code128("L","mm",[110,90]);
$pdf->SetAutoPageBreak(false);

// ============================================================================
// RECTO
// ============================================================================
$pdf->AddPage();


// ============================================================================
//  EN-TÊTES AVANT LES BANDEAUX (VERSION EXACTE DU MODÈLE FOURNI)
// ============================================================================

// Fond bleu général
$pdf->SetFillColor(11, 61, 145);
$pdf->Rect(0, 0, 110, 10, "F");

// Logos (gauche = drapeau, droite = AJEFEM)
$pdf->Image($drapeau, 2, 1.5, 8);
$pdf->Image($logo, 100, 1.5, 8);



// ============================================================================
//  BANDEAUX RDC (PLACÉS APRÈS LES TEXTES, COMME SUR VOTRE IMAGE)
// ============================================================================
$pdf->SetFillColor(11,61,145);  // Bleu
$pdf->Rect(0, 10, 110, 4, "F");

$pdf->SetFillColor(255,205,0);  // Jaune
$pdf->Rect(0, 14, 110, 3, "F");

$pdf->SetFillColor(220,33,39);  // Rouge
$pdf->Rect(0, 17, 110, 3, "F");



$pdf->SetFillColor(220,33,39); $pdf->Rect(0,12,110,2,"F");

// Logos (gauche = drapeau, droite = AJEFEM)
$pdf->Image($drapeau, 2, 2, 8);
$pdf->Image($logo, 100, 2, 8);

// TITRE 1 – RÉPUBLIQUE DÉMOCRATIQUE DU CONGO (inchangé)
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",9);
$pdf->SetXY(0,2);
$pdf->Cell(110,6, utf8("RÉPUBLIQUE DÉMOCRATIQUE DU CONGO"), 0, 1, "C");

// TITRE 2 – DESCENDU SOUS LES LOGOS
$pdf->SetFont("Arial","B",9);
$pdf->SetXY(0,9);   // ← AU LIEU DE 7 (on descend sous les logos)
$pdf->Cell(110,6, utf8("ACTIONS DE JEUNES ET FEMMES POUR L’ENTRAIDE MUTUELLE"), 0, 1, "C");

// Bandeau bleu
$pdf->SetFillColor(11,61,145);
$pdf->Rect(0,17,110,8,"F");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",13);
$pdf->SetXY(0,18.5);
$pdf->Cell(110,6, utf8("CARTE DE MEMBRE OFFICIELLE"),0,1,"C");

// PHOTO
if (file_exists($photo)) $pdf->Image($photo,72,30,33,42);

// ============================================================================
// INFORMATIONS MEMBRE ALIGNÉES
// ============================================================================
$x = 5;
$y = 30;
$l = 7;

$pdf->SetFont("Arial","B",10);

// Nom
$pdf->SetTextColor(0,0,0);
$pdf->SetXY($x,$y);
$pdf->Cell(0,$l, utf8("Nom : ").utf8($m["name"]),0,1);

// Code (rouge)
$pdf->SetXY($x,$y+=$l);
$pdf->SetTextColor(220,0,0);
$pdf->Cell(0,$l, utf8("Code : ").$m["code_membre"],0,1);

// Sexe
$pdf->SetXY($x,$y+=$l);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0,$l, utf8("Sexe : ").$m["sex"],0,1);

// Téléphone
$pdf->SetXY($x,$y+=$l);
$pdf->Cell(0,$l, utf8("Téléphone : ").$m["phone"],0,1);

// Rôle (orange)
$pdf->SetXY($x,$y+=$l);
$pdf->SetTextColor(255,120,0);
$pdf->Cell(0,$l, utf8("Fonction : ").utf8($m["role"]),0,1);

// Numéro d’adhésion (bleu)
$pdf->SetXY($x,$y+=$l);
$pdf->SetTextColor(0,51,204);
$pdf->Cell(0,$l, utf8("N° Adhésion : ").$numero_adhesion,0,1);

// ============================================================================
// SIGNATURE + CACHET
// ============================================================================
// ============================================================================
// SIGNATURE + CACHET (VERSION OPTIMISÉE ET REMONTÉE)
// ============================================================================
$yB = 71;   // ← AU LIEU DE 75 (remonté précédemment) 

// Cachet (à gauche)
if (file_exists($cachet)) {
    $pdf->Image($cachet, 5, $yB, 22);  // taille plus propre
}

// Nom (ligne 1)
$pdf->SetFont("Arial","B",9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(40, $yB + 2);
$pdf->Cell(60, 5, utf8("PhD MALOANI SAIDI Georges"), 0, 1, "L");

// Signature (au milieu — alignée proprement, REMONTÉE)
if (file_exists($sign)) {
    $pdf->Image($sign, 45, $yB + 6, 28);   // ← AVANT : +10, maintenant : +6
}

// Fonction (ligne 3, REMONTÉE pour être bien visible)
$pdf->SetFont("Arial","I",9);
$pdf->SetXY(39, $yB + 15);   // ← AVANT : +22, maintenant : +18
$pdf->Cell(60, 5, utf8("Coordonnateur National"), 0, 1, "L");


// ============================================================================
//                           VERSO
// ============================================================================
$pdf->AddPage();

if (file_exists($hologram)) $pdf->Image($hologram,0,0,110,90);

$pdf->SetFillColor(39,174,96);
$pdf->Rect(0,0,110,12,"F");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",13);
$pdf->SetXY(0,2);
$pdf->Cell(110,8, utf8("COORDINATION NATIONALE"),0,1,"C");

// Texte
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","",10);
$pdf->SetXY(15,18);
$pdf->MultiCell(80,6, utf8(
"Les autorités civiles comme militaires sont priées 
de porter assistance au porteur de cette carte 
officielle d'identité AJEFEM."
),"0","C");

// QR
$pdf->Image($qr_file,44,38,22);



// Code-barres
$pdf->Code128(25,60,$numero_adhesion,60,10);

$pdf->SetFont("Arial","B",7);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(25,70);
$pdf->Cell(60,4,$numero_adhesion,0,1,"C");

// Pied en JAUNE
$pdf->SetFont("Arial","B",9);
$pdf->SetTextColor(255,255,0);
$pdf->SetXY(5,82);
$pdf->Cell(100,5, utf8("www.ajefem.org      Carte officielle sécurisée"),0,0,"C");

// SORTIE
$pdf->Output("I","CARTE_AJEFEM_{$m['id']}.pdf");
exit;

?>
