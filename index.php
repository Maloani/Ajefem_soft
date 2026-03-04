<?php
// =============================
//   GESTION DES LANGUES
// =============================
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';
if (!in_array($lang, ['fr', 'en'])) $lang = 'fr';

$trans = [

    "fr" => [
        "menu_home" => "Accueil",
        "menu_about" => "À propos",
        "menu_programs" => "Programmes",
        "menu_donate" => "Faire un don",
        "menu_contact" => "Contact",
        "menu_projects" => "Nos réalisations",
        "menu_team" => "Notre équipe",
        "menu_gallery" => "Images / Vidéos",

        "hero_title" => "Ensemble, renforçons la solidarité et l’autonomisation",
        "hero_subtitle" => "Unir les jeunes et les femmes pour construire un avenir meilleur.",
        "support_us" => "Soutenir nos actions",

        "welcome" => "Bienvenue à l’AJEFEM",
        "welcome_text" => "L’AJEFEM œuvre pour l’autonomisation des femmes, l’encadrement des jeunes, la solidarité communautaire et l’amélioration des conditions de vie.",
        "impact" => "Notre Impact",
        "partners" => "Nos Partenaires",
        "join" => "Rejoindre l’AJEFEM",
        "discover_programs" => "Découvrir nos programmes",

        "footer_nav" => "Navigation",
        "footer_contact" => "Contact",
        "footer_follow" => "Suivez-nous",
        "footer_rights" => "Tous droits réservés",
        "footer_dev" => "Développé avec ❤️ par MS Solutions Lab"
    ],

    "en" => [
        "menu_home" => "Home",
        "menu_about" => "About",
        "menu_programs" => "Programs",
        "menu_donate" => "Donate",
        "menu_contact" => "Contact",
        "menu_projects" => "Our Achievements",
        "menu_team" => "Our Team",
        "menu_gallery" => "Images / Videos",

        "hero_title" => "Together, let's strengthen solidarity and empowerment",
        "hero_subtitle" => "Unite young people and women to build a better future.",
        "support_us" => "Support our actions",

        "welcome" => "Welcome to AJEFEM",
        "welcome_text" => "AJEFEM works for women empowerment, youth mentoring, community solidarity, and improving living conditions.",
        "impact" => "Our Impact",
        "partners" => "Our Partners",
        "join" => "Join AJEFEM",
        "discover_programs" => "Discover our programs",

        "footer_nav" => "Navigation",
        "footer_contact" => "Contact",
        "footer_follow" => "Follow us",
        "footer_rights" => "All rights reserved",
        "footer_dev" => "Developed with ❤️ by MS Solutions Lab"
    ]
];

function t($key) {
    global $trans, $lang;
    return $trans[$lang][$key] ?? $key;
}
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJEFEM – Action de Jeunes et Femmes pour l’Entraide Mutuelle</title>

    <!-- ================================ -->
    <!-- 🌟 SEO – GOOGLE SEARCH -->
    <!-- ================================ -->

    <meta name="description" content="AJEFEM – Action de Jeunes et Femmes pour l’Entraide Mutuelle. Organisation basée à Bukavu (RDC) œuvrant pour l’autonomisation, la solidarité, et le développement communautaire.">
    <meta name="keywords" content="AJEFEM, Bukavu, RDC, ASBL, Solidarité, Femmes, Jeunes, Entraide, Développement, ONG, Projets sociaux, Empowerment">
    <meta name="author" content="AJEFEM ASBL & MS Solutions Lab">
    <meta name="robots" content="index, follow">

    <!-- URL canonique -->
    <link rel="canonical" href="https://ajefem.org/">

    <!-- FAVICON -->
    <link rel="icon" type="image/png" href="img/logo_AJEFEM.png">

    <!-- Open Graph -->
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

    <!-- GEO -->
    <meta name="geo.region" content="CD-KS">
    <meta name="geo.placename" content="Bukavu">
    <meta name="geo.position" content="-2.5123;28.8480">
    <meta name="ICBM" content="-2.5123, 28.8480">

    <!-- JSON-LD STRUCTURED DATA -->
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

    <!-- CSS -->
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

   
<style>

/* TRAIT MOBILE */
@media(max-width:850px){
    nav{
        border-top:3px solid #ffffff55 !important;
        top:70px;
    }
}

.nav-links{
    display:flex;
    gap:22px;
}

.nav-links a{
    color:white;
    font-weight:500;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
    padding:8px 12px;
    border-radius:6px;
    transition:var(--transition);
}

.nav-links a:hover{
    background:rgba(255,255,255,0.12);
}


/* ===============================
   BURGER MENU — BASE
================================ */
.burger{
    display:none;
    position:absolute;
    left:15px;
    top:18px;
    cursor:pointer;
    z-index:3000;
}

.burger div{
    width:28px;
    height:4px;
    background:white;
    margin:5px;
    border-radius:3px;
    transition:0.4s;
}


/* ===============================
   MENU MOBILE — VERSION FINALE
================================ */
@media (max-width: 850px) {

    /* Bouton burger visible */
    .burger {
        display: block;
    }

    .burger div {
        width: 28px;
        height: 4px;
        background: white;
        margin: 5px;
        border-radius: 3px;
        transition: 0.4s;
    }

    /* Animation croix */
    .burger.toggle div:nth-child(1) {
        transform: rotate(45deg) translate(5px, 6px);
    }

    .burger.toggle div:nth-child(2) {
        opacity: 0;
    }

    .burger.toggle div:nth-child(3) {
        transform: rotate(-45deg) translate(6px, -6px);
    }

    /* Menu mobile */
    .nav-links {
        position: fixed;
        top: 65px;
        left: 0;
        width: 75%;
        height: 100vh;
        background: var(--primary-dark);
        flex-direction: column;
        padding-top: 20px;
        gap: 18px;
        display: none;
        z-index: 2000;
    }

    .nav-links.nav-active {
        display: flex;
        animation: slideDown 0.3s ease-out;
    }

    .nav-links a {
        padding: 15px 20px;
        font-size: 18px;
        width: 100%;
        text-align: left;
    }

    @keyframes slideDown {
        from { opacity: 0; transform: translateX(-10px); }
        to   { opacity: 1; transform: translateX(0); }
    }
}


/* ===============================
   BOUTON RETOUR HAUT
================================ */
.top-btn{
    position:fixed;
    bottom:25px;
    right:20px;
    background:var(--secondary);
    padding:14px 16px;
    border-radius:50%;
    cursor:pointer;
    color:white;
    display:none;
    z-index:3000;
    box-shadow:var(--shadow);
    transition:var(--transition);
}

.top-btn.show{
    display:flex;
    justify-content:center;
    align-items:center;
}

.top-btn i{
    font-size:18px;
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
    <div id="topBtn" class="top-btn" onclick="window.scrollTo({ top: 0, behavior: 'smooth' });">
        <i class="fa-solid fa-arrow-up"></i>
    </div>

    <!-- ===== HEADER ===== -->
    <header>
        <div class="header-left">
            <img src="img/logo_AJEFEM.png" class="logo-img">

            <div>
                <div class="logo-text">AJEFEM</div>
                <p class="subtitle">Action de Jeunes et Femmes pour l’Entraide Mutuelle</p>
            </div>
        </div>

        <div class="lang-switcher">
            <a href="?lang=fr"><img src="img/fr.jpeg" class="flag"> Français</a>
            <a href="?lang=en"><img src="img/en.png" class="flag"> English</a>
        </div>
    </header>

    <!-- ===== NAV ===== -->
    <nav>
        <div class="burger">
            <div></div><div></div><div></div>
        </div>

        <div class="nav-links">
            <a href="index.php"><i class="fa-solid fa-house"></i> <?= t('menu_home') ?></a>
            <a href="about.php"><i class="fa-solid fa-circle-info"></i> <?= t('menu_about') ?></a>
            <a href="programmes.php"><i class="fa-solid fa-book"></i> <?= t('menu_programs') ?></a>
            <a href="realisations.php"><i class="fa-solid fa-chart-line"></i> <?= t('menu_projects') ?></a>
            <a href="equipe.php"><i class="fa-solid fa-users"></i> <?= t('menu_team') ?></a>
            <a href="galerie.php"><i class="fa-solid fa-image"></i> <?= t('menu_gallery') ?></a>
            <a href="don.php"><i class="fa-solid fa-hand-holding-heart"></i> <?= t('menu_donate') ?></a>
            <a href="contact.php"><i class="fa-solid fa-envelope"></i> <?= t('menu_contact') ?></a>
        </div>
    </nav>

    <!-- ===== HERO ===== -->
    <div class="hero">
        <h1><?= t('hero_title') ?></h1>
        <p><?= t('hero_subtitle') ?></p>
        <a href="don.php" class="btn"><?= t('support_us') ?></a>
    </div>

    <!-- ===== PARTENAIRES ===== -->
    <div class="section">
        <h2><?= t('partners') ?></h2>

        <div class="partners">
            <img src="img/logoSCI.jpg">
            <img src="img/logo.jpeg">
           
             <img src="img/logo_sedec.JPG">
            <img src="img/logo_bca.JPG">
             <img src="img/FOSI.JPG">
             
        </div>
    </div>

    <!-- ===== ACTIONS ===== -->
    <div class="section section--center">
        <a href="adhesion.php" class="btn"><?= t('join') ?></a>
        <a href="programmes.php" class="btn btn--primary"><?= t('discover_programs') ?></a>
    </div>

    <!-- ===== FOOTER ===== -->
    <footer class="footer">

        <div class="footer-grid">

            <div class="footer-brand">
                <h4>AJEFEM</h4>
                <p><?= t('welcome_text') ?></p>
                <img src="img/logo_AJEFEM.png" class="footer-logo">
            </div>

            <div>
                <h4><?= t('footer_nav') ?></h4>
                <a href="index.php"><?= t('menu_home') ?></a><br>
                <a href="about.php"><?= t('menu_about') ?></a><br>
                <a href="programmes.php"><?= t('menu_programs') ?></a><br>
                <a href="realisations.php"><?= t('menu_projects') ?></a><br>
                <a href="equipe.php"><?= t('menu_team') ?></a><br>
                <a href="galerie.php"><?= t('menu_gallery') ?></a><br>
                <a href="don.php"><?= t('menu_donate') ?></a><br>
                <a href="contact.php"><?= t('menu_contact') ?></a>
            </div>

            <div>
                <h4><?= t('footer_contact') ?></h4>
                <p><i class="fa-solid fa-phone"></i> +243 826 704 930</p>
                <p><i class="fa-solid fa-envelope"></i> ajefemasbl@gmail.com</p>
                <p><i class="fa-solid fa-location-dot"></i> Bukavu / RDC</p>
            </div>

            <div>
                <h4><?= t('footer_follow') ?></h4>

                <a href="https://www.facebook.com/profile.php?id=61584040439031" target="_blank">
                    <i class="fa-brands fa-facebook fa-2x"></i>
                </a>

                <a href="https://whatsapp.com/channel/0029Vb6zrpcEKyZK2v8hvd3m" target="_blank">
                    <i class="fa-brands fa-whatsapp fa-2x"></i>
                </a>

                <a href="https://youtube.com/@ajefemasbl?si=pHFxNuAwpGXzop-E" target="_blank">
                    <i class="fa-brands fa-youtube fa-2x"></i>
                </a>
            </div>

        </div>

        <div class="copyright">
            © <?= date("Y") ?> AJEFEM – <?= t('footer_rights') ?><br>
            <?= t('footer_dev') ?>
        </div>

    </footer>

    <!-- ===== Script TOP ===== -->
    <script>
        const topBtn = document.getElementById("topBtn");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) topBtn.classList.add("show");
            else topBtn.classList.remove("show");
        });

        topBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    </script>

   <script>
document.addEventListener('DOMContentLoaded', () => {

    const burger = document.querySelector('.burger');
    const navMenu = document.querySelector('.nav-links');

    burger.addEventListener('click', () => {
        burger.classList.toggle('toggle');
        navMenu.classList.toggle('nav-active');
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
