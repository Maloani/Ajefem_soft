<?php
// ============================================================================
// VERIFY.PHP — AJEFEM VERIFICATION SYSTEM (2025)
// Traçabilité des scans + Bouton WhatsApp de contact
// ============================================================================

header("Content-Type: text/html; charset=UTF-8");
ini_set('default_charset', 'UTF-8');

require_once "config.php";

// === CONFIG CONTACT ===
$whatsapp_number = "243826704930"; // À REMPLACER par le numéro officiel AJEFEM (ex: 243970000000)
$whatsapp_link   = "https://wa.me/" . $whatsapp_number . "?text=" . urlencode(
    "Bonjour AJEFEM, je vous contacte au sujet d'une vérification de carte de service."
);

// ===============================
// FONCTION DE LOG DES SCANS
// ===============================
function log_scan($pdo, $code, $status) {
    try {
        $ip  = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
        $ua  = $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';

        $stmt = $pdo->prepare("
            INSERT INTO ajefem_verifications (code_membre, statut, ip, user_agent)
            VALUES (:code, :statut, :ip, :ua)
        ");
        $stmt->execute([
            ":code"   => $code,
            ":statut" => $status,
            ":ip"     => $ip,
            ":ua"     => $ua
        ]);
    } catch (Exception $e) {
        // On ne casse pas la vérification en cas d'erreur de log
    }
}

// ===============================
// FONCTION AFFICHAGE ERREUR
// ===============================
function afficherErreur($msg, $whatsapp_link){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Carte non valide</title>
<style>
    body{
        background:#fff5f5;
        text-align:center;
        font-family:Arial, sans-serif;
        padding:40px;
    }
    .alert{
        background:#ffdddd;
        padding:20px;
        width:380px;
        margin:auto;
        border-left:8px solid #cc0000;
        border-radius:4px;
    }
    .alert strong{
        color:#7a0000;
        font-size:16px;
    }
    .footer{
        margin-top:25px;
        font-size:13px;
        color:#333;
    }
    .btn-wa{
        display:inline-block;
        margin-top:15px;
        background:#25D366;
        color:#fff;
        padding:8px 14px;
        text-decoration:none;
        border-radius:5px;
        font-size:13px;
    }
    .btn-wa:hover{
        background:#1eaf54;
    }
</style>
</head>
<body>

<div class="alert">
    <strong><?php echo htmlspecialchars($msg); ?></strong>
    <p>Merci de contacter immédiatement la Coordination Nationale AJEFEM.</p>

    <a href="<?php echo $whatsapp_link; ?>" class="btn-wa" target="_blank">
        Contacter AJEFEM via WhatsApp
    </a>
</div>

<div class="footer">
    Email : ajefemasbl@gmail.com<br>
    Site : <a href="https://www.ajefem.org">www.ajefem.org</a>
</div>

</body>
</html>
<?php
}

// ===============================
// VÉRIFICATION DU PARAMÈTRE ID
// ===============================
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    // On log aussi les tentatives sans ID
    log_scan($pdo, "NO_ID", "FAILED");
    afficherErreur("Identification échouée — Contacter AJEFEM", $whatsapp_link);
    exit;
}

$code = trim($_GET["id"]);

// ===============================
// RECHERCHE DU MEMBRE
// ===============================
$stmt = $pdo->prepare("SELECT * FROM membres_ajefem WHERE code_membre = :code LIMIT 1");
$stmt->execute([":code" => $code]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

// Si aucun membre trouvé → log + message d’échec
if (!$member) {
    log_scan($pdo, $code, "FAILED");
    afficherErreur("Identification échouée — Contacter AJEFEM", $whatsapp_link);
    exit;
}

// ===============================
// SI MEMBRE TROUVÉ → LOG SUCCÈS
// ===============================
log_scan($pdo, $code, "SUCCESS");

// Données du membre
$name       = htmlspecialchars($member["name"]);
$role       = htmlspecialchars($member["role"]);
$phone      = htmlspecialchars($member["phone"]);
$photo_path = "uploads/membres/" . $member["photo"];
$validite   = "Valide ✔️";

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Vérification AJEFEM</title>
<style>
    body{
        background:#f4f6f9;
        font-family:Arial, sans-serif;
        text-align:center;
        padding:20px;
    }
    .card{
        width:380px;
        background:#fff;
        padding:20px;
        margin:auto;
        border-radius:8px;
        box-shadow:0px 3px 12px rgba(0,0,0,0.15);
    }
    .card img{
        width:120px;
        height:140px;
        border-radius:6px;
        border:1px solid #ccc;
        object-fit:cover;
    }
    .badge{
        background:#1e7e34;
        color:#fff;
        padding:6px 10px;
        display:inline-block;
        border-radius:5px;
        font-size:12px;
        margin-bottom:5px;
    }
    .info{ font-size:14px; margin-top:7px; }
    .footer{
        margin-top:20px;
        font-size:12px;
        color:#555;
    }
    .btn-wa{
        display:inline-block;
        margin-top:15px;
        background:#25D366;
        color:#fff;
        padding:8px 16px;
        text-decoration:none;
        border-radius:5px;
        font-size:13px;
    }
    .btn-wa:hover{
        background:#1eaf54;
    }
</style>
</head>
<body>

<div class="card">
    <?php if(file_exists($photo_path)) : ?>
        <img src="<?php echo $photo_path; ?>" alt="Photo membre">
    <?php else : ?>
        <img src="img/default-user.png" alt="Aucune photo">
    <?php endif; ?>

    <h2><?php echo $name; ?></h2>
    <div class="badge"><?php echo $validite; ?></div>

    <div class="info"><strong>Fonction :</strong> <?php echo $role; ?></div>
    <div class="info"><strong>Code membre :</strong> <?php echo htmlspecialchars($code); ?></div>
    <div class="info"><strong>Téléphone :</strong> <?php echo $phone; ?></div>

    <a href="<?php echo $whatsapp_link; ?>" class="btn-wa" target="_blank">
        Contacter AJEFEM via WhatsApp
    </a>
</div>

<div class="footer">
    © AJEFEM — Actions de Jeunes et Femmes pour l’Entraide Mutuelle<br>
    verif@ajefem.org — <a href="https://www.ajefem.org">www.ajefem.org</a>
</div>


</body>
</html>
