<?php
ob_start();
session_start();

if (!isset($_SESSION["logged_in"]) || strtolower($_SESSION["role"]) !== "admin") {
    exit("Acces refuse");
}

require_once "config.php";
require_once "fpdf/fpdf.php";

/* =========================
   NETTOYAGE TEXTE
========================= */
function cleanText($text){
    return iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $text);
}

/* =========================
   CLASSE PDF PRESIDENTIELLE
========================= */
class PDF extends FPDF {

    public $totalGeneral;
    public $totalHommes;
    public $totalFemmes;

    function Header() {

        if ($this->PageNo() == 1) {

            if (file_exists("img/logo_AJEFEM.png")) {
                $this->Image("img/logo_AJEFEM.png", 15, 8, 25);
            }

            $this->SetFont('Arial','I',10);
            $this->Cell(0,5,'Republique Democratique du Congo',0,1,'C');

            $this->SetFont('Arial','B',14);
            $this->SetTextColor(0,102,204);
            $this->Cell(0,7,"ACTIONS DE JEUNES ET FEMMES POUR L'ENTRAIDE MUTUELLE",0,1,'C');

            $this->SetTextColor(0);
            $this->SetFont('Arial','B',12);
            $this->Cell(0,6,"YOUTH AND WOMEN'S ACTIONS FOR MUTUAL AID",0,1,'C');

            $this->Ln(5);

            // STATISTIQUES COLOREES
            $this->SetFont('Arial','B',11);

            // Total General (Bleu)
            $this->SetTextColor(0,0,200);
            $this->Cell(90,8,'TOTAL GENERAL : '.$this->totalGeneral,1,0,'C');

            // Total Femmes (Vert)
            $this->SetTextColor(0,150,0);
            $this->Cell(90,8,'TOTAL FEMMES : '.$this->totalFemmes,1,0,'C');

            // Total Hommes (Rouge)
            $this->SetTextColor(200,0,0);
            $this->Cell(90,8,'TOTAL HOMMES : '.$this->totalHommes,1,1,'C');

            $this->SetTextColor(0);
            $this->Ln(8);
        }

        // Watermark discret
        $this->SetFont('Arial','B',50);
        $this->SetTextColor(235,235,235);
        $this->Text(80,150,'AJEFEM');
        $this->SetTextColor(0);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,8,'Page '.$this->PageNo().'/{nb} | AJEFEM Soft, logiciel performant 2026',0,0,'C');
    }

    function NbLines($w, $txt){
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1; $i = 0; $j = 0; $l = 0; $nl = 1;
        while($i<$nb){
            $c = $s[$i];
            if($c=="\n"){ $i++; $sep = -1; $j = $i; $l = 0; $nl++; continue; }
            if($c==' ') $sep = $i;
            $l += $cw[$c];
            if($l>$wmax){
                if($sep==-1){ if($i==$j) $i++; }
                else $i = $sep+1;
                $sep = -1; $j = $i; $l = 0; $nl++;
            }
            else $i++;
        }
        return $nl;
    }
}

/* =========================
   DONNEES (ORDRE ALPHABETIQUE)
========================= */
$sql = "SELECT * FROM membres_ajefem ORDER BY name ASC";
$stmt = $pdo->query($sql);
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* =========================
   CALCUL STATISTIQUES
========================= */
$totalGeneral = count($membres);
$totalHommes = 0;
$totalFemmes = 0;

foreach ($membres as $m) {
    if (($m['sex'] ?? '') == 'M') $totalHommes++;
    if (($m['sex'] ?? '') == 'F') $totalFemmes++;
}

/* =========================
   INITIALISATION PDF
========================= */
$pdf = new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->totalGeneral = $totalGeneral;
$pdf->totalHommes = $totalHommes;
$pdf->totalFemmes = $totalFemmes;
$pdf->AddPage();

/* =========================
   TITRE
========================= */
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,8,'LISTE OFFICIELLE DES MEMBRES AJEFEM',0,1,'C');
$pdf->Ln(5);

/* =========================
   TABLEAU (SANS PHOTO)
========================= */

$w = [15, 80, 60, 25, 105];
// N, Nom, Telephone, Sexe, Role

$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(11,61,145);
$pdf->SetTextColor(255);

$headers = ['N','Nom','Telephone','Sexe','Role / Fonction'];

for($i=0;$i<count($headers);$i++)
    $pdf->Cell($w[$i],8,$headers[$i],1,0,'C',true);
$pdf->Ln();

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0);

$fill=false;
$num=1;

foreach ($membres as $m){

    $name  = cleanText($m['name'] ?? '');
    $phone = cleanText($m['phone'] ?? '-');
    $role  = cleanText($m['role'] ?? '-');

    $roleLines = $pdf->NbLines($w[4],$role);
    $rowHeight = max(8, $roleLines * 6);

    if ($pdf->GetY()+$rowHeight > 185){
        $pdf->AddPage();
        $pdf->Ln(5);
    }

    $pdf->SetFillColor($fill ? 245 : 255);

    $pdf->Cell($w[0],$rowHeight,$num,1,0,'C',$fill);
    $pdf->Cell($w[1],$rowHeight,$name,1,0,'L',$fill);
    $pdf->Cell($w[2],$rowHeight,$phone,1,0,'L',$fill);
    $pdf->Cell($w[3],$rowHeight,$m['sex'] ?? '-',1,0,'C',$fill);
    $pdf->MultiCell($w[4],6,$role,1,'L',$fill);

    $fill=!$fill;
    $num++;
}

ob_end_clean();
$pdf->Output('I','AJEFEM_SUPREME_PRESIDENTIEL_2026.pdf');
