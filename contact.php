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

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Suivez-nous",
    "footer_rights"  => "Tous droits réservés",
    "footer_dev"     => "Développé avec ❤️ par MS Solutions Lab",

    /* PAGE CONTACT */
    "title"          => "Contactez-nous",
    "subtitle_header"=> "Action de Jeunes et Femmes pour l’Entraide Mutuelle",
    "contact_title"  => "Nous Contacter",
    "contact_desc"   => "Pour toute question, suggestion, partenariat ou collaboration, veuillez nous écrire via le formulaire ci-dessous.",
    "form_name"      => "Votre Nom",
    "form_email"     => "Votre Email",
    "form_phone"     => "Votre Téléphone",
    "form_message"   => "Votre Message",
    "form_send"      => "Envoyer le Message",
    "info_title"     => "Informations de Contact",

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

    /* FOOTER */
    "footer_nav"     => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Follow us",
    "footer_rights"  => "All rights reserved",
    "footer_dev"     => "Developed with ❤️ by MS Solutions Lab",

    /* PAGE CONTACT */
    "title"          => "Contact Us",
    "subtitle_header"=> "Action of Youth and Women for Mutual Aid",
    "contact_title"  => "Get in Touch",
    "contact_desc"   => "For any questions, suggestions, partnerships or collaborations, please write to us using the form below.",
    "form_name"      => "Your Name",
    "form_email"     => "Your Email",
    "form_phone"     => "Your Phone",
    "form_message"   => "Your Message",
    "form_send"      => "Send Message",
    "info_title"     => "Contact Information",

    "footer_text"    => "Uniting youth and women for mutual aid."
]

];

// Fonction raccourcie
function t($key){
    global $text, $lang;
    return $text[$lang][$key] ?? $key;
}

require_once "config.php"; // 🔥 Connexion MYSQL propre
?>

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
<style>
.main-header {
    background: #0b3d91;
    color: white;
    display: flex;
    justify-content: space-between;
    padding: 10px 20px;
    align-items: center;
    position: sticky;
    top: 0;
    width: 100%;
    z-index: 6000;
}

.header-left {
    display: flex;
    align-items: center;
}

.logo-img {
    height: 55px;
    margin-right: 10px;
}

.logo-text {
    font-size: 22px;
    font-weight: bold;
    color: white;
}

.subtitle {
    margin: 0;
    margin-top: -4px;
    font-size: 12px;
    color: #dce6ff;
}

.lang-switcher a {
    color: white;
    margin-left: 12px;
    font-size: 14px;
}
.lang-switcher a img {
    height: 18px;
    margin-right: 5px;
}
.main-nav {
    background: #0b3d91;
    position: sticky;
    top: 72px; /* colle sous le header */
    width: 100%;
    padding: 12px 0;
    z-index: 5000;
    box-shadow: 0px 3px 6px rgba(0,0,0,0.25);
}

.nav-links {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 28px;
}

.nav-links a {
    font-size: 18px;
    color: white !important;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
}

.nav-links a i {
    margin-right: 6px;
}
.burger {
    display: none;
}

@media(max-width:850px) {

    .burger {
        display: block;
        position: absolute;
        left: 15px;
        top: 18px;
        cursor: pointer;
        z-index: 6001;
    }

    .burger div {
        width: 30px;
        height: 4px;
        background: white;
        margin: 5px;
        border-radius: 4px;
    }

    .nav-links {
        position: fixed;
        top: 0;
        right: -100%;
        width: 80%;
        height: 100vh;
        background: #0b3d91;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-top: 120px;
        padding-left: 40px;
        transition: .4s;
    }

    .nav-links.nav-active {
        right: 0;
    }

    .nav-links a {
        color: white;
        font-size: 22px;
        padding: 15px 0;
    }

    /* Animation burger croix */
    .toggle div:nth-child(1){ transform:rotate(45deg) translate(6px,6px); }
    .toggle div:nth-child(2){ opacity:0; }
    .toggle div:nth-child(3){ transform:rotate(-45deg) translate(6px,-6px); }
}
@media(min-width:851px){
    .nav-links a::before {
        content: "" !important;
        margin: 0 !important;
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
<!-- CSS externes -->
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

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

<!-- HEADER -->
<!-- HEADER -->
<header class="main-header">
    <div class="header-left">
        <img src="img/logo_AJEFEM.png" class="logo-img" alt="AJEFEM">
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


<?php
// =============================
//     TRAITEMENT FORMULAIRE
// =============================
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom     = trim($_POST["nom"] ?? "");
    $email   = trim($_POST["email"] ?? "");
    $phone   = trim($_POST["phone"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($nom === "" || $email === "" || $phone === "" || $message === "") {
        $error = "Veuillez remplir tous les champs.";
    } else {

        $sql = "INSERT INTO contact_messages (nom, email, phone, message)
                VALUES (:nom, :email, :phone, :message)";

        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ":nom"     => $nom,
            ":email"   => $email,
            ":phone"   => $phone,
            ":message" => $message
        ])) {
            $success = "Votre message a été envoyé avec succès. Merci !";
        } else {
            $error = "Erreur serveur. Réessayez.";
        }
    }
}
?>

<!-- ============================= -->
<!--           CONTACT PAGE        -->
<!-- ============================= -->

<div class="contact-section">

    <h2 class="section-title" data-aos="fade-up"><?= t("contact_title") ?></h2>
    <p class="contact-desc" data-aos="fade-up"><?= t("contact_desc") ?></p>

    <div class="contact-grid">

<?php if ($success): ?>
    <div class="alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert-error"><?= $error ?></div>
<?php endif; ?>

<style>
.alert-success {
    background:#c8f7c5;
    padding:10px;
    border-left:4px solid #2ecc71;
    color:#1d5e28;
    margin-bottom:15px;
    border-radius:6px;
}
.alert-error {
    background:#f7c5c5;
    padding:10px;
    border-left:4px solid #e74c3c;
    color:#7b0000;
    margin-bottom:15px;
    border-radius:6px;
}
</style>

        <!-- FORMULAIRE -->
        <form class="contact-form" method="POST" data-aos="fade-right">

            <input type="text" name="nom" placeholder="<?= t("form_name") ?>" required>

            <input type="email" name="email" placeholder="<?= t("form_email") ?>" required>

            <input type="tel" name="phone" placeholder="<?= t("form_phone") ?>" required>

            <textarea name="message" rows="5" placeholder="<?= t("form_message") ?>" required></textarea>

            <button type="submit" class="btn-send">
                <i class="fa-solid fa-paper-plane"></i> <?= t("form_send") ?>
            </button>

        </form>

        <!-- INFORMATIONS -->
        <div class="contact-info" data-aos="fade-left">

            <h3><?= t("info_title") ?></h3>

            <p><i class="fa-solid fa-phone"></i> +243 826 704 930</p>
            <p><i class="fa-solid fa-envelope"></i> ajefemasbl@gmail.com</p>
            <p><i class="fa-solid fa-location-dot"></i> Bukavu – République Démocratique du Congo</p>

            <div class="social-icons">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#"><i class="fa-brands fa-youtube"></i></a>
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
