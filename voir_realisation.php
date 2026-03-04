<?php
require_once "config.php";

/* ================================
     ðŸ”µ LANGUE
================================ */
$lang = $_GET["lang"] ?? "fr";
if (!in_array($lang, ["fr","en"])) $lang = "fr";

$txt = [
    "fr" => [
        "back"      => "Retour aux réalisations",
        "views"     => "vues",
        "read_more" => "Lire plus",
        "read_less" => "Voir moins"
    ],
    "en" => [
        "back"      => "Back to achievements",
        "views"     => "views",
        "read_more" => "Read more",
        "read_less" => "Show less"
    ]
];

/* ================================
     ðŸ”µ VÃ‰RIFICATION ID
================================ */
if (!isset($_GET["id"])) die("ID manquant.");
$id = intval($_GET["id"]);

/* ================================
     ðŸ”µ CHARGER LA RÃ‰ALISATION
================================ */
$stmt = $pdo->prepare("SELECT * FROM realisations WHERE id = :id");
$stmt->execute([":id" => $id]);
$r = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$r) die("RÃ©alisation introuvable");

/* ================================
     ðŸ”µ INCRÃ‰MENTER LES VUES
================================ */
$pdo->prepare("UPDATE realisations SET vues = vues + 1 WHERE id = :id")
    ->execute([":id" => $id]);

/* ================================
     ðŸ”µ FORMATAGE DATE
================================ */
if ($lang == "fr") setlocale(LC_TIME, "fr_FR.UTF-8", "French");
else setlocale(LC_TIME, "en_US.UTF-8", "English");

$date_formatted = strftime("%d %B %Y", strtotime($r["date_realisation"]));

/* ================================
     ðŸ”µ TEXTES MULTILINGUES
================================ */
$titre       = $lang == "fr" ? $r["titre_fr"]          : $r["titre_en"];
$description = $lang == "fr" ? $r["description_fr"]    : $r["description_en"];
$categorie   = $lang == "fr" ? $r["categorie_fr"]      : $r["categorie_en"];
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
<meta charset="UTF-8">
<title><?= htmlspecialchars($titre) ?> - AJEFEM</title>

<link rel="stylesheet" href="styles.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* DESIGN GLOBAL */
.rea-view-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 15px;
}

.rea-image {
    width: 100%;
    height: 380px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.25);
}

.rea-title {
    font-size: 32px;
    font-weight: bold;
    margin-top: 25px;
    color: #0b3d91;
}

.rea-meta {
    margin: 10px 0 20px;
    font-size: 15px;
    color: #666;
}

.rea-description {
    font-size: 19px;
    line-height: 1.8;
    color: #444;
    margin-bottom: 30px;
}

.show-more {
    color: #0b3d91;
    font-weight: bold;
    cursor: pointer;
    display: inline-block;
    margin-top: 10px;
}

.back-btn {
    padding: 12px 20px;
    background:#0b3d91;
    color:white;
    text-decoration:none;
    border-radius:8px;
    font-size:16px;
}

.back-btn:hover {
    background:#062e67;
}

/* ==========================================
   LOADER CIRCULAIRE AJEFEM + FADE-IN LOGO
========================================== */
#loader-circle-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease-out;
}

.loader-circle {
    width: 120px;
    height: 120px;
    border: 6px solid #dcdcdc;
    border-top: 6px solid #0b3d91;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* LOGO AVEC FADE-IN */
.loader-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
    border-radius: 50%;
    opacity: 0;              /* invisible au début */
    animation: fadeIn 1.2s ease-in forwards;
}

/* TEXTE */
.loader-text {
    margin-top: 18px;
    font-size: 17px;
    color: #0b3d91;
    font-weight: 600;
}

/* Animation rotation cercle */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Animation fade-in logo */
@keyframes fadeIn {
    0% { opacity: 0; transform: scale(0.85); }
    100% { opacity: 1; transform: scale(1); }
}
/* ================================
   DESIGN GLOBAL PREMIUM AJEFEM
================================ */
.rea-view-container {
    max-width: 1050px;
    margin: 60px auto;
    padding: 20px;
    background: #ffffff;
}

.rea-image {
    width: 100%;
    height: auto;          /* L’image garde sa hauteur naturelle */
    max-height: 520px;     /* Limite propre mais flexible */
    object-fit: contain;   /* Affiche toute l’image */
    background: #f2f2f2;   /* Fond propre si image non remplie */
    border-radius: 18px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.25);
    padding: 8px;          /* optionnel pour belle présentation */
    transition: transform 0.35s ease;
}


.rea-image:hover {
    transform: scale(1.01);
}

/* ================================
   TITRE PREMIUM + DÉGRADÉ
================================ */
.rea-title {
    font-size: 36px;
    font-weight: 800;
    margin-top: 30px;
    line-height: 1.25;

    background: linear-gradient(90deg, #0b3d91, #07306e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    position: relative;
}

.rea-title::after {
    content: "";
    display: block;
    width: 80px;
    height: 4px;
    background: #0b3d91;
    margin-top: 10px;
    border-radius: 2px;
}

/* ================================
   META INFO (catégorie, date, vues)
================================ */
.rea-meta {
    margin: 25px 0 35px;
    font-size: 17px;
    font-weight: 500;
    
    color: #444;
    padding: 15px 20px;
    border-left: 4px solid #0b3d91;
    background: #f8f9ff;
    border-radius: 8px;
    line-height: 1.8;
}

.rea-meta i {
    color: #0b3d91;
}

/* ================================
   DESCRIPTION + LIRE PLUS
================================ */
.rea-description {
    font-size: 20px;
    line-height: 1.9;
    color: #333;
    margin-bottom: 30px;
    text-align: justify;
}

.show-more {
    color: #0b3d91;
    font-weight: 700;
    font-size: 18px;
    cursor: pointer;

    display: inline-flex;
    align-items: center;
    gap: 6px;

    transition: color 0.2s ease;
}

.show-more:hover {
    color: #062e67;
}

.show-more::after {
    content: "\f078";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    transition: transform 0.3s ease;
}

.show-more.active::after {
    transform: rotate(180deg);
}

/* ================================
   BOUTON RETOUR PREMIUM
================================ */
.back-btn {
    padding: 14px 22px;
    background: linear-gradient(90deg, #0b3d91, #062e67);
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-size: 17px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 10px;

    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.back-btn:hover {
    transform: translateX(-4px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.25);
}

/* ================================
   LOADER PREMIUM AJEFEM
================================ */
#loader-circle-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease-out;
}

.loader-circle {
    width: 120px;
    height: 120px;
    border: 6px solid #dcdcdc;
    border-top: 6px solid #0b3d91;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    display: flex;
    justify-content: center;
    align-items: center;
}

.loader-logo {
    width: 55px;
    height: 55px;
    object-fit: contain;
    border-radius: 50%;
    opacity: 0;
    animation: fadeIn 1.2s ease-in forwards;
}

.loader-text {
    margin-top: 18px;
    font-size: 17px;
    color: #0b3d91;
    font-weight: 600;
}

@keyframes spin { 
    0% { transform: rotate(0deg); } 
    100% { transform: rotate(360deg); } 
}

@keyframes fadeIn {
    0% { opacity: 0; transform: scale(0.85); }
    100% { opacity: 1; transform: scale(1); }
}
/* BOX PRINCIPALE */
.share-box {
    margin-top: 35px;
    padding: 22px 20px;
    background: #f4f7ff;
    border-radius: 14px;
    border-left: 5px solid #0b3d91;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
}

/* TITRE */
.share-title {
    font-size: 19px;
    font-weight: 800;
    color: #0b3d91;
    margin-bottom: 14px;
}

/* BOUTONS */
.share-btn {
    display: inline-flex;
    justify-content: center;
    align-items: center;

    width: 46px;
    height: 46px;
    margin-right: 8px;

    color: white;
    font-size: 22px;

    border-radius: 50%;
    text-decoration: none;

    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.share-btn:hover {
    transform: translateY(-4px) scale(1.08);
    box-shadow: 0 6px 18px rgba(0,0,0,0.25);
}

/* Couleurs officielles */
.whatsapp { background: #25D366; }
.facebook { background: #1877F2; }
.twitter  { background: #000; }
.linkedin { background: #0A66C2; }
.telegram { background: #0088CC; }

/* COMPTEUR */
.share-count {
    margin-top: 15px;
    font-weight: 700;
    color: #0b3d91;
    font-size: 16px;
}

/* QR CODE */
.qr-box {
    margin-top: 20px;
    text-align: center;
}

.qr-image {
    width: 160px;
    height: 160px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.qr-text {
    font-size: 14px;
    margin-top: 6px;
    color: #333;
}
/* DIVISEUR */
.divider-comments {
    margin: 50px 0 30px;
    border: 0;
    border-top: 3px solid #0b3d91;
    width: 180px;
}

/* TITRE COMMENTAIRES */
.comments-title {
    font-size: 28px;
    font-weight: 800;
    color: #0b3d91;
    margin-bottom: 22px;
}

/* CONTAINER */
.comments-container {
    padding: 20px;
    background: #f4f7ff;
    border-radius: 12px;
    border-left: 5px solid #0b3d91;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}

/* Disqus box */
.disqus-box {
    margin-top: 35px;
}

/* HERO BANNER GLOBAL */
.hero-banner {
    position: relative;
    width: 100%;
    margin-bottom: 35px;
}

/* Image affichée en entier */
.hero-image {
    width: 100%;
    max-height: 480px;
    object-fit: contain;
    background: #f0f0f0;
    border-radius: 16px;
    padding: 5px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.25);
}

/* Bandeau superposé */
.hero-overlay {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);

    width: 92%;
    padding: 15px 20px;

   

    display: flex;
    align-items: center;
    gap: 18px;

    border-radius: 12px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.3);

    backdrop-filter: blur(6px);
}

/* Logo dans bandeau */
.hero-logo {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    object-fit: contain;
    background: white;
    padding: 4px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

/* Titre professionnel AJEFEM */
.hero-title {
    font-size: 26px;
    font-weight: 800;
    margin: 0;

    line-height: 1.3;
    text-shadow: 0 2px 10px rgba(0,0,0,0.6);
}

/* Responsive mobile */
@media(max-width: 650px){
    .hero-logo { width: 45px; height: 45px; }
    .hero-title { font-size: 20px; }
    .hero-overlay { padding: 10px 15px; gap: 10px; }
}

</style>

</head>
<body>
    
 <!-- ====== LOADER CIRCULAIRE AJEFEM ====== -->
<div id="loader-circle-container">
    <div class="loader-circle">
        <img src="img/logo_AJEFEM.png" class="loader-logo fade-in-logo">
    </div>
    <p class="loader-text">Chargement...</p>
</div>


<div class="rea-view-container">

    <div class="hero-banner">
    <img src="uploads/realisations/<?= $r['image_principale'] ?>" class="hero-image">

    <div class="hero-overlay">
        <img src="img/logo_AJEFEM.png" class="hero-logo">
       
    </div>
</div>


    <h1 class="rea-title"><?= htmlspecialchars($titre) ?></h1>

    <div class="rea-meta">
        <i class="fa-solid fa-tag"></i> <?= htmlspecialchars($categorie) ?>
        &nbsp; | &nbsp;
        <i class="fa-solid fa-calendar"></i> <?= $date_formatted ?>
        &nbsp; | &nbsp;
        <i class="fa-solid fa-eye"></i> <?= $r["vues"] ?> <?= $txt[$lang]["views"] ?>
    </div>

    <!-- DESCRIPTION AVEC LIRE PLUS -->
    <div id="textContent" class="rea-description">
        <?= nl2br(htmlspecialchars($description)) ?>
    </div>

    <span id="toggleBtn" class="show-more"><?= $txt[$lang]["read_more"] ?></span>

    <br><br>

    <a href="realisations.php?lang=<?= $lang ?>" class="back-btn">
        <i class="fa-solid fa-arrow-left"></i> <?= $txt[$lang]["back"] ?>
    </a>
    <br><br>

<div class="share-box">

    <p class="share-title">Partager cette publication :</p>

    <!-- WhatsApp -->
    <a onclick="countShare()" 
       href="https://api.whatsapp.com/send?text=<?= urlencode($titre . ' - https://ajefem.org/voir_realisation.php?id=' . $id) ?>"
       target="_blank" class="share-btn whatsapp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <!-- Facebook -->
    <a onclick="countShare()"
       href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode('https://ajefem.org/voir_realisation.php?id=' . $id) ?>"
       target="_blank" class="share-btn facebook">
        <i class="fa-brands fa-facebook-f"></i>
    </a>

    <!-- X / Twitter -->
    <a onclick="countShare()"
       href="https://twitter.com/intent/tweet?url=<?= urlencode('https://ajefem.org/voir_realisation.php?id=' . $id) ?>&text=<?= urlencode($titre) ?>"
       target="_blank" class="share-btn twitter">
        <i class="fa-brands fa-x-twitter"></i>
    </a>

    <!-- LinkedIn -->
    <a onclick="countShare()"
       href="https://www.linkedin.com/shareArticle?mini=true&url=<?= urlencode('https://ajefem.org/voir_realisation.php?id=' . $id) ?>&title=<?= urlencode($titre) ?>"
       target="_blank" class="share-btn linkedin">
        <i class="fa-brands fa-linkedin"></i>
    </a>

    <!-- Telegram -->
    <a onclick="countShare()"
       href="https://t.me/share/url?url=<?= urlencode('https://ajefem.org/voir_realisation.php?id=' . $id) ?>&text=<?= urlencode($titre) ?>"
       target="_blank" class="share-btn telegram">
        <i class="fa-brands fa-telegram"></i>
    </a>

    <div class="share-count">
        <i class="fa-solid fa-share-nodes"></i>
        Partages : <span id="shareTotal"><?= $r["partages"] ?></span>
    </div>

    <div class="qr-box">
        <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=<?= urlencode('https://ajefem.org/voir_realisation.php?id=' . $id) ?>"
             alt="QR Code" class="qr-image">
        <p class="qr-text">Scanner pour partager</p>
    </div>

</div>
<hr class="divider-comments">

<h2 class="comments-title">
    💬 Commentaires
</h2>

<div class="comments-container">

    <!-- ======== FACEBOOK COMMENTS ======== -->
    <div class="fb-comments"
         data-href="https://ajefem.org/voir_realisation.php?id=<?= $id ?>"
         data-width="100%"
         data-numposts="5">
    </div>

    <!-- ======== DISQUS COMMENTS ======== -->
    <div id="disqus_thread" class="disqus-box"></div>

</div>


</div>

<script>
/* Lire plus / Voir moins */
const maxLength = 600;
const content = document.getElementById("textContent");
const toggleBtn = document.getElementById("toggleBtn");

let fullText = content.innerHTML;
let shortText = fullText.substring(0, maxLength) + "...";

if (fullText.length <= maxLength) {
    toggleBtn.style.display = "none";
} else {
    content.innerHTML = shortText;
}

let expanded = false;

toggleBtn.addEventListener("click", () => {
    expanded = !expanded;

    if (expanded) {
        content.innerHTML = fullText;
        toggleBtn.classList.add("active");
        toggleBtn.innerHTML = "<?= $txt[$lang]['read_less'] ?>";
    } else {
        content.innerHTML = shortText;
        toggleBtn.classList.remove("active");
        toggleBtn.innerHTML = "<?= $txt[$lang]['read_more'] ?>";
    }
});

</script>
<script>
// ==========================================
// FADE-OUT DU LOADER APRÈS CHARGEMENT
// ==========================================
document.addEventListener("DOMContentLoaded", () => {
    setTimeout(() => {
        const loader = document.getElementById('loader-circle-container');
        loader.style.opacity = "0";
        setTimeout(() => loader.style.display = "none", 500);
    }, 1400); // 1.4s pour laisser le fade-in du logo se terminer
});
</script>
<!-- Facebook SDK -->
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v17.0"
        nonce="AJEFEM">
</script>

</body>
</html>
