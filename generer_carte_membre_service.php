<?php 
// ============================================================================
//   CARTE DE SERVICE HUMANITAIRE — AJEFEM (Edition 2025)
//   Style ONG internationale (Option B)
// ============================================================================

// Encodage
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
$qr_dir  = "uploads/qrcodes/";
$photo   = "uploads/membres/" . $m["photo"];
$drapeau = "img/drc.png";
$logo    = "img/logo_AJEFEM.png";
$cachet  = "img/sceau.JPG";
$sign    = "img/signatureg.PNG";
//$hologram= "img/horlg.png";

if (!is_dir($qr_dir)) mkdir($qr_dir, 0777, true);

// QR CODE (infos sécurisées)
// QR CODE (infos sécurisées)
$qr_file = $qr_dir . "qr_" . $m["id"] . ".png";
$qr_texte  = "AJEFEM - Humanitarian ID Card\n";
$qr_texte .= "Nom : {$m['name']}\n";
$qr_texte .= "Code membre : {$m['code_membre']}\n";
$qr_texte .= "Téléphone : {$m['phone']}\n";
$qr_texte .= "N° Adhésion : {$numero_adhesion}\n";
$qr_texte .= "Vérification : https://www.ajefem.org/verify.php?id={$m['code_membre']}";


QRcode::png($qr_texte, $qr_file, QR_ECLEVEL_L, 4);

// PDF
$pdf = new PDF_Code128("L","mm",[110,90]);
$pdf->SetAutoPageBreak(false);


// ============================================================================
// RECTO — CARTE DE SERVICE ET PROTECTION HUMANITAIRE
// ============================================================================
$pdf->AddPage();

// =======================
// BANDEAU SUPÉRIEUR STYLE AJEFEM — Vert + Logo à gauche + Texte à droite
// =======================

$pdf->SetFillColor(39,174,96); // Vert AJEFEM
$pdf->Rect(0,0,110,20,"F");

// LOGO AJEFEM À GAUCHE (monté plus haut)
if (file_exists($logo)) {
    $pdf->Image($logo, 2, 2, 15); // Y = 2 (plus haut)
}

// TEXTE AJEFEM à droite du logo avec MultiCell
$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",10);

// Positionnement du texte après le logo
$pdf->SetXY(20, 4); // X = 20 pour ne pas toucher le logo

$pdf->MultiCell(
    88, // largeur disponible
    4.8, // hauteur de ligne
    utf8("Actions de Jeunes et Femmes pour l’Entraide Mutuelle (AJEFEM)"),
    0,
    "L" // Alignement à gauche
);




// =======================
// TITRE CARTE DE SERVICE — Ajusté sans chevauchement
// =======================

// 🟢 On colle directement au bandeau vert → suppression de l’espace blanc
$headerBottom = 20; 

$pdf->SetFillColor(11,61,145);
$pdf->Rect(0, $headerBottom, 110, 10, "F");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",13);
$pdf->SetXY(0, $headerBottom + 2.5);
$pdf->Cell(110, 4, utf8("CARTE DE SERVICE"), 0, 1, "C");

$pdf->SetFont("Arial","I",7);
$pdf->SetXY(0, $headerBottom + 7);
$pdf->Cell(110, 3, utf8("Service Card – Not transferable"), 0, 1, "C");


// =======================
// Position de départ du contenu
// =======================
$contentY = $headerBottom + 11;

// =======================
// PHOTO À DROITE - Alignement
// =======================
if (file_exists($photo)) {
    $pdf->SetFillColor(245,245,245);
    $pdf->Rect(73, $contentY, 33, 43, "F");
    $pdf->SetDrawColor(180,180,180);
    $pdf->Rect(73, $contentY, 33, 43);
    $pdf->Image($photo, 73.5, $contentY + 0.8, 31.8, 41.5);
}

// =======================
// INFORMATIONS MEMBRE — Colonne gauche
// =======================
$x = 5;
$y = $contentY;
$l = 6;

$pdf->SetFont("Arial","B",9);

// Nom — Police agrandie
$pdf->SetFont("Arial","B",11); // ⬅️ Agrandissement
$pdf->SetTextColor(0,0,0);
$pdf->SetXY($x, $y);
$pdf->Cell(60, $l, utf8(" ").utf8($m["name"]), 0, 1);

// (Optionnel mais recommandé)
// Revenir à la police précédente ensuite
$pdf->SetFont("Arial","B",9);

// Code membre
$pdf->SetTextColor(180,0,0);
$pdf->SetXY($x, $y += $l);
$pdf->Cell(60, $l, utf8("Code : ").$m["code_membre"], 0, 1);

// Téléphone
$pdf->SetTextColor(0,0,0);
$pdf->SetXY($x, $y += $l);
$pdf->Cell(60, $l, utf8("Téléphone : ").$m["phone"], 0, 1);

// Fonction
$pdf->SetTextColor(180,0,0);
$pdf->SetXY($x, $y += $l);
$pdf->Cell(60, $l, utf8("Fonction : ").utf8($m["role"]), 0, 1);


// =======================
// DATES EMISSION + VALIDITÉ
// =======================
$mois = [
 "01"=>"Janvier","02"=>"Février","03"=>"Mars","04"=>"Avril","05"=>"Mai","06"=>"Juin",
 "07"=>"Juillet","08"=>"Août","09"=>"Septembre","10"=>"Octobre","11"=>"Novembre","12"=>"Décembre"
];

$dateEmission = $m["date_emission"] ?? date("Y-m-d");
$moisEmis = $mois[date("m", strtotime($dateEmission))];
$anneeEmis = date("Y", strtotime($dateEmission));

// date expiration depuis BDD ou calcul
$dateExp = $m["date_expiration"] ?? date("Y-m-d", strtotime("+1 year"));
$moisExp = $mois[date("m", strtotime($dateExp))];
$anneeExp = date("Y", strtotime($dateExp));


$pdf->SetTextColor(255,140,0);
$pdf->SetXY($x, $y += $l);
$pdf->Cell(60, $l, utf8("Validité jusqu’au : $moisExp $anneeExp"), 0, 1);




// =======================
// SIGNATURE + CACHET
// =======================
$footerY = 67; // Position conservée

// 🖋 Nom du Coordonnateur
$pdf->SetFont("Arial","B",9);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(5, $footerY - 1);
$pdf->Cell(60, 5, utf8("Dr. MALOANI SAIDI George"), 0, 1, "L");

// ✍️ Signature
if (file_exists($sign)) {
    $pdf->Image($sign, 5, $footerY + 3, 26);
}

// 🛡️ Sceau rapproché du texte
if (file_exists($cachet)) {
    $pdf->Image($cachet, 48, $footerY - 5, 23); // ⬅️ ajusté !
}

// 🎯 Titre du Coordonnateur
$pdf->SetFont("Arial","I",8);
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(5, $footerY + 14);
$pdf->Cell(60, 4, utf8("Coordonnateur National"), 0, 1, "L");


// =======================
// Texte de sécurité — monté aussi
// =======================
$pdf->SetFont("Arial","I",5);
$pdf->SetTextColor(120,120,120);
$pdf->SetXY(5, $footerY + 20);
$pdf->Cell(100, 3, utf8("Cette carte est propriété exclusive de l’AJEFEM. Toute falsification ou usage abusif est strictement interdit."), 0, 0, "C");



// ============================================================================
// VERSO — MESSAGE HUMANITAIRE + QR CODE + Vérification en ligne
// ============================================================================
$pdf->AddPage();



// Bandeau haut vert (Coordination Nationale)
$pdf->SetFillColor(39,174,96);
$pdf->Rect(0,0,110,12,"F");

$pdf->SetTextColor(255,255,255);
$pdf->SetFont("Arial","B",11);
$pdf->SetXY(0,2);
$pdf->Cell(110,4, utf8("COORDINATION NATIONALE"), 0, 1, "C");

$pdf->SetFont("Arial","I",7);
$pdf->SetXY(0,7);
$pdf->Cell(110,3, utf8("Protection - Assistance - Accompagnement communautaire"), 0, 1, "C");


// Watermark AJEFEM en fond
$pdf->SetTextColor(230,230,230);
$pdf->SetFont("Arial","B",33);
$pdf->SetXY(10,33);
$pdf->Cell(90,14, utf8("AJEFEM"), 0, 1, "C");


// Texte humanitaire principal
$pdf->SetTextColor(0,0,0);
$pdf->SetFont("Arial","",9);
$pdf->SetXY(12,18);
$pdf->MultiCell(86,5, utf8(
"Les autorités civiles, militaires, policières et les organisations humanitaires sont priées de "
."faciliter, protéger et assister le porteur de cette carte dans l'exercice de ses fonctions, conformément "
."aux lois en vigueur et aux principes humanitaires."
), 0, "C");


// QR Code + Texte de vérification
if (file_exists($qr_file)) {
    $pdf->Image($qr_file, 44, 42, 22);

    // Texte FR/ENG sous QR
    $pdf->SetFont("Arial","B",6.5);
    $pdf->SetTextColor(0,0,80);
    $pdf->SetXY(10,65);
    $pdf->Cell(90,3, utf8("Scannez pour vérifier l'identité / Scan to verify identity"), 0, 1, "C");

    $pdf->SetFont("Arial","I",6);
    $pdf->SetTextColor(0,0,180);
    $pdf->SetXY(10,69);
    $pdf->Cell(90,3, utf8("www.ajefem.org/verify.php?id=" . $m["code_membre"]), 0, 1, "C");
}


// Principes humanitaires (ONU/ONG)
$pdf->SetFont("Arial","I",6);
$pdf->SetTextColor(80,80,80);
$pdf->SetXY(7,74);
$pdf->Cell(96,3, utf8("Principes : Humanité – Neutralité – Impartialité – Volontariat – Indépendance"), 0, 1, "C");


// Coordonnées AJEFEM — Bandeau bas
$pdf->SetFillColor(11,61,145);
$pdf->Rect(0,80,110,10,"F");

$pdf->SetTextColor(255,255,0);
$pdf->SetFont("Arial","B",8);
$pdf->SetXY(5,82);
$pdf->Cell(100,4, utf8("www.ajefem.org          ajefemasbl@gmail.com"), 0, 1, "C");

$pdf->SetFont("Arial","I",6);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(5,86);
$pdf->Cell(100,3, utf8("En cas de perte, rapporter cette carte à la Coordination Nationale AJEFEM."), 0, 1, "C");

// SORTIE
$pdf->Output("I","CARTE_AJEFEM_{$m['id']}.pdf");
exit;

?>
