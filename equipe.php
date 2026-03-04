<?php
// =============================
//   GESTION DES LANGUES
// =============================
$lang = $_GET['lang'] ?? 'fr';

// =============================
//   TRADUCTIONS COMPLÈTES
// =============================
$text = [

/* ===========================
        FRANÇAIS
   =========================== */
"fr" => [

    /* TITRE PAGE ABOUT */
    "title" => "À propos de l’AJEFEM",
    "subtitle_header" => "Action de Jeunes et Femmes pour l’Entraide Mutuelle",

    /* MENU */
    "menu_home" => "Accueil",
    "menu_about" => "À propos",
    "menu_programs" => "Programmes",
    "menu_projects" => "Nos réalisations",
    "menu_team" => "Notre équipe",
    "menu_gallery" => "Images & vidéos",
    "menu_donate" => "Faire un don",
    "menu_contact" => "Contact",

    /* FOOTER */
    "footer_nav" => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow" => "Suivez-nous",
    "footer_rights" => "Tous droits réservés",
    "footer_dev" => "Développé avec ❤️ par MS Solutions Lab",

    /* ABOUT TITRES */
    "blocks_titles" => [
        "Préambule",
        "Création et Dénomination",
        "Siège Social",
        "Rayon d’Action",
        "Objet Social",
        "Stratégies d’Intervention",
        "Groupes Cibles",
        "Domaines d’Intervention",
        "Vision",
        "Mission"
    ],

    /* ABOUT TEXTES */
    "blocks_texts" => [
        "Toute initiative tendant vers une évolution doit être au profit des communautés vulnérables...",
        "Créée le 08 octobre 2020 à Bukavu...",
        "Le siège social est situé à l’Avenue Cercle Hypique...",
        "L’action de l’AJEFEM couvre toute la RDC...",
        "<ul>
            <li>Développer le potentiel des jeunes et des femmes ;</li>
            <li>Éveiller la conscience citoyenne ;</li>
        </ul>",
        "<ul>
            <li>Organisation d’ateliers...</li>
            <li>Actions pilotes...</li>
        </ul>",
        "Jeunes désœuvrés, femmes victimes...",
        "<ul>
            <li>Éducation à la paix</li>
            <li>Agriculture</li>
        </ul>",
        "Former un réseau de jeunes...",
        "Promouvoir les stratégies de développement intégré..."
    ],

    "footer_text" => "Unir les jeunes et les femmes pour l’entraide mutuelle."
],


/* ===========================
        ANGLAIS
   =========================== */
"en" => [

    /* TITRE PAGE ABOUT */
    "title" => "About AJEFEM",
    "subtitle_header" => "Action of Youth and Women for Mutual Aid",

    /* MENU */
    "menu_home" => "Home",
    "menu_about" => "About",
    "menu_programs" => "Programs",
    "menu_projects" => "Our Achievements",
    "menu_team" => "Our Team",
    "menu_gallery" => "Images & Videos",
    "menu_donate" => "Donate",
    "menu_contact" => "Contact",

    /* FOOTER */
    "footer_nav" => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow" => "Follow us",
    "footer_rights" => "All rights reserved",
    "footer_dev" => "Developed with ❤️ by MS Solutions Lab",

    /* ABOUT TITLES */
    "blocks_titles" => [
        "Preamble",
        "Creation & Name",
        "Head Office",
        "Scope of Action",
        "Social Purpose",
        "Intervention Strategies",
        "Target Groups",
        "Fields of Intervention",
        "Vision",
        "Mission"
    ],

    /* ABOUT TEXTS */
    "blocks_texts" => [
        "Every initiative aimed at development must benefit vulnerable communities...",
        "AJEFEM is a nonprofit created on October 8, 2020...",
        "The head office is located at Avenue Cercle Hypique...",
        "AJEFEM operates throughout the DRC...",
        "<ul>
            <li>Develop youth & women potential;</li>
        </ul>",
        "<ul>
            <li>Workshops;</li>
        </ul>",
        "Youth, women survivors...",
        "<ul>
            <li>Education</li>
        </ul>",
        "Build a network...",
        "Promote integrated strategies..."
    ],

    "footer_text" => "Uniting youth and women for mutual aid."
]

];

// Fonction raccourcie
function t($key) {
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

<!-- MENU RESPONSIVE -->
<!-- 🌟 AJOUT : MENU SLIDE-RIGHT + FULLSCREEN + BLUR + FOND CLAIR -->
<style>

@media(max-width:768px){

    /* ============================
       🔵 BOUTON BURGER
    ============================ */
    .burger {
        display: block;
        position: absolute;
        left: 15px;
        top: 22px;
        cursor: pointer;
        z-index: 4001;
    }

    .burger div {
        width: 28px;
        height: 4px;
        background: #000 !important; /* TRAITS NOIRS */
        margin: 5px;
        transition: 0.4s;
        border-radius: 3px;
    }

    /* Animation BURGER → CROIX */
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
       🔵 MENU VERSION PLEIN ÉCRAN
    ============================ */
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: rgba(255,255,255,0.90);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);

        flex-direction: column;
        align-items: flex-start;

        padding-top: 120px;
        padding-left: 40px;

        display: none;
        z-index: 4000;

        animation: slideRight .35s ease-out;
    }

    /* Slide animation */
    @keyframes slideRight {
        from { transform: translateX(100%); opacity: 0; }
        to   { transform: translateX(0); opacity: 1; }
    }

    .nav-active { 
        display: flex !important; 
    }


    /* ============================
       🔵 LIENS DU MENU
    ============================ */
    .nav-links a {
        font-size: 22px;
        padding: 15px 0;
        color: #000 !important; /* TEXTE NOIR */
        font-weight: 600;
        display: flex;
        align-items: center;
    }


    /* ============================
       🔵 SUPPRESSION DES <i>
       (pour éviter le doublon)
    ============================ */
    .nav-links a i {
        display: none !important;
    }


    /* ============================
       🔵 Icônes FontAwesome via CSS
       (NOIR – propres)
    ============================ */
    .nav-links a::before {
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        margin-right: 12px;
        display: inline-block;
        color: #000;
    }

    .nav-links a[href*='index']::before        { content: "\f015"; }
    .nav-links a[href*='about']::before        { content: "\f129"; }
    .nav-links a[href*='realisations']::before { content: "\f201"; }
    .nav-links a[href*='equipe']::before       { content: "\f500"; }
    .nav-links a[href*='galerie']::before      { content: "\f03e"; }
    .nav-links a[href*='programmes']::before   { content: "\f02d"; }
    .nav-links a[href*='don']::before          { content: "\f4c0"; }
    .nav-links a[href*='contact']::before      { content: "\f0e0"; }

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


<style>
.team-hero {
    width: 100%;
    height: 280px;
    background: linear-gradient(135deg, #0b3d91, #061d4d);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    box-shadow: 0 4px 18px rgba(0,0,0,0.18);
}

.team-hero-overlay {
    text-align: center;
    color: #fff;
    animation: fadeIn 1.4s ease-in-out;
}

.team-hero-logo {
    width: 85px;
    margin-bottom: 8px;
}

.team-hero-title {
    font-size: 38px;
    font-weight: 800;
}

.team-hero-subtitle {
    margin-top: 5px;
    font-size: 17px;
    opacity: .9;
}

@media(max-width:650px){
    .team-hero-title{ font-size: 28px; }
    .team-hero-subtitle{ font-size: 15px; }
}
</style>


    <!-- ===== BOUTON TOP ===== -->
<div id="topBtn" class="top-btn">
    <i class="fa-solid fa-arrow-up"></i>
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

<!-- MENU -->
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

<script>
/* … ton JS burger ici (inchangé)… */
</script>

<!-- TON CONTENU ABOUT ICI (inchangé) -->

<!-- ========================================= -->
<!--      MEMBRES FONDATEURS – VERSION GRID    -->
<!-- ========================================= -->

<!-- ========================================= -->
<!--      MEMBRES FONDATEURS – VERSION GRID    -->
<!-- ========================================= -->

<style>
.founders-section {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

.founders-section .section-title {
    text-align: center;
    font-size: 32px;
    color: #0b3d91;
    font-weight: bold;
    margin-bottom: 30px;
}

/* GRID */
.founders-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
}

@media(max-width:992px){
    .founders-grid { grid-template-columns: repeat(3,1fr); }
}

@media(max-width:768px){
    .founders-grid { grid-template-columns: repeat(2,1fr); }
}

@media(max-width:500px){
    .founders-grid { grid-template-columns: 1fr; }
}

/* CARTE */
/* SECTION ÉQUIPE AJEFEM – VERSION PROFESSIONNELLE */
.founders-section {
    max-width: 1200px;
    margin: 30px auto 80px;
    padding: 20px;
}

.founders-grid {
    display: grid;
    grid-template-columns: repeat(4,1fr);
    gap: 28px;
}

@media(max-width:992px){
    .founders-grid { grid-template-columns: repeat(3,1fr); }
}
@media(max-width:768px){
    .founders-grid { grid-template-columns: repeat(2,1fr); }
}
@media(max-width:520px){
    .founders-grid { grid-template-columns: 1fr; }
}

/* CARTE PREMIUM */
.founder-card {
    background: #fff;
    padding: 25px;
    border-radius: 14px;
    box-shadow: 0 5px 18px rgba(0,0,0,0.10);
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: .35s ease;
    border: 1px solid #f1f1f1;
}

/* Effet premium au survol */
.founder-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 8px 22px rgba(0,0,0,0.18);
}

/* Badge fonction */
.founder-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--color, #0b3d91);
    color: #fff;
    font-size: 12px;
    padding: 6px 12px;
    border-radius: 30px;
    font-weight: bold;
    box-shadow: 0 2px 6px rgba(0,0,0,0.25);
}

/* PHOTO */
.founder-img {
    width: 115px;
    height: 115px;
    object-fit: contain !important;   /* ✔ ne coupe plus jamais les images */
    background: #f5f5f5;              /* ✔ fond propre derrière l’image */
    border-radius: 50%;
    border: 4px solid #fff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    padding: 5px;                     /* ✔ ajoute un espace interne pour les photos verticales */
    margin-bottom: 15px;
}


/* NOM */
.founder-card h3 {
    font-size: 18px;
    font-weight: 800;
    color: #0b3d91;
    margin-bottom: 6px;
}

/* FONCTION */
.founder-card .qualite {
    font-size: 14px;
    color: #555;
    font-style: italic;
    font-weight: 500;
}


.founder-card:hover {
    transform: translateY(-6px);
}

/* IMAGE */
.founder-img {
    width: 110px;
    height: 110px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 15px;
    border: 3px solid #eee;
}

/* NOM */
.founder-card h3 {
    font-size: 17px;
    font-weight: 700;
    color: #0b3d91;
    margin-bottom: 5px;
}

/* QUALITE */
.founder-card .qualite {
    font-size: 14px;
    color: #444;
    font-style: italic;
}
/* BOUTON RETOUR EN HAUT */
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

<h2 class="team-section-title">
    <i class="fa-solid fa-people-group"></i>
    <?= t("menu_team") ?>
</h2>

<style>
.team-section-title {
    text-align: center;
    margin: 55px 0 25px;
    font-size: 34px;
    font-weight: 800;
    color: #0b3d91;
    text-transform: uppercase;
    letter-spacing: 1px;
}
.team-section-title i {
    margin-right: 10px;
    color: #f39c12;
}
/* ================================
   POPUP CV – AJEFEM PREMIUM
================================ */
.member-popup-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 5000;
    opacity: 0;
    visibility: hidden;
    transition: .3s;
}

.member-popup-overlay.active {
    opacity: 1;
    visibility: visible;
}

.member-popup {
    width: 90%;
    max-width: 520px;
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    text-align: center;
    animation: popupZoom .35s ease-out;
    position: relative;
}

@keyframes popupZoom {
    from { transform: scale(.7); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}

.popup-photo {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid #0b3d91;
    margin-bottom: 12px;
}

.popup-name {
    font-size: 22px;
    font-weight: 800;
    color: #0b3d91;
}

.popup-role {
    font-size: 15px;
    color: #444;
    font-style: italic;
}

.popup-bio {
    margin-top: 10px;
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    text-align: left;
}

.popup-close {
    position: absolute;
    top: 15px;
    right: 18px;
    font-size: 22px;
    cursor: pointer;
    color: #0b3d91;
}

</style>

<div class="founders-section" data-aos="fade-up">

  
    <div class="founders-grid">

        <?php 
        $founders = [
             ["nom" => "MARTHE OPENGE La vie", "qualite" => "Présidente du Conseil d'Administration", "photo" => "marthe.jpeg"],
              ["nom" => "Florence MUNIHIRE", "qualite" => "Coordonnatrice provinciale Nord Kivu", "photo" => "Florence.JPG"],
          ["nom" => "BORA MUTUNWA Clarisse", "qualite" => "Coordonnatrice provinciale de la Tshopo", "photo" => "bora.JPG"],
         
            ["nom" => "MWAYUMA MALOWANI ESPERANCE", "qualite" => "Sensibilisatrice", "photo" => "espe.JPG"],
          ["nom" => "Francine WASOLELA Madeleine", "qualite" => "Sensibilisatrice", "photo" => "mer2.JPG"],
          
           ["nom" => "MWEZE EMMANUELA Léonie", "qualite" => "Membre", "photo" => "leoni.JPG"],
          ["nom" => "Pascaline MULAMBA", "qualite" => "Membre", "photo" => "PASSY.JPG"],
        
           ["nom" => "MANGAZA OPENGE La parfaite", "qualite" => "Comptable de la Coordination", "photo" => "mangaza.jpg"],
            ["nom" => "HENRIETTE MBULA Christelle", "qualite" => "Caissière de la Coordination", "photo" => "ok.JPG"],
             
             
              ["nom" => "Lucie BAUSIAGA SAFI", "qualite" => "Trésorière du CA", "photo" => "luciee.JPG"],
             ["nom" => "FATUMA ASSANI YVON", "qualite" => "Intendante de la Coordination", "photo" => "fatuma.jpg"],
             ["nom" => "UTIZIBUBI SERAPHINE", "qualite" => "Chargée de communication", "photo" => "seraphine.JPG"],
             ["nom" => "FLORIDA NTUZA MUNGUAKONKWA", "qualite" => "Membre", "photo" => "florida.jpg"],
           
              ["nom" => "Dr. MALOANI SAIDI Georges", "qualite" => "Coordonnateur National", "photo" => "georges.jpeg"],
         
            ["nom" => "COSMAS MUSAFIRI MUGONGO", "qualite" => "Chargé des Projets et Programmes", "photo" => "cosma.jpeg"],
           
            ["nom" => "KABE MUKAMBA ADOLPHE", "qualite" => "Secrétaire Rapporteur CA", "photo" => "soc.jpg"],
           
         
            ["nom" => "ANDRE MIZENI", "qualite" => "Chargé de RH", "photo" => "andre.jpeg"],
            
          ["nom" => "Matipa Kansabala Jean Claude", "qualite" => "Intendant ville de Bukavu", "photo" => "Capture.JPG"],
            
              ["nom" => "YUMBA NTOMPA OBADIA", "qualite" => "Point Focal KALEMI", "photo" => "ob.jpeg"],
           
        ];

        $colors = ["#0b3d91","#e67e22","#16a085","#9b59b6","#c0392b",
                   "#2ecc71","#1abc9c","#34495e","#d35400","#2980b9",
                   "#8e44ad","#27ae60","#f39c12","#2c3e50","#e74c3c"];

        foreach ($founders as $i => $f):

            $photo = "img/" . $f["photo"];
            if (!file_exists($photo)) $photo = "img/logo_AJEFEM.png";
        ?>

        <div class="founder-card"
     onclick="openCV(
        '<?= addslashes($f['nom']) ?>',
        '<?= addslashes($f['qualite']) ?>',
        '<?= addslashes($f['photo']) ?>',
        `<?= addslashes('') ?>`
     )"
     style="--color:<?= $colors[$i % count($colors)] ?>;">


            <img src="<?= $photo ?>" alt="<?= $f['nom'] ?>" class="founder-img">

            <div class="founder-badge"><?= $f["qualite"] ?></div>


        </div>

        <?php endforeach; ?>

    </div>

</div>


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

    const burger = document.querySelector(".burger");
    const navMenu = document.querySelector(".nav-links");
    const links = document.querySelectorAll(".nav-links a");

    if (burger && navMenu) {

        // OUVRIR / FERMER le menu
        burger.addEventListener("click", () => {
            navMenu.classList.toggle("nav-active");
            burger.classList.toggle("toggle");
        });

        // FERMER quand on clique sur un lien
        links.forEach(link => {
            link.addEventListener("click", () => {
                navMenu.classList.remove("nav-active");
                burger.classList.remove("toggle");
            });
        });
    }
});
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

<!-- POPUP CV AJEFEM -->
<div class="member-popup-overlay" id="cvPopup">
    <div class="member-popup">
        <div class="popup-close" onclick="closePopup()">×</div>
        <img id="popupPhoto" class="popup-photo">
        <h2 id="popupName" class="popup-name"></h2>
        <p id="popupRole" class="popup-role"></p>
        <div id="popupBio" class="popup-bio"></div>
    </div>
</div>
<script>
function openCV(nom, role, photo, bio) {
    document.getElementById("popupName").innerText = nom;
    document.getElementById("popupRole").innerText = role;
    document.getElementById("popupPhoto").src = "img/" + photo;
    document.getElementById("popupBio").innerHTML = bio;

    document.getElementById("cvPopup").classList.add("active");
}

function closePopup() {
    document.getElementById("cvPopup").classList.remove("active");
}
</script>

</body>
</html>
