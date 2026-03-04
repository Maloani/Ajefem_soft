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
    "title" => "Nos Programmes",
    "subtitle_header" => "Action de Jeunes et Femmes pour l’Entraide Mutuelle",

    /* === MENUS === */
    "menu_home"      => "Accueil",
    "menu_about"     => "À propos",
    "menu_programs"  => "Programmes",
    "menu_projects"  => "Nos réalisations",
    "menu_team"      => "Notre équipe",
    "menu_gallery"   => "Images & vidéos",
    "menu_donate"    => "Faire un don",
    "menu_contact"   => "Contact",

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Suivez-nous",
    "footer_rights"  => "Tous droits réservés",
    "footer_dev"     => "Développé avec ❤️ par MS Solutions Lab",
    "footer_text"    => "Unir les jeunes et les femmes pour l’entraide mutuelle.",

    /* PROGRAMMES */
    "programs_title" => "Domaines d’Intervention",
    "programs_desc"  => "Découvrez les principaux programmes d’action de l’AJEFEM visant à promouvoir la paix, l’autonomisation, le développement et la protection sociale.",

    "programs" => [
        [
            "titre" => "Autonomisation des Femmes & Jeunesse",
            "desc"  => "Renforcer les capacités, soutenir l’entrepreneuriat, favoriser les AGR et accompagner les initiatives de leadership.",
            "icon"  => "fa-people-group"
        ],
        [
            "titre" => "Éducation à la Paix & Gouvernance",
            "desc"  => "Promouvoir la coexistence pacifique, réduire les conflits communautaires et sensibiliser à la citoyenneté.",
            "icon"  => "fa-dove"
        ],
        [
            "titre" => "Protection Sociale & Humanitaire",
            "desc"  => "Assister les personnes vulnérables, soutenir les victimes de VBG, assurer l’aide d’urgence.",
            "icon"  => "fa-hands-holding-heart"
        ],
        [
            "titre" => "Développement Agricole",
            "desc"  => "Encourager l’agriculture durable, l’élevage, et les initiatives communautaires pour lutter contre l’insécurité alimentaire.",
            "icon"  => "fa-wheat-awn"
        ],
        [
            "titre" => "Éducation & Formation",
            "desc"  => "Appuyer la scolarisation, développer des centres de formation professionnelle et promouvoir l’éducation inclusive.",
            "icon"  => "fa-graduation-cap"
        ],
        [
            "titre" => "Environnement & WASH",
            "desc"  => "Protéger l’environnement, promouvoir l’eau potable, l’hygiène, l’assainissement et lutter contre les risques naturels.",
            "icon"  => "fa-leaf"
        ]
    ]
],


"en" => [
    "title" => "Our Programs",
    "subtitle_header" => "Action of Youth and Women for Mutual Aid",

    /* === MENUS === */
    "menu_home"      => "Home",
    "menu_about"     => "About",
    "menu_programs"  => "Programs",
    "menu_projects"  => "Our Achievements",
    "menu_team"      => "Our Team",
    "menu_gallery"   => "Images & Videos",
    "menu_donate"    => "Donate",
    "menu_contact"   => "Contact",

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Follow us",
    "footer_rights"  => "All rights reserved",
    "footer_dev"     => "Developed with ❤️ by MS Solutions Lab",
    "footer_text"    => "Uniting youth and women for mutual aid.",

    /* PROGRAMMES */
    "programs_title" => "Intervention Areas",
    "programs_desc"  => "Discover AJEFEM’s main programs promoting peace, empowerment, development and social protection.",

    "programs" => [
        [
            "titre" => "Women & Youth Empowerment",
            "desc"  => "Strengthening skills, supporting entrepreneurship and promoting economic autonomy.",
            "icon"  => "fa-people-group"
        ],
        [
            "titre" => "Peace Education & Governance",
            "desc"  => "Promoting peaceful coexistence, reducing conflicts and strengthening civic engagement.",
            "icon"  => "fa-dove"
        ],
        [
            "titre" => "Social & Humanitarian Protection",
            "desc"  => "Supporting vulnerable populations, victims of GBV and emergency assistance.",
            "icon"  => "fa-hands-holding-heart"
        ],
        [
            "titre" => "Agricultural Development",
            "desc"  => "Promoting sustainable farming, livestock and community food security initiatives.",
            "icon"  => "fa-wheat-awn"
        ],
        [
            "titre" => "Education & Training",
            "desc"  => "Supporting schooling, training centers and inclusive education.",
            "icon"  => "fa-graduation-cap"
        ],
        [
            "titre" => "Environment & WASH",
            "desc"  => "Protecting the environment, promoting clean water, sanitation and hygiene.",
            "icon"  => "fa-leaf"
        ]
    ]
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
/* ================================
   🔵 MENU DESKTOP (ORDINATEUR)
================================ */
/* =====================================================
   🔵 HEADER FIXE
===================================================== */
header {
    background: #0b3d91;
    color: #fff;
    padding: 10px 20px;
    position: fixed;
    top: 0;
    width: 100%;
    height: 70px;
    z-index: 6000;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 3px 6px rgba(0,0,0,0.25);
}

/* Empêche le contenu de passer sous header + nav */
body {
    padding-top: 140px;
}

/* =====================================================
   🔵 NAV FIXE SOUS L’ENTÊTE
===================================================== */
nav {
    background: #0b3d91;
    padding: 12px 0;
    position: fixed;
    top: 70px;         /* Juste sous le header */
    width: 100%;
    z-index: 5500;
    box-shadow: 0 3px 6px rgba(0,0,0,0.25);
}

/* MENU DESKTOP */
.nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 30px;
}

.nav-links a {
    font-size: 18px;
    color: #ffffff !important;
    font-weight: 600;
    text-decoration: none;
    display: flex;
    align-items: center;
}

/* Icônes intégrées FA */
.nav-links a i {
    margin-right: 6px;
    color: #ffffff;
}

/* Burger caché en desktop */
.burger {
    display: none;
}


/* =====================================================
   🔵 MENU MOBILE FULLSCREEN
===================================================== */
@media(max-width: 850px) {

    /* Affichage du burger */
   /* ======== BURGER MOBILE ======== */
.burger {
    display: block;
    position: absolute;
    left: 15px;
    top: 22px;
    cursor: pointer;
    z-index: 7000;
}

.burger div {
    width: 28px;
    height: 4px;
    background: #000 !important; /* 🔥 NOIR */
    margin: 5px;
    border-radius: 3px;
    transition: 0.4s;
}

/* ======== BURGER → CROIX ======== */
.toggle div:nth-child(1){
    transform: rotate(45deg) translate(6px,6px);
    background: #000 !important; /* noir */
}

.toggle div:nth-child(2){
    opacity: 0;
    background: #000 !important; /* noir */
}

.toggle div:nth-child(3){
    transform: rotate(-45deg) translate(7px,-7px);
    background: #000 !important; /* noir */
}


    /* MENU MOBILE */
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255,255,255,0.92);
        flex-direction: column;
        align-items: flex-start;
        padding-top: 150px;
        padding-left: 40px;
        display: none;
        z-index: 6500;
        backdrop-filter: blur(8px);
    }

    /* Ouverture */
    .nav-links.nav-active {
        display: flex !important;
        animation: slideRight .35s ease-out;
    }

    /* Animation */
    @keyframes slideRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }

    .nav-links a {
        font-size: 22px;
        color: #102542 !important;
        padding: 15px 0;
    }

    /* Icônes automatiques UNIQUEMENT mobile */
    .nav-links a::before {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        margin-right: 12px;
    }

    .nav-links a[href*='index']::before        { content: "\f015"; }
    .nav-links a[href*='about']::before        { content: "\f129"; }
    .nav-links a[href*='programmes']::before   { content: "\f02d"; }
    .nav-links a[href*='realisations']::before { content: "\f201"; }
    .nav-links a[href*='equipe']::before       { content: "\f500"; }
    .nav-links a[href*='galerie']::before      { content: "\f03e"; }
    .nav-links a[href*='don']::before          { content: "\f4c0"; }
    .nav-links a[href*='contact']::before      { content: "\f0e0"; }

 
}


/* =====================================================
   🔵 SUPPRESSION ICÔNES AUTOMATIQUES EN DESKTOP
===================================================== */
@media(min-width: 851px) {
    .nav-links a::before {
        content: "" !important;
        margin-right: 0 !important;
        display: none !important;
    }
}


/* =====================================================
   ⬆ BOUTON RETOUR EN HAUT
===================================================== */
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


/* ================================
   📌 SECTION PROGRAMMES
================================ */
.programs-section {
    max-width: 1100px;
    margin: 50px auto;
    padding: 20px;
}

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

.program-grid {
    display: grid;
    gap: 30px;
    grid-template-columns: repeat(3, 1fr);
}

.program-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    border-left: 6px solid var(--color);
    transition: .2s;
}

.program-card:hover {
    transform: translateY(-5px);
}

.program-card i {
    font-size: 40px;
    color: var(--color);
    margin-bottom: 15px;
}

.program-card h3 {
    color: var(--color);
    margin-bottom: 10px;
}

@media(max-width: 950px){
    .program-grid { grid-template-columns: repeat(2,1fr); }
}

@media(max-width: 650px){
    .program-grid { grid-template-columns: 1fr; }
}

/* ================================
   ⬆ BOUTON RETOUR EN HAUT
================================ */
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
/* 🔵 SUPPRESSION DES ICÔNES EN DOUBLE SUR ORDINATEUR */
@media(min-width: 851px) {
    /* Retirer les icônes automatiques du menu desktop */
    .nav-links a::before {
        content: "" !important;
        margin-right: 0 !important;
    }
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
            <p class="subtitle"><?= $text[$lang]["subtitle_header"] ?></p>
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



<!-- =========================== -->
<!--         PROGRAMMES          -->
<!-- =========================== -->

<div class="programs-section">

    <h2 class="section-title" data-aos="fade-up"><?= $text[$lang]["programs_title"] ?></h2>

    <p class="section-desc" data-aos="fade-up"><?= $text[$lang]["programs_desc"] ?></p>

    <div class="program-grid">

        <?php 
        $colors = ["#0b3d91", "#e67e22", "#16a085", "#9b59b6", "#c0392b", "#2980b9"];

        foreach ($text[$lang]["programs"] as $i => $prog): ?>

            <div class="program-card" 
                 data-aos="zoom-in"
                 data-aos-delay="<?= $i * 100 ?>"
                 style="--color:<?= $colors[$i] ?>;">

                <i class="fa-solid <?= $prog['icon'] ?>"></i>

                <h3><?= $prog["titre"] ?></h3>
                <p><?= $prog["desc"] ?></p>

            </div>

        <?php endforeach; ?>

    </div>

</div>


<!-- FOOTER -->
<!-- FOOTER -->
<footer class="footer">
    <div class="footer-grid">

        <div class="footer-brand">
            <h4>AJEFEM</h4>
            <p><?= t('footer_text') ?></p>
            <img src="img/logo_AJEFEM.png" class="footer-logo">
        </div>

        <div>
            <h4><?= t('footer_nav') ?></h4>
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
        © <?= date("Y") ?> AJEFEM – <?= t("footer_rights") ?>
        <br><?= t("footer_dev") ?>
    </div>
</footer>


<script>
document.addEventListener('DOMContentLoaded', () => {
    AOS.init({ duration: 900, once: true });

    const topBtn = document.getElementById("topBtn");
    window.addEventListener("scroll", () => {
        topBtn.classList.toggle("show", window.scrollY > 200);
    });

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
