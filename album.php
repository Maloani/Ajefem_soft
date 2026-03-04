<?php
// =============================
//        GESTION LANGUE
// =============================
$lang = $_GET['lang'] ?? 'fr';
if (!in_array($lang, ['fr','en'])) $lang = 'fr';

// =============================
//      TITRES DYNAMIQUES
// =============================
$events = [
    1 => [
        "fr" => "Journée de sensibilisation",
        "en" => "Awareness Day"
    ],
    2 => [
        "fr" => "Formation des femmes",
        "en" => "Women Training Session"
    ],
    3 => [
        "fr" => "Distribution d'aides",
        "en" => "Aid Distribution"
    ]
];

$event_id = $_GET["event"] ?? 1;
$event_title = $events[$event_id][$lang] ?? "Album";

// =============================
//      TRADUCTIONS
// =============================
$text = [
"fr" => [
    "subtitle_header" => "Action de Jeunes et Femmes pour l’Entraide Mutuelle",
    "back" => "← Retour à la galerie",
    "footer_text" => "Unir les jeunes et les femmes pour l’entraide mutuelle.",
    "footer_nav" => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow" => "Suivez-nous",
    "footer_rights" => "Tous droits réservés",
    "footer_dev" => "Développé avec ❤️ par MS Solutions Lab",
],
"en" => [
    "subtitle_header" => "Action of Youth and Women for Mutual Aid",
    "back" => "← Back to gallery",
    "footer_text" => "Uniting youth and women for mutual aid.",
    "footer_nav" => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow" => "Follow us",
    "footer_rights" => "All rights reserved",
    "footer_dev" => "Developed with ❤️ by MS Solutions Lab",
]
];

function t($key){ global $text,$lang; return $text[$lang][$key]; }
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJEFEM – Action de Jeunes et Femmes pour l’Entraide Mutuelle</title>

<!-- ================================
         🌟 SEO – GOOGLE SEARCH 
================================ -->

<meta name="description" content="AJEFEM – Action de Jeunes et Femmes pour l’Entraide Mutuelle. Organisation basée à Bukavu (RDC) œuvrant pour l’autonomisation, la solidarité, et le développement communautaire.">
<meta name="keywords" content="AJEFEM, Bukavu, RDC, ASBL, Solidarité, Femmes, Jeunes, Entraide, Développement, Humanitaire, ONG, Projets sociaux, Empowerment">
<meta name="author" content="AJEFEM ASBL & MS Solutions Lab">
<meta name="robots" content="index, follow">

<!-- URL canonique -->
<link rel="canonical" href="https://ajefem.org/">

<!-- FAVICON -->
<link rel="icon" type="image/png" href="img/logo_AJEFEM.png">

<!-- Open Graph / Facebook / WhatsApp -->
<meta property="og:title" content="AJEFEM – Action de Jeunes et Femmes pour l’Entraide Mutuelle">
<meta property="og:description" content="Association œuvrant pour l’autonomisation des femmes, la solidarité des jeunes et le développement communautaire en République Démocratique du Congo.">
<meta property="og:image" content="https://ajefem.org/img/logo_AJEFEM.png">
<meta property="og:url" content="https://ajefem.org/">
<meta property="og:type" content="website">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="AJEFEM – Solidarité & Autonomisation">
<meta name="twitter:description" content="Organisation de jeunes et femmes pour l’entraide et le développement communautaire en RDC.">
<meta name="twitter:image" content="https://ajefem.org/img/logo_AJEFEM.png">

<!-- Localisation SEO -->
<meta name="geo.region" content="CD-KS"> 
<meta name="geo.placename" content="Bukavu">
<meta name="geo.position" content="-2.5123;28.8480">
<meta name="ICBM" content="-2.5123, 28.8480">

<!-- JSON-LD : Données structurées Google -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "NGO",
  "name": "AJEFEM ASBL",
  "url": "https://ajefem.org/",
  "logo": "https://ajefem.org/img/logo_AJEFEM.png",
  "foundingDate": "2024",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Bukavu",
    "addressRegion": "Sud-Kivu",
    "addressCountry": "CD"
  },
  "email": "ajefemasbl@gmail.com",
  "telephone": "+243826704930",
  "description": "Organisation œuvrant pour l’autonomisation des femmes, l’encadrement des jeunes et le développement communautaire en République Démocratique du Congo."
}
</script>

<!-- CSS externes -->
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
.album-header {
    text-align: center;
    margin: 40px auto;
    padding: 10px;
}
.album-header h2 {
    color: #0b3d91;
    font-size: 32px;
}
.album-header a {
    text-decoration: none;
    color: #0b3d91;
    font-weight: bold;
}

.album-grid {
    max-width: 1200px;
    margin: 40px auto;
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 20px;
}
.album-grid img, .album-grid video {
    width: 100%;
    height: 260px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,.15);
    cursor: pointer;
    transition: .3s;
}
.album-grid img:hover {
    transform: scale(1.05);
}

@media(max-width:950px){
    .album-grid { grid-template-columns: repeat(2,1fr); }
}
@media(max-width:600px){
    .album-grid { grid-template-columns: 1fr; }
}
</style>
</head>

<body>

<!-- HEADER -->
<header>
    <div class="header-left">
        <img src="img/logo_AJEFEM.png" class="logo-img">
        <div>
            <div class="logo-text">AJEFEM</div>
            <p class="subtitle"><?= t("subtitle_header") ?></p>
        </div>
    </div>

    <div class="lang-switcher">
        <a href="?event=<?= $event_id ?>&lang=fr"><img src="img/fr.jpeg" class="flag"> FR</a>
        <a href="?event=<?= $event_id ?>&lang=en"><img src="img/en.png" class="flag"> EN</a>
    </div>
</header>

<!-- NAVIGATION -->
<nav>
    <div class="burger"><div></div><div></div><div></div></div>

    <div class="nav-links">
        <a href="index.php?lang=<?= $lang ?>">Accueil / Home</a>
        <a href="about.php?lang=<?= $lang ?>">À propos / About</a>
        <a href="programmes.php?lang=<?= $lang ?>">Programmes</a>
        <a href="realisations.php?lang=<?= $lang ?>">Nos réalisations</a>
        <a href="equipe.php?lang=<?= $lang ?>">Notre équipe</a>
        <a href="galerie.php?lang=<?= $lang ?>">Galerie</a>
        <a href="don.php?lang=<?= $lang ?>">Don</a>
        <a href="contact.php?lang=<?= $lang ?>">Contact</a>
    </div>
</nav>

<!-- =============== ALBUM ================ -->
<div class="album-header">
    <a href="galerie.php?lang=<?= $lang ?>"><?= t("back") ?></a>
    <h2><?= $event_title ?></h2>
</div>

<div id="album" class="album-grid">

<?php
// Charger automatiquement 30 images si elles existent
for($i=1; $i<=30; $i++){
    $img = "img/albums/event$event_id/photo$i.jpeg";
    if(file_exists($img)){
        echo "
        <a href='$img'>
            <img src='$img'>
        </a>
        ";
    }
}

// Charger aussi des vidéos si présentes
for($v=1; $v<=10; $v++){
    $vid = "img/albums/event$event_id/video$v.mp4";
    if(file_exists($vid)){
        echo "
        <a href='$vid'>
            <video src='$vid' muted></video>
        </a>
        ";
    }
}
?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    lightGallery(document.getElementById('album'));
});
</script>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-grid">

        <div class="footer-brand">
            <h4>AJEFEM</h4>
            <p><?= t("footer_text") ?></p>
            <img src="img/logo_AJEFEM.png" class="footer-logo">
        </div>

        <div>
            <h4><?= t("footer_nav") ?></h4>
            <a href="index.php?lang=<?= $lang ?>">Accueil</a><br>
            <a href="about.php?lang=<?= $lang ?>">À propos</a><br>
            <a href="programmes.php?lang=<?= $lang ?>">Programmes</a><br>
            <a href="galerie.php?lang=<?= $lang ?>">Galerie</a><br>
            <a href="don.php?lang=<?= $lang ?>">Don</a><br>
            <a href="contact.php?lang=<?= $lang ?>">Contact</a>
        </div>

        <div>
            <h4><?= t("footer_contact") ?></h4>
            <p><i class="fa-solid fa-phone"></i> +243 826 704 930</p>
            <p><i class="fa-solid fa-envelope"></i> contact@ajefem.org</p>
            <p><i class="fa-solid fa-location-dot"></i> Bukavu / RDC</p>
        </div>

        <div>
    <h4><?= t('footer_follow') ?></h4>

    <!-- Facebook -->
    <a href="https://www.facebook.com/profile.php?id=61584040439031" 
       target="_blank" 
       style="color: inherit; margin-right: 10px;">
        <i class="fa-brands fa-facebook fa-2x"></i>
    </a>

    <!-- WhatsApp -->
    <a href="https://whatsapp.com/channel/0029Vb6zrpcEKyZK2v8hvd3m" 
       target="_blank" 
       style="color: inherit; margin-right: 10px;">
        <i class="fa-brands fa-whatsapp fa-2x"></i>
    </a>

    <!-- YouTube -->
    <a href="https://youtube.com/@ajefemasbl?si=pHFxNuAwpGXzop-E" 
       target="_blank" 
       style="color: inherit;">
        <i class="fa-brands fa-youtube fa-2x"></i>
    </a>
</div>

    </div>

    <div class="copyright">
        © <?= date("Y") ?> AJEFEM – <?= t("footer_rights") ?><br>
        <?= t("footer_dev") ?>
    </div>
</footer>

</body>
</html>
