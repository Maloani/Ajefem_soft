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
    "menu_home"=>"Accueil","menu_about"=>"À propos","menu_programs"=>"Programmes","menu_projects"=>"Nos réalisations",
    "menu_team"=>"Notre équipe","menu_gallery"=>"Images & vidéos","menu_donate"=>"Faire un don","menu_contact"=>"Contact",

    "footer_nav"=>"Navigation","footer_contact"=>"Contact","footer_follow"=>"Suivez-nous",
    "footer_rights"=>"Tous droits réservés","footer_dev"=>"Développé avec ❤️ par MS Solutions Lab",

    "title"=>"Faire un Don",
    "subtitle_header"=>"Action de Jeunes et Femmes pour l’Entraide Mutuelle",
    "don_title"=>"Soutenez Nos Actions",
    "don_desc"=>"Votre contribution nous aide à promouvoir la paix, l’autonomisation, le développement communautaire et la protection des plus vulnérables.",

    "payment_title"=>"Méthodes de Paiement",
    "mobile_money"=>"Mobile Money","bank"=>"Virement Bancaire","manual"=>"Don Manuel",

    "footer_text"=>"Unir les jeunes et les femmes pour l’entraide mutuelle."
],

"en" => [
    "menu_home"=>"Home","menu_about"=>"About","menu_programs"=>"Programs","menu_projects"=>"Our Achievements",
    "menu_team"=>"Our Team","menu_gallery"=>"Images & Videos","menu_donate"=>"Donate","menu_contact"=>"Contact",

    "footer_nav"=>"Navigation","footer_contact"=>"Contact","footer_follow"=>"Follow us",
    "footer_rights"=>"All rights reserved","footer_dev"=>"Developed with ❤️ by MS Solutions Lab",

    "title"=>"Make a Donation",
    "subtitle_header"=>"Action of Youth and Women for Mutual Aid",
    "don_title"=>"Support Our Mission",
    "don_desc"=>"Your contribution helps us promote peace, empowerment, community development and protection of vulnerable populations.",

    "payment_title"=>"Payment Methods",
    "mobile_money"=>"Mobile Money","bank"=>"Bank Transfer","manual"=>"Manual Donation",

    "footer_text"=>"Uniting youth and women for mutual aid."
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
/* ============================================
   STYLE SPÉCIFIQUE DON.PHP
============================================ */

.don-section {
    max-width: 1100px;
    margin: 50px auto;
    padding: 20px;
}

.section-title {
    text-align: center;
    font-size: 32px;
    color: #0b3d91;
    margin-bottom: 10px;
}

.don-desc {
    text-align: center;
    max-width: 700px;
    margin: 10px auto 40px;
    color: #444;
    font-size: 18px;
}

.don-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 35px;
}

.payment-box {
    padding: 20px;
    background: #fff;
    border-radius: 12px;
    border-left: 6px solid #0b3d91;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.payment-box h3 {
    color: #0b3d91;
    margin-bottom: 10px;
}

.payment-box p {
    margin: 6px 0;
}

.payment-box i {
    color: #0b3d91;
    margin-right: 6px;
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

<!-- TOP BUTTON -->
<div id="topBtn" class="top-btn"><i onclick="goTop()" class="fa-solid fa-arrow-up"></i></div>
<!-- ===== BOUTON TOP ===== -->
 <!-- ====== LOADER CIRCULAIRE AJEFEM ====== -->
<div id="loader-circle-container">
    <div class="loader-circle">
        <img src="img/logo_AJEFEM.png" class="loader-logo fade-in-logo">
    </div>
    <p class="loader-text">Chargement...</p>
</div>


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
<nav class="main-nav">
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

        <a href="contact.php" class="active">
            <i class="fa-solid fa-envelope"></i> <?= t('menu_contact') ?>
        </a>

    </div>
</nav>



<!-- DONATION PAGE -->
<div class="don-section">

    <h2 class="section-title" data-aos="fade-up"><?= t("don_title") ?></h2>
    <p class="don-desc" data-aos="fade-up"><?= t("don_desc") ?></p>

    <div class="don-grid">

        <!-- ************ FORMULAIRE SUPPRIMÉ ************ -->


        <!-- MÉTHODES DE PAIEMENT -->
        <div data-aos="fade-left">

            <h3 style="text-align:center; color:#0b3d91;"><?= t("payment_title") ?></h3>

            <!-- MOBILE MONEY -->
            <div class="payment-box" style="border-color:#e67e22;">
                <h3><i class="fa-solid fa-mobile-screen"></i> <?= t("mobile_money") ?></h3>
                <p><strong>M-PESA :</strong> +243 826 704 930</p>
                <p><strong>Airtel Money :</strong> +243 997 749 350</p>
            </div><br>

            

            <!-- DON MANUEL -->
            <div class="payment-box" style="border-color:#9b59b6;">
                <h3><i class="fa-solid fa-hand-holding-dollar"></i> <?= t("manual") ?></h3>
                <p>Vous pouvez effectuer un don manuel en nous contactant :</p>
                <p><i class="fa-solid fa-envelope"></i> ajefemasbl@gmail.com</p>
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
            <p><i class="fa-solid fa-envelope"></i> contact@ajefem.org</p>
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
