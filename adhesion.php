<?php
// =============================
//        GESTION LANGUE
// =============================
$lang = $_GET['lang'] ?? 'fr';
if (!in_array($lang, ['fr','en'])) $lang = 'fr';

// =============================
//        TRADUCTIONS
// =============================
$text = [

"fr" => [
    "title"        => "Adhésion à l’AJEFEM",
    "subtitle_header" => "Action de Jeunes et Femmes pour l’Entraide Mutuelle",

    "menu_home"    => "Accueil",
    "menu_about"   => "À propos",
    "menu_programs"=> "Programmes",
    "menu_projects"=> "Nos réalisations",
    "menu_team"    => "Notre équipe",
    "menu_gallery" => "Images & vidéos",
    "menu_donate"  => "Faire un don",
    "menu_contact" => "Contact",
    "menu_join"    => "Adhésion",

    "form_title"   => "Formulaire d’adhésion",
    "form_desc"    => "Rejoignez l’AJEFEM et participez à nos actions pour l’entraide, la paix et le développement communautaire.",

    "name"         => "Nom complet",
    "email"        => "Email",
    "phone"        => "Téléphone",
    "sex"          => "Sexe",
    "sex_m"        => "Homme",
    "sex_f"        => "Femme",
    "address"      => "Adresse complète",
    "profession"   => "Profession",
    "message"      => "Votre message",
    "send_btn"     => "Envoyer l’adhésion",

    "success"      => "Votre demande d’adhésion a été envoyée avec succès ! Nous vous contacterons très bientôt.",

    "footer_nav"   => "Navigation",
    "footer_contact" => "Contact",
    "footer_follow"  => "Suivez-nous",
    "footer_rights"  => "Tous droits réservés",
    "footer_dev"     => "Développé avec ❤️ par MS Solutions Lab",
    "footer_text"    => "Unir les jeunes et les femmes pour l’entraide mutuelle."
],

"en" => [
    "title"        => "AJEFEM Membership",
    "subtitle_header" => "Action of Youth and Women for Mutual Aid",

    "menu_home"    => "Home",
    "menu_about"   => "About",
    "menu_programs"=> "Programs",
    "menu_projects"=> "Achievements",
    "menu_team"    => "Team",
    "menu_gallery" => "Images & Videos",
    "menu_donate"  => "Donate",
    "menu_contact" => "Contact",
    "menu_join"    => "Membership",

    "form_title"   => "Membership Form",
    "form_desc"    => "Join AJEFEM and take part in our actions for mutual aid, peace and community development.",

    "name"         => "Full name",
    "email"        => "Email",
    "phone"        => "Phone",
    "sex"          => "Gender",
    "sex_m"        => "Male",
    "sex_f"        => "Female",
    "address"      => "Complete address",
    "profession"   => "Profession",
    "message"      => "Your message",
    "send_btn"     => "Submit Membership",

    "success"      => "Your membership request has been sent successfully! We will contact you shortly.",

    "footer_nav"   => "Navigation",
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

// MESSAGE DE CONFIRMATION
$sent = isset($_GET["sent"]);
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

<!-- CSS externes -->
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* FORMULAIRE */
.form-section {
    max-width: 800px;
    margin: 40px auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
    box-shadow:0 6px 20px rgba(0,0,0,0.1);
}

.form-section h2 {
    text-align:center;
    font-size:30px;
    color:#0b3d91;
    margin-bottom:10px;
}

.form-section p {
    text-align:center;
    margin-bottom:25px;
    color:#555;
    font-size:17px;
}

.input-group {
    margin-bottom:20px;
}

.input-group label {
    font-weight:600;
    display:block;
    margin-bottom:6px;
    color:#0b3d91;
}

.input-group input,
.input-group select,
.input-group textarea {
    width:100%;
    padding:12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:16px;
}

textarea {
    height:120px;
}

.btn-submit {
    width:100%;
    padding:15px;
    background:#0b3d91;
    color:white;
    font-size:18px;
    border-radius:8px;
    border:none;
    cursor:pointer;
    transition:.3s;
}

.btn-submit:hover {
    background:#072f6b;
}

.success-box {
    background:#d4f8d4;
    padding:20px;
    border-left:6px solid #27ae60;
    border-radius:6px;
    margin-bottom:25px;
    font-size:18px;
    text-align:center;
    color:#145a32;
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
</style>

</head>
<body>
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
        <a href="index.php?lang=<?= $lang ?>"><?= t("menu_home") ?></a>
        <a href="about.php?lang=<?= $lang ?>"><?= t("menu_about") ?></a>
        <a href="programmes.php?lang=<?= $lang ?>"><?= t("menu_programs") ?></a>
        <a href="realisations.php?lang=<?= $lang ?>"><?= t("menu_projects") ?></a>
        <a href="equipe.php?lang=<?= $lang ?>"><?= t("menu_team") ?></a>
        <a href="galerie.php?lang=<?= $lang ?>"><?= t("menu_gallery") ?></a>
        <a href="adhesion.php?lang=<?= $lang ?>"><?= t("menu_join") ?></a>
        <a href="don.php?lang=<?= $lang ?>"><?= t("menu_donate") ?></a>
        <a href="contact.php?lang=<?= $lang ?>"><?= t("menu_contact") ?></a>
    </div>
</nav>


<!-- FORMULAIRE -->
<div class="form-section">
<?php if (!empty($_GET["success"])): ?>
    <div class="alert-success"><?= htmlspecialchars($_GET["success"]) ?></div>
<?php endif; ?>

<?php if (!empty($_GET["error"])): ?>
    <div class="alert-error"><?= htmlspecialchars($_GET["error"]) ?></div>
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

    <?php if($sent): ?>
        <div class="success-box">
            <?= t("success") ?>
        </div>
    <?php endif; ?>

    <h2><?= t("form_title") ?></h2>
    <p><?= t("form_desc") ?></p>

    <form action="send_adhesion.php" method="POST">

        <div class="input-group">
            <label><?= t("name") ?></label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label><?= t("email") ?></label>
            <input type="email" name="email" required>
        </div>

        <div class="input-group">
            <label><?= t("phone") ?></label>
            <input type="text" name="phone" required>
        </div>

        <div class="input-group">
            <label><?= t("sex") ?></label>
            <select name="sex" required>
                <option value="M"><?= t("sex_m") ?></option>
                <option value="F"><?= t("sex_f") ?></option>
            </select>
        </div>

        <div class="input-group">
            <label><?= t("address") ?></label>
            <input type="text" name="address" required>
        </div>

        <div class="input-group">
            <label><?= t("profession") ?></label>
            <input type="text" name="profession">
        </div>

        <div class="input-group">
            <label><?= t("message") ?></label>
            <textarea name="message"></textarea>
        </div>

        <button class="btn-submit"><?= t("send_btn") ?></button>

    </form>

</div>




<!-- FOOTER -->
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
        © <?= date("Y") ?> AJEFEM – <?= t('footer_rights') ?>
        <br><?= t('footer_dev') ?>
    </div>
</footer>


<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector(".burger");
    const nav = document.querySelector(".nav-links");
    burger.addEventListener("click", () => {
        nav.classList.toggle("nav-active");
        burger.classList.toggle("toggle");
    });
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
</body>
</html>
