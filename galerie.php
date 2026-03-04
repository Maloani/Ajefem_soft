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
    "menu_home"      => "Accueil",
    "menu_about"     => "À propos",
    "menu_programs"  => "Programmes",
    "menu_projects"  => "Nos réalisations",
    "menu_team"      => "Notre équipe",
    "menu_gallery"   => "Images & vidéos",
    "menu_donate"    => "Faire un don",
    "menu_contact"   => "Contact",

    "title"          => "Galerie",
    "subtitle_header"=> "Action de Jeunes et Femmes pour l’Entraide Mutuelle",
    "gallery_title"  => "Images & Vidéos",
    "gallery_desc"   => "Découvrez nos activités, événements et actions communautaires en images et vidéos.",

    "photos_title"   => "Photos récentes",
    "videos_title"   => "Vidéos récentes",

    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Suivez-nous",
    "footer_rights"  => "Tous droits réservés",
    "footer_dev"     => "Développé avec ❤️ par MS Solutions Lab",
    "footer_text"    => "Unir les jeunes et les femmes pour l’entraide mutuelle."
],


"en" => [
    "menu_home"      => "Home",
    "menu_about"     => "About",
    "menu_programs"  => "Programs",
    "menu_projects"  => "Our Achievements",
    "menu_team"      => "Our Team",
    "menu_gallery"   => "Images & Videos",
    "menu_donate"    => "Donate",
    "menu_contact"   => "Contact",

    "title"          => "Gallery",
    "subtitle_header"=> "Action of Youth and Women for Mutual Aid",
    "gallery_title"  => "Images & Videos",
    "gallery_desc"   => "Explore our activities, events and community missions through photos and videos.",

    "photos_title"   => "Recent Photos",
    "videos_title"   => "Recent Videos",

    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Follow us",
    "footer_rights"  => "All rights reserved",
    "footer_dev"     => "Developed with ❤️ by MS Solutions Lab",
    "footer_text"    => "Uniting youth and women for mutual aid."
]

];

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
   🔵 HEADER + MENU (DESKTOP & MOBILE)
================================================================ */

/* ----- NAV GLOBAL ----- */
/* FORCER L'ICÔNE X DE FERMETURE À S'AFFICHER */
.lb-close {
    position: fixed !important;
    top: 20px !important;
    right: 20px !important;
    width: 42px !important;
    height: 42px !important;
    background: rgba(0,0,0,0.85) !important;
    border-radius: 50% !important;
    z-index: 99999 !important;
    cursor: pointer !important;
}

/* Afficher un vrai "X" blanc au centre */
.lb-close:after {
    content: "✕" !important;
    color: #fff !important;
    font-size: 26px !important;
    font-weight: bold !important;
    position: absolute !important;
    top: 50% !important;
    left: 50% !important;
    transform: translate(-50%, -50%) !important;
}

/* Effet hover */
.lb-close:hover {
    background: #0b3d91 !important;
}

nav {
    background: #0b3d91;
    padding: 12px 0;
    position: sticky;
    top: 80px;
    width: 100%;
    z-index: 5000;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

/* ----- NAV LINKS DESKTOP ----- */
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

    /* Supprime icônes en desktop */
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
   🔵 NAV MOBILE FULLSCREEN
================================================================ */
@media(max-width: 850px){

    /* ----- BOUTON BURGER ----- */
    .burger {
        display: block;
        position: absolute;
        left: 15px;
        top: 22px;
        cursor: pointer;
        z-index: 6000;
    }

    .burger div {
        width: 28px;
        height: 4px;
        background: #000 !important; /* TRAITS NOIRS */
        margin: 5px;
        border-radius: 3px;
        transition: 0.4s;
    }

    /* Burger → CROIX */
    .toggle div:nth-child(1){
        transform: rotate(45deg) translate(6px,6px);
        background: #000 !important;
    }
    .toggle div:nth-child(2){
        opacity: 0;
        background: #000 !important;
    }
    .toggle div:nth-child(3){
        transform: rotate(-45deg) translate(7px,-7px);
        background: #000 !important;
    }

    /* ============================
       🔵 MENU MOBILE FULLSCREEN
    ============================*/
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255,255,255,0.92);
        flex-direction: column;
        align-items: flex-start;
        padding-top: 120px;
        padding-left: 40px;
        display: none;
        z-index: 5000;
        backdrop-filter: blur(8px);
    }

    .nav-links.nav-active {
        display: flex !important;
        animation: slideRight .35s ease-out;
    }

    @keyframes slideRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }

    /* ============================
       🔵 TEXTE DU MENU MOBILE
    ============================*/
    .nav-links a {
        font-size: 22px;
        padding: 15px 0;
        color: #000 !important; /* TEXTE NOIR */
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    /* ============================
       🔵 Icônes FontAwesome — mobile
       Empêche les doubles icônes
    ============================*/
    .nav-links a i {
        display: none !important; /* cache icônes HTML <i> */
    }

    .nav-links a::before {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        margin-right: 12px;
        color: #000; /* Icônes NOIRS */
        display: inline-block !important;
    }

    .nav-links a[href*='index']::before { content:"\f015"; }
    .nav-links a[href*='about']::before { content:"\f129"; }
    .nav-links a[href*='programmes']::before { content:"\f02d"; }
    .nav-links a[href*='realisations']::before { content:"\f201"; }
    .nav-links a[href*='equipe']::before { content:"\f500"; }
    .nav-links a[href*='galerie']::before { content:"\f03e"; }
    .nav-links a[href*='don']::before { content:"\f4c0"; }
    .nav-links a[href*='contact']::before { content:"\f0e0"; }
}

/* ================================================================
   🔵 HEADER + MENU (DESKTOP & MOBILE)
================================================================ */

/* ----- NAV GLOBAL ----- */
nav {
    background: #0b3d91;
    padding: 12px 0;
    position: sticky;
    top: 80px;
    width: 100%;
    z-index: 5000;
    box-shadow: 0 3px 6px rgba(0,0,0,0.2);
}

/* ----- NAV LINKS DESKTOP ----- */
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

    /* Supprime icônes en desktop */
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
   🔵 NAV MOBILE FULLSCREEN
================================================================ */
@media(max-width: 850px){

    /* ----- BOUTON BURGER ----- */
    .burger {
        display: block;
        position: absolute;
        left: 15px;
        top: 22px;
        cursor: pointer;
        z-index: 6000;
    }

    .burger div {
        width: 28px;
        height: 4px;
        background: #000 !important; /* TRAITS NOIRS */
        margin: 5px;
        border-radius: 3px;
        transition: 0.4s;
    }

    /* Burger → CROIX */
    .toggle div:nth-child(1){
        transform: rotate(45deg) translate(6px,6px);
        background: #000 !important;
    }
    .toggle div:nth-child(2){
        opacity: 0;
        background: #000 !important;
    }
    .toggle div:nth-child(3){
        transform: rotate(-45deg) translate(7px,-7px);
        background: #000 !important;
    }

    /* ============================
       🔵 MENU MOBILE FULLSCREEN
    ============================*/
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255,255,255,0.92);
        flex-direction: column;
        align-items: flex-start;
        padding-top: 120px;
        padding-left: 40px;
        display: none;
        z-index: 5000;
        backdrop-filter: blur(8px);
    }

    .nav-links.nav-active {
        display: flex !important;
        animation: slideRight .35s ease-out;
    }

    @keyframes slideRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }

    /* ============================
       🔵 TEXTE DU MENU MOBILE
    ============================*/
    .nav-links a {
        font-size: 22px;
        padding: 15px 0;
        color: #000 !important; /* TEXTE NOIR */
        font-weight: 600;
        display: flex;
        align-items: center;
    }

    /* ============================
       🔵 Icônes FontAwesome — mobile
       Empêche les doubles icônes
    ============================*/
    .nav-links a i {
        display: none !important; /* cache icônes HTML <i> */
    }

    .nav-links a::before {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        margin-right: 12px;
        color: #000; /* Icônes NOIRS */
        display: inline-block !important;
    }

    .nav-links a[href*='index']::before { content:"\f015"; }
    .nav-links a[href*='about']::before { content:"\f129"; }
    .nav-links a[href*='programmes']::before { content:"\f02d"; }
    .nav-links a[href*='realisations']::before { content:"\f201"; }
    .nav-links a[href*='equipe']::before { content:"\f500"; }
    .nav-links a[href*='galerie']::before { content:"\f03e"; }
    .nav-links a[href*='don']::before { content:"\f4c0"; }
    .nav-links a[href*='contact']::before { content:"\f0e0"; }
}

/* ================================================================
   🔵 PAGE GALERIE – STYLES
================================================================ */

.gallery-section {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.section-title {
    text-align: center;
    color: #0b3d91;
    font-size: 32px;
    margin-bottom: 10px;
}

.section-subtitle {
    text-align: center;
    font-size: 26px;
    margin: 35px 0 15px;
    color: #333;
    font-weight: bold;
}

.section-desc {
    text-align: center;
    max-width: 750px;
    margin: 10px auto 40px;
    font-size: 18px;
    color: #555;
}

/* GRID PHOTOS & VIDEOS */
.gallery-grid {
    display: grid;
    gap: 20px;
    grid-template-columns: repeat(4, 1fr);
}

.gallery-item {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: .3s;
}

.gallery-item:hover {
    transform: scale(1.03);
}

.gallery-item img,
.gallery-item video {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

/* RESPONSIVE GRID */
@media(max-width:1000px){
    .gallery-grid { grid-template-columns: repeat(3,1fr); }
}
@media(max-width:700px){
    .gallery-grid { grid-template-columns: repeat(2,1fr); }
}
@media(max-width:500px){
    .gallery-grid { grid-template-columns: 1fr; }
}


/* ================================================================
   🔵 BOUTON RETOUR EN HAUT
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
    transition: .3s ease-in-out;
}

.top-btn.show {
    opacity: 1;
    visibility: visible;
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
<script>
document.addEventListener('DOMContentLoaded', () => {

    const burger = document.querySelector(".burger");
    const navMenu = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-links a");

    /* OUVRIR / FERMER */
    burger.addEventListener("click", () => {
        navMenu.classList.toggle("nav-active");
        burger.classList.toggle("toggle");
    });

    /* FERMER QUAND ON CLIQUE SUR UN LIEN */
    links.forEach(link => {
        link.addEventListener("click", () => {
            navMenu.classList.remove("nav-active");
            burger.classList.remove("toggle");
        });
    });

});
</script>
   <!-- LIGHTBOX CSS -->
<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"/>

<!-- LIGHTBOX JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

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
<!-- TOP BUTTON -->
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
<!-- ========== CARROUSEL MODERNE ========== -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

<style>
/* CONTENEUR DU CARROUSEL */
.carousel-container {
    width: 100%;
    max-width: 1200px;
    margin: 40px auto;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
}

/* SWIPER CONFIG */
.swiper {
    width: 100%;
    height: 420px; /* hauteur uniforme */
}

/* SLIDES */
.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
    background: #fff;
}

/* IMAGES : PLUS JAMAIS COUPÉES */
.swiper-slide img {
    width: 100%;
    height: 100%;
    object-fit: contain;     /* ✔ ne coupe jamais */
    background-color: #f5f5f5; /* ✔ couleur autour si image trop petite */
    padding: 5px;            /* optionnel */
}



.album-section {
    max-width: 1200px;
    margin: 50px auto;
    padding: 10px;
}

.album-grid {
    display: grid;
    grid-template-columns: repeat(3,1fr);
    gap: 25px;
}

.album-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    transition: .3s;
}
.album-card:hover { transform: translateY(-6px); }

.album-card img {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.album-content {
    padding: 20px;
}

.album-content h3 {
    font-size: 20px;
    margin-bottom: 8px;
}

.album-content p {
    font-size: 15px;
    color: #555;
}

.album-btn {
    display: inline-block;
    margin-top: 12px;
    padding: 10px 15px;
    background: #0b3d91;
    color: #fff;
    border-radius: 6px;
    text-decoration: none;
}
.album-btn:hover { background:#06275d; }

@media(max-width:900px){
    .album-grid { grid-template-columns: repeat(2,1fr); }
}
@media(max-width:600px){
    .album-grid { grid-template-columns: 1fr; }
}

</style>

<div class="carousel-container swiper">
    <div class="swiper-wrapper">
         <div class="swiper-slide">
            <img src="img/lanctshopo.jpeg" alt="carousel">
        </div>
       
        
         <div class="swiper-slide">
            <img src="img/16jours_activisme/ok.jpeg" alt="carousel">
        </div>
        <div class="swiper-slide">
            <img src="img/photosadhesionBCA/tr.jpeg" alt="carousel">
        </div>

        <div class="swiper-slide">
            <img src="img/reinsertion_enfants/pro.jpeg" alt="carousel">
        </div>

        <div class="swiper-slide">
            <img src="img/photosadhesionBCA/Act2.jpeg" alt="carousel">
        </div>

        <div class="swiper-slide">
            <img src="img/reinsertion_enfants/okok.jpeg" alt="carousel">
        </div>

        <div class="swiper-slide">
            <img src="img/photosadhesionBCA/b.jpeg" alt="carousel">
        </div>

        <div class="swiper-slide">
            <img src="img/reinsertion_enfants/ok2.jpeg" alt="carousel">
        </div>



    </div>

    <!-- Boutons -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>

    <!-- Pagination -->
    <div class="swiper-pagination"></div>
</div>



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
new Swiper('.swiper', {
    loop: true,
    autoplay: { delay: 3000 },
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    effect: "fade",
    speed: 800
});
</script>


<!-- ============================= -->
<!--           GALERIE             -->
<!-- ============================= -->

<div class="gallery-section">

    <h2 class="section-title" data-aos="fade-up"><?= t("gallery_title") ?></h2>
    <p class="section-desc" data-aos="fade-up"><?= t("gallery_desc") ?></p>

    <!-- ================= PHOTO SECTION ================= -->
    <h3 class="section-subtitle" data-aos="fade-up"><?= t("photos_title") ?></h3>

    <div class="gallery-grid">
    
    
    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/tshopo1.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/tshopo1.jpeg" alt="Photo 1">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/tshopo2.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/tshopo2.jpeg" alt="Photo 2">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/tshopo3.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/tshopo3.jpeg" alt="Photo 3">
        </a>
    </div>
    
    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/16jours_activisme/ok.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/16jours_activisme/ok.jpeg" alt="Photo 1">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/16jours_activisme/vr.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/16jours_activisme/vr.jpeg" alt="Photo 2">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/personnes3agees/14.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/personnes3agees/14.jpeg" alt="Photo 3">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/personnes3agees/13.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/personnes3agees/13.jpeg" alt="Photo 4">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/personnes3agees/12.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/personnes3agees/12.jpeg" alt="Photo 5">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/ab.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/ab.jpeg" alt="Photo 6">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/bb.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/bb.jpeg" alt="Photo 7">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/cc.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/cc.jpeg" alt="Photo 8">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/dd.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/dd.jpeg" alt="Photo 9">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/ee.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/ee.jpeg" alt="Photo 10">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/reinsertion_enfants/ff.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/reinsertion_enfants/ff.jpeg" alt="Photo 11">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/tr.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/tr.jpeg" alt="Photo 12">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/Act3.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/Act3.jpeg" alt="Photo 13">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/act1.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/act1.jpeg" alt="Photo 14">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/Act2.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/Act2.jpeg" alt="Photo 15">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/Act3.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/Act3.jpeg" alt="Photo 16">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/b.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/b.jpeg" alt="Photo 17">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/C.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/C.jpeg" alt="Photo 18">
        </a>
    </div>

    <div class="gallery-item" data-aos="zoom-in">
        <a href="img/photosadhesionBCA/b.jpeg" data-lightbox="ajefem-gallery">
            <img src="img/photosadhesionBCA/b.jpeg" alt="Photo 19">
        </a>
    </div>

</div>


    <!-- ================= VIDEO SECTION ================= -->
    <h3 class="section-subtitle" data-aos="fade-up" style="margin-top:50px"><?= t("videos_title") ?></h3>

 <style>
 
.video-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* Ratio 16:9 */
    height: 0;
    overflow: hidden;
    border-radius: 8px;
    background: #000;
}

.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}
/* GRILLE RESPONSIVE */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
    margin: 30px auto;
}

/* WRAPPER VIDÉO */
.video-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%; /* Format 16:9 */
    height: 0;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    background: #000;
}

/* IFRAME */
.video-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
}

</style>


<div class="gallery-grid">

    <!-- VIDEO 1 -->
    <div class="gallery-item" data-aos="zoom-in">
        <div class="video-wrapper">
            <iframe 
                src="https://www.youtube.com/embed/c6M7lhJkamE"
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <!-- VIDEO 2 -->
    <div class="gallery-item" data-aos="zoom-in">
        <div class="video-wrapper">
            <iframe 
                src="https://www.youtube.com/embed/vN3Ul6ypWK4"
                allowfullscreen>
            </iframe>
        </div>
    </div>

    <!-- VIDEO 3 (corrigée en embed) -->
    <div class="gallery-item" data-aos="zoom-in">
        <div class="video-wrapper">
            <iframe 
                src="https://www.youtube.com/embed/1IiRFxnNc-4"
                allowfullscreen>
            </iframe>
        </div>
    </div>
    
   <div class="gallery-item" data-aos="zoom-in">
    <div class="video-wrapper">
        <iframe 
            src="https://www.youtube.com/embed/lg23CtOcfIQ"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
    </div>
</div>


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
            <h4><?= t("footer_contact") ?></h4>
            <p><i class="fa-solid fa-phone"></i> +243 826 704 930</p>
            <p><i class="fa-solid fa-envelope"></i> ajefemasbl@gmail.com</p>
            <p><i class="fa-solid fa-location-dot"></i> Bukavu – RDC</p>
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
</script>

<script>
function goTop(){
    window.scrollTo({ top:0, behavior:"smooth" });
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
