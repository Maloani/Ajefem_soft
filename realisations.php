<?php
// =============================
//        GESTION LANGUE
// =============================
$lang = $_GET['lang'] ?? 'fr';
if (!in_array($lang, ['fr','en'])) $lang = 'fr';

// =============================
//      TRADUCTIONS
// =============================
$text = [

"fr" => [

    /* === MENU === */
    "menu_home"      => "Accueil",
    "menu_about"     => "À propos",
    "menu_programs"  => "Programmes",
    "menu_projects"  => "Nos réalisations",
    "menu_team"      => "Notre équipe",
    "menu_gallery"   => "Images & vidéos",
    "menu_donate"    => "Faire un don",
    "menu_contact"   => "Contact",

    /* REALISATIONS */
    "title"          => "Nos Réalisations",
    "subtitle_header"=> "Action de Jeunes et Femmes pour l’Entraide Mutuelle",
    "proj_title"     => "Nos Projets & Actions",
    "proj_desc"      => "Découvrez les principales réalisations de l’AJEFEM : actions humanitaires, programmes de formation, sensibilisation, empowerment communautaire et développement durable.",

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Suivez-nous",
    "footer_rights"  => "Tous droits réservés",
    "footer_dev"     => "Développé avec ❤️ par MS Solutions Lab",
    "footer_text"    => "Unir les jeunes et les femmes pour l’entraide mutuelle."
],


"en" => [

    /* === MENU === */
    "menu_home"      => "Home",
    "menu_about"     => "About",
    "menu_programs"  => "Programs",
    "menu_projects"  => "Our Achievements",
    "menu_team"      => "Our Team",
    "menu_gallery"   => "Images & Videos",
    "menu_donate"    => "Donate",
    "menu_contact"   => "Contact",

    /* REALISATIONS */
    "title"          => "Our Achievements",
    "subtitle_header"=> "Action of Youth and Women for Mutual Aid",
    "proj_title"     => "Projects & Actions",
    "proj_desc"      => "Explore AJEFEM's major achievements: humanitarian actions, training programs, awareness campaigns, community empowerment and sustainable development.",

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Follow us",
    "footer_rights"  => "All rights reserved",
    "footer_dev"     => "Developed with ❤️ by MS Solutions Lab",
    "footer_text"    => "Uniting youth and women for mutual aid."
]

];

/* Fonction raccourcie */
function t($key){
    global $text, $lang;
    return $text[$lang][$key] ?? $key;
}
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
  "foundingDate": "2020",
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
/* ================================================================
    🔵 HEADER GLOBAL
================================================================ */
header {
    background: #0b3d91;
    color: #fff;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;

    /* Toujours visible en haut */
    position: sticky;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 6000;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 12px;
}

.logo-img {
    width: 60px;
    height: 60px;
}

.logo-text {
    font-size: 24px;
    font-weight: bold;
    color: #fff;
}

.subtitle {
    font-size: 13px;
    margin-top: -4px;
    color: #e7e7e7;
}

.lang-switcher a {
    color: #fff;
    margin-left: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.flag {
    width: 24px;
    height: 16px;
}



/* ================================================================
    🔵 NAVIGATION (MENU)
================================================================ */
nav {
    background: #0b3d91;
    padding: 12px 0;

    /* Collé juste sous header */
    position: sticky;
    top: 80px;
    left: 0;
    width: 100%;
    z-index: 5500;

    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

/* MENU DESKTOP */
@media(min-width: 851px){
    .nav-links {
        display: flex !important;
        position: static !important;
        height: auto !important;
        background: transparent !important;
        padding: 0 !important;
        flex-direction: row !important;
        justify-content: center !important;
        align-items: center !important;
        gap: 35px;
    }

    .burger { display: none !important; }

    /* retirer icônes desktop */
    .nav-links a::before {
        content: "" !important;
        display: none !important;
    }
}

.nav-links a {
    font-size: 18px;
    color: #ffffff !important;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
}



/* ================================================================
    🔵 MENU MOBILE
================================================================ */
@media(max-width: 850px){

    /* BOUTON BURGER */
    .burger {
        display: block;
        position: absolute;
        left: 15px;
        top: 22px;
        cursor: pointer;
        z-index: 7000;
    }

    /* TRAITS DU BURGER → NOIRS */
    .burger div {
        width: 28px;
        height: 4px;
        background: #000 !important;
        margin: 5px;
        border-radius: 3px;
        transition: 0.4s;
    }

    /* MENU FULLSCREEN */
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255,255,255,0.95);

        flex-direction: column;
        align-items: flex-start;

        padding-top: 120px;
        padding-left: 40px;

        display: none;
        z-index: 6000;

        backdrop-filter: blur(8px);
    }

    /* ouverture */
    .nav-links.nav-active {
        display: flex !important;
        animation: slideRight .35s ease-out;
    }

    @keyframes slideRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }

    /* Icônes dans menu mobile */
   /* MENU TEXT COLOR (DESKTOP + MOBILE) */
.nav-links a {
    color: #000 !important;
}

/* ICÔNES DU MENU (MOBILE) */
.nav-links a::before {
    color: #000 !important;
}


    /* Burger → croix */
    .toggle div:nth-child(1){ 
        transform: rotate(45deg) translate(6px,6px); 
        background:#000 !important;
    }
    .toggle div:nth-child(2){ 
        opacity: 0; 
        background:#000 !important;
    }
    .toggle div:nth-child(3){ 
        transform: rotate(-45deg) translate(7px,-7px);
        background:#000 !important;
    }
}



/* ================================================================
   🔵 BOUTON TOP
================================================================ */
.top-btn {
    position: fixed;
    bottom: 25px;
    right: 20px;
    background: #102542;
    color: #fff;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 20px;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s ease-in-out;
}

.top-btn.show {
    opacity: 1;
    visibility: visible;
}



/* ================================================================
   🔵 GRILLES (Programmes, Réalisations…)
================================================================ */
.section-title {
    text-align: center;
    color: #0b3d91;
    font-size: 32px;
    margin-bottom: 10px;
}

.section-desc {
    text-align: center;
    max-width: 750px;
    margin: 10px auto 40px;
    font-size: 18px;
    color: #555;
}

.program-grid, .rea-grid {
    display: grid;
    gap: 30px;
    grid-template-columns: repeat(3,1fr);
}

@media(max-width:950px){
    .program-grid, .rea-grid { grid-template-columns: repeat(2,1fr); }
}

@media(max-width:650px){
    .program-grid, .rea-grid { grid-template-columns: 1fr; }
}



/* ================================================================
   🔵 REALISATIONS – CARDS
================================================================ */
.realisations-section {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.album-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: 0.3s ease-in-out;
}

.album-card:hover {
    transform: translateY(-6px);
}

.album-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
}

.album-content {
    padding: 20px;
}

.album-content h3 {
    color: #0b3d91;
    font-size: 20px;
    margin-bottom: 10px;
}

.album-content p {
    color: #555;
    line-height: 1.6;
    margin-bottom: 20px;
}

.album-btn {
    display: inline-block;
    background: #0b3d91;
    color: #fff;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.2s;
}

.album-btn:hover {
    background: #07306e;
}

/* Responsive cartes */
@media(max-width: 950px){
    .album-card img { height: 200px; }
}

@media(max-width: 600px){
    .album-card img { height: 190px; }
    .section-title { font-size: 28px; }
    .section-desc { font-size: 16px; }
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

</style>
</script>
</head>

<body>
    <!-- ====== LOADER CIRCULAIRE AJEFEM ====== -->
<div id="loader-circle-container">
    <div class="loader-circle">
        <img src="img/logo_AJEFEM.png" class="loader-logo fade-in-logo">
    </div>
    <p class="loader-text">Chargement...</p>
</div>
<!-- ===== BOUTON TOP ===== -->
<div id="topBtn" class="top-btn">
    <i class="fa-solid fa-arrow-up"></i>
</div>
<!-- Bouton TOP -->
<div id="topBtn" class="top-btn"><i onclick="goTop()" class="fa-solid fa-arrow-up"></i></div>

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
        <a href="?lang=fr"><img src="img/fr.jpeg" class="flag"> FR</a>
        <a href="?lang=en"><img src="img/en.png" class="flag"> EN</a>
    </div>
</header>

<!-- NAVIGATION -->
<nav>
    <div class="burger"><div></div><div></div><div></div></div>

    <div class="nav-links">

    <a href="index.php">
        <i class="fa-solid fa-house"></i> <?= t('menu_home') ?>
    </a>

    <a href="about.php">
        <i class="fa-solid fa-circle-info"></i> <?= t('menu_about') ?>
    </a>

    <a href="programmes.php">
        <i class="fa-solid fa-book"></i> <?= t('menu_programs') ?>
    </a>

    <a href="realisations.php">
        <i class="fa-solid fa-chart-line"></i> <?= t('menu_projects') ?>
    </a>

    <a href="equipe.php">
        <i class="fa-solid fa-users"></i> <?= t('menu_team') ?>
    </a>

    <a href="galerie.php">
        <i class="fa-solid fa-image"></i> <?= t('menu_gallery') ?>
    </a>

    <a href="don.php">
        <i class="fa-solid fa-hand-holding-heart"></i> <?= t('menu_donate') ?>
    </a>

    <a href="contact.php">
        <i class="fa-solid fa-envelope"></i> <?= t('menu_contact') ?>
    </a>

</div>

</nav>


<!-- ============================= -->
<!--        REALISATIONS           -->
<!-- ============================= -->

<div class="realisations-section">

   

  
<?php
// ================================================
//  realisations.php - Version PUBLIQUE BILINGUE
// ================================================
require_once "config.php";

/* -------------------------------
   LANGUE
-------------------------------- */
$lang = $_GET["lang"] ?? "fr";
if (!in_array($lang, ["fr","en"])) $lang = "fr";

$T = [
    "fr" => [
        "recent"   => "Récentes",
        "popular"  => "Populaires",
        "category" => "Catégories",
        "read_more"=> "En savoir plus",
        "views"    => "vues",
        "no_data"  => "Aucune réalisation pour le moment."
    ],
    "en" => [
        "recent"   => "Recent",
        "popular"  => "Popular",
        "category" => "Categories",
        "read_more"=> "Read more",
        "views"    => "views",
        "no_data"  => "No achievements for now."
    ]
];

/* -------------------------------
   TRI
-------------------------------- */
$tri = $_GET["tri"] ?? "recent";

switch ($tri) {
    case "popular":
        $order_sql = "ORDER BY vues DESC";
        break;
    case "category":
        $order_sql = "ORDER BY categorie_fr ASC";
        break;
    default:
        $order_sql = "ORDER BY date_realisation DESC";
        $tri = "recent";
}

/* -------------------------------
   PAGINATION
-------------------------------- */
$limit  = 5;
$page   = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
$offset = ($page - 1) * $limit;

$total = $pdo->query("SELECT COUNT(*) FROM realisations")->fetchColumn();
$totalPages = ceil($total / $limit);

/* -------------------------------
   RÉALISATIONS
-------------------------------- */
$stmt = $pdo->prepare("
    SELECT * FROM realisations
    $order_sql
    LIMIT :limit OFFSET :offset
");

$stmt->bindValue(":limit", $limit, PDO::PARAM_INT);
$stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

$stmt->execute();
$realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);

/* Date locale */
if ($lang == "fr") {
    setlocale(LC_TIME, "fr_FR.UTF-8", "French");
} else {
    setlocale(LC_TIME, "en_US.UTF-8", "English");
}

?>
<style>
/* ----- HOVER ----- */
.album-card {
    position: relative;
    overflow: hidden;
    transition: .3s;
}
.album-card:hover {
    transform: translateY(-6px);
}
.album-card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
}

.hover-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width:100%;
    background: rgba(0,0,0,.55);
    color:white;
    padding:10px;
    font-size:14px;
    display:none;
}
.album-card:hover .hover-info {
    display:block;
}

/* ----- TRI ----- */
.tri-buttons {
    text-align:center;
    margin:25px 0;
}
.tri-buttons a {
    background:#0b3d91;
    color:white;
    padding:8px 15px;
    border-radius:6px;
    text-decoration:none;
    margin-right:8px;
}
.tri-buttons a.active {
    background:#062e67;
}

/* ----- GRILLE ----- */
.rea-grid {
    display:grid;
    gap:30px;
    grid-template-columns: repeat(3,1fr);
}
@media(max-width:950px){
    .rea-grid{ grid-template-columns:repeat(2,1fr); }
}
@media(max-width:650px){
    .rea-grid{ grid-template-columns:1fr; }
}

/* ----- PAGINATION ----- */
.pagination {
    text-align:center;
    margin-top:25px;
}
.pagination a {
    background:#08306b;
    padding:8px 15px;
    color:white;
    border-radius:5px;
    text-decoration:none;
}
.pagination a:hover {
    background:#0b3d91;
}

/* ============================================
   🔵 BOUTON "EN SAVOIR PLUS" / "READ MORE"
   AVEC ICÔNE + ANIMATION PULSE
============================================ */
.album-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;

    background: #0b3d91;
    color: #fff !important;

    padding: 12px 22px;
    border-radius: 50px;
    font-size: 15px;
    font-weight: 600;

    text-decoration: none;
    letter-spacing: 0.3px;

    position: relative;
    overflow: hidden;
    z-index: 1;

    transition: all 0.25s ease;
}

/* Icône flèche */
.album-btn::after {
    content: "\f061"; /* icon arrow-right */
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    font-size: 15px;
}

/* Effet hover */
.album-btn:hover {
    background: #082b6a;
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.25);
}

/* Effet pulse lumineux */
.album-btn::before {
    content: "";
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;

    background: rgba(255,255,255,0.25);
    z-index: 0;
    transition: 0.4s;
}

/* Animation wave + pulse */
.album-btn:hover::before {
    left: 100%;
}

/* Petit effet pulsation */
.album-btn:hover {
    animation: pulse-btn 0.7s ease-in-out;
}

@keyframes pulse-btn {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.06); }
    100% { transform: scale(1); }
}

.album-title-link {
    color: #0b3d91;
    text-decoration: none;
    transition: 0.2s;
}

.album-title-link:hover {
    color: #07306e;
    text-decoration: underline;
}
/* TITRE PROFESSIONNEL DES ACTIVITÉS */
.album-content h3 {
    font-size: 22px;
    font-weight: 700;
    color: #0b3d91;
    margin-bottom: 12px;

    line-height: 1.35;
    position: relative;
    padding-bottom: 6px;

    transition: color 0.25s ease;
}

/* Ligne décorative élégante */
.album-content h3::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: 0;

    width: 45px;
    height: 3px;

    background: #0b3d91;
    border-radius: 2px;

    transition: width 0.3s ease, background 0.3s ease;
}

/* Version cliquable améliorée */
.album-title-link {
    text-decoration: none;
    color: inherit;
}

/* Hover : couleur + ligne animée */
.album-content h3:hover {
    color: #07306e;
}

.album-content h3:hover::after {
    width: 70px;
    background: #07306e;
}
/* TITRE PREMIUM AVEC ICÔNE */
.album-title-premium {
    font-size: 22px;
    font-weight: 700;
    color: #0b3d91;
    margin-bottom: 14px;

    display: flex;
    align-items: center;
    gap: 10px;

    cursor: pointer;
    text-decoration: none;

    transition: color 0.3s ease, transform 0.3s ease;
}

.album-title-premium i {
    font-size: 20px;
    color: #0b3d91;
    transition: transform 0.3s ease, color 0.3s ease;
}

.album-title-premium:hover {
    color: #062e67;
    transform: translateX(5px);
}

.album-title-premium:hover i {
    transform: scale(1.2);
    color: #062e67;
}
/* TITRE PREMIUM AVEC ICÔNE */
.album-title-premium {
    font-size: 22px;
    font-weight: 700;
    color: #0b3d91;
    margin-bottom: 14px;

    display: flex;
    align-items: center;
    gap: 10px;

    cursor: pointer;
    text-decoration: none;

    transition: color 0.3s ease, transform 0.3s ease;
}

.album-title-premium i {
    font-size: 20px;
    color: #0b3d91;
    transition: transform 0.3s ease, color 0.3s ease;
}

.album-title-premium:hover {
    color: #062e67;
    transform: translateX(5px);
}

.album-title-premium:hover i {
    transform: scale(1.2);
    color: #062e67;
}
.album-title-highlight {
    font-size: 22px;
    font-weight: 700;
    color: #0b3d91;
    position: relative;
    display: inline-block;
    cursor: pointer;

    transition: color 0.3s ease;
}

.album-title-highlight::before {
    content: "";
    position: absolute;
    bottom: 4px;
    left: 0;
    width: 100%;
    height: 10px;

    background: rgba(11, 61, 145, 0.25);
    z-index: -1;

    transition: height 0.25s ease;
}

.album-title-highlight:hover {
    color: #062e67;
}

.album-title-highlight:hover::before {
    height: 16px;
}
.album-title-gradient {
    font-size: 22px;
    font-weight: 800;
    background: linear-gradient(90deg, #0b3d91, #07306e);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;

    cursor: pointer;
    transition: transform 0.25s ease;
}

.album-title-gradient:hover {
    transform: translateY(-3px);
}

.album-card {
    cursor: pointer;
    position: relative;
}

.album-card a.full-card-link {
    position: absolute;
    top: 0;
    left: 0;

    width: 100%;
    height: 100%;

    z-index: 10;
    text-decoration: none;
}

</style>


<!-- ======================= -->
<!-- 🔵 TITRE + DESCRIPTION -->
<!-- ======================= -->
<h2 class="section-title">
    <?= ($lang=="fr" ? "Nos Réalisations" : "Our Achievements") ?>
</h2>

<p class="section-desc">
    <?= ($lang=="fr"
        ? "Découvrez les actions, projets et réalisations de l’AJEFEM."
        : "Discover AJEFEM projects and achievements.") ?>
</p>


<!-- ======================= -->
<!-- 🔵 BOUTONS DE TRI -->
<!-- ======================= -->
<div class="tri-buttons">
    <a href="?tri=recent&lang=<?= $lang ?>" 
       class="<?= $tri=="recent"?"active":"" ?>">
       <?= $T[$lang]["recent"] ?>
    </a>

    <a href="?tri=popular&lang=<?= $lang ?>" 
       class="<?= $tri=="popular"?"active":"" ?>">
       <?= $T[$lang]["popular"] ?>
    </a>

    <a href="?tri=category&lang=<?= $lang ?>" 
       class="<?= $tri=="category"?"active":"" ?>">
       <?= $T[$lang]["category"] ?>
    </a>
</div>


<!-- ======================= -->
<!-- 🔵 LISTE DES RÉALISATIONS -->
<!-- ======================= -->
<div class="rea-grid">

<?php
if (count($realisations)==0) {
    echo "<p style='text-align:center;font-size:18px;color:#555;'>".$T[$lang]["no_data"]."</p>";
}

foreach ($realisations as $r):

    $date_txt = strftime("%d %B %Y", strtotime($r["date_realisation"]));

    $titre      = $lang=="fr" ? $r["titre_fr"]      : $r["titre_en"];
    $categorie  = $lang=="fr" ? $r["categorie_fr"]  : $r["categorie_en"];
    $desc       = $lang=="fr" ? $r["description_fr"]: $r["description_en"];
?>

    <div class="album-card" data-aos="zoom-in">

        <!-- Image principale -->
        <img src="uploads/realisations/<?= $r['image_principale'] ?>" alt="<?= $titre ?>">

       

        <div class="album-content">

       <h3>
    <a href="voir_realisation.php?id=<?= $r['id'] ?>&lang=<?= $lang ?>" 
       class="album-title-gradient">
        <?= $titre ?>
    </a>
</h3>






            <p style="color:#777;font-size:14px;">
                <i class="fa-solid fa-calendar"></i> <?= $date_txt ?>
                &nbsp; | &nbsp;
                <i class="fa-solid fa-eye"></i> <?= $r['vues'] ?> <?= $T[$lang]["views"] ?>
            </p>

            <p><?= substr($desc, 0, 250) ?>…</p>

            <a class="album-btn" 
               href="voir_realisation.php?id=<?= $r['id'] ?>&lang=<?= $lang ?>">
                <?= $T[$lang]["read_more"] ?>
            </a>

        </div>
    </div>

<?php endforeach; ?>

</div>


<!-- ======================= -->
<!-- 🔵 PAGINATION -->
<!-- ======================= -->
<div class="pagination">

<?php if ($page > 1): ?>
    <a href="?page=<?= $page-1 ?>&tri=<?= $tri ?>&lang=<?= $lang ?>">
        ⬅ <?= ($lang=="fr"?"Précédent":"Previous") ?>
    </a>
<?php endif; ?>

<?php if ($page < $totalPages): ?>
    <a href="?page=<?= $page+1 ?>&tri=<?= $tri ?>&lang=<?= $lang ?>">
        <?= ($lang=="fr"?"Suivant":"Next") ?> ➡
    </a>
<?php endif; ?>

</div>



</div>


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
            <a href="index.php?lang=<?= $lang ?>"><?= t("menu_home") ?></a><br>
            <a href="about.php?lang=<?= $lang ?>"><?= t("menu_about") ?></a><br>
            <a href="programmes.php?lang=<?= $lang ?>"><?= t("menu_programs") ?></a><br>
            <a href="realisations.php?lang=<?= $lang ?>"><?= t("menu_projects") ?></a><br>
            <a href="equipe.php?lang=<?= $lang ?>"><?= t("menu_team") ?></a><br>
            <a href="galerie.php?lang=<?= $lang ?>"><?= t("menu_gallery") ?></a><br>
            <a href="don.php?lang=<?= $lang ?>"><?= t("menu_donate") ?></a><br>
            <a href="contact.php?lang=<?= $lang ?>"><?= t("menu_contact") ?></a>
        </div>

        <div>
            <h4><?= t('footer_contact') ?></h4>
            <p><i class="fa-solid fa-phone"></i> +243 826 704 930</p>
            <p><i class="fa-solid fa-envelope"></i> ajefemasbl@gmail.com</p>
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


<script>
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({ duration: 900, once: true });

    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");

    burger.addEventListener("click", () => {
        nav.classList.toggle("nav-active");
        burger.classList.toggle("toggle");
    });
});

function goTop() {
    window.scrollTo({ top: 0, behavior: "smooth" });
}
</script>
<script>
    const topBtn = document.getElementById("topBtn");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 300) {
            topBtn.classList.add("show");
        } else {
            topBtn.classList.remove("show");
        }
    });

    topBtn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
</script>
<script>
// Attendre que tout le HTML soit chargé
document.addEventListener("DOMContentLoaded", function() {

    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");

    // Si élément non trouvé → éviter les erreurs
    if(!burger || !nav){
        console.error("Burger ou menu introuvable !");
        return;
    }

    // OUVERTURE / FERMETURE MENU
    burger.addEventListener("click", () => {
        nav.classList.toggle("nav-active");   // montre / cache le menu
        burger.classList.toggle("toggle");    // animation croix
    });

    // FERMETURE LORSQUE L’USER CLIQUE SUR UN LIEN
    document.querySelectorAll(".nav-links a").forEach(link => {
        link.addEventListener("click", () => {
            nav.classList.remove("nav-active");
            burger.classList.remove("toggle");
        });
    });

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


</body>
</html>
