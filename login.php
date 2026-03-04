<?php
session_start();

$host     = "127.0.0.1";
$dbname   = "jfm_ajefemdb";
$user     = "jfm";
$password = 'LAFCp8&t6jCZY84h';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST["email"] ?? "");
    $passform = trim($_POST["password"] ?? "");

    if ($email === "" || $passform === "") {
        $erreur = "Veuillez renseigner l'email et le mot de passe.";
    } else {
        $sql  = "SELECT id, fullname, email, password_hash, role 
                 FROM users WHERE email = :email LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $passform === $user["password_hash"]) {
            $_SESSION["user_id"]   = $user["id"];
            $_SESSION["fullname"]  = $user["fullname"];
            $_SESSION["email"]     = $user["email"];
            $_SESSION["role"]      = $user["role"];
            $_SESSION["logged_in"] = true;

            header("Location: dashboard.php");
            exit();
        } else {
            $erreur = "Identifiants incorrects. Veuillez réessayer.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Connexion - AJEFEM</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
    * { box-sizing: border-box; font-family: 'Poppins', Arial, sans-serif; }

    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(140deg, #781515 0%, #9b2929 60%, #e35656 100%);
        animation: fadeBg 5s infinite alternate;
    }
    @keyframes fadeBg {
        from { filter: brightness(100%); }
        to { filter: brightness(115%); }
    }

    .login-container {
        width: 100%;
        max-width: 440px;
        background: #ffffffd9;
        backdrop-filter: blur(10px);
        padding: 35px 28px 40px;
        border-radius: 16px;
        box-shadow: 0 10px 35px rgba(0,0,0,0.25);
        text-align: center;
        animation: slideUp .6s ease-out;
    }
    @keyframes slideUp {
        from { transform: translateY(40px); opacity: 0;}
        to { transform: translateY(0); opacity: 1; }
    }

    .logo {
        width: 120px;
        margin-bottom: 12px;
        filter: drop-shadow(0 3px 3px rgba(0,0,0,0.25));
        transition: transform .3s;
    }
    .logo:hover { transform: scale(1.05); }

    h1 {
        margin: 5px 0 3px;
        font-size: 24px;
        font-weight: 700;
        color: #700000;
    }

    .subtitle {
        font-size: 12px;
        color: #222;
        margin-bottom: 22px;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .form-group { margin-bottom: 18px; text-align: left; }

    label {
        font-size: 13px;
        font-weight: 600;
        color: #333;
        margin-bottom: 4px;
        display: flex;
        justify-content: space-between;
    }

    input {
        width: 100%;
        border-radius: 8px;
        border: 2px solid #ccc;
        padding: 12px;
        font-size: 14px;
        transition: .3s;
    }
    input:focus {
        border-color: #ff5722;
        box-shadow: 0 0 8px rgba(255,75,43,0.3);
    }

    .btn-login {
        width: 100%;
        padding: 12px 0;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(90deg, #ff9800, #ff5722);
        transition: .3s;
        transform: scale(1);
    }
    .btn-login:hover {
        transform: translateY(-3px);
        filter: brightness(110%);
    }

    .error {
        background: #ffe0e0;
        color: #b30000;
        padding: 10px;
        border-radius: 6px;
        font-size: 14px;
        margin-bottom: 12px;
        border-left: 5px solid #c40000;
    }

    .forgot {
        font-size: 12px;
        text-align: right;
        margin-top: 4px;
    }
    .forgot a { color: #e53935; text-decoration: none; }
    .forgot a:hover { text-decoration: underline;}

    .footer-info {
        margin-top: 18px;
        font-size: 11px;
        color: #111;
        font-weight: 500;
    }
    .footer-info span {
        font-weight: bold;
        color: #700000;
    }
    /* Icônes sociales AJEFEM */
@font-face {
    font-family: "FontAwesome";
    src: url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/fonts/fontawesome-webfont.woff2");
}

.social-media {
    margin-top: 18px;
    display: flex;
    justify-content: center;
    gap: 15px;
}

.social-media a {
    font-family: "FontAwesome";
    font-size: 18px;
    background: #fff;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: .3s;
    box-shadow: 0 4px 8px rgba(0,0,0,0.20);
}

.social-media a:hover {
    transform: translateY(-3px) scale(1.1);
    filter: brightness(120%);
}

.fb { color: #1877f2; }
.tw { color: #000; }
.wa { color: #25d366; }
.yt { color: #ff0000; }
/* Visibilité du mot de passe */
.password-wrapper {
    position: relative;
    width: 100%;
}
.toggle-eye {
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 16px;
    opacity: .6;
    transition: .2s;
}
.toggle-eye:hover {
    opacity: 1;
}

/* Force du mot de passe */
.strength {
    margin-top: 6px;
    font-size: 12px;
    font-weight: bold;
    height: 14px;
}
.strength.weak { color: #c70000; }
.strength.medium { color: #e99a00; }
.strength.strong { color: #009d20; }

/* Animation bouton */
.btn-login.loading {
    pointer-events: none;
    opacity: .8;
    position: relative;
}
.btn-login.loading::after {
    content: "";
    width: 18px;
    height: 18px;
    border: 3px solid transparent;
    border-top-color: #fff;
    border-radius: 50%;
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    animation: spin 0.8s linear infinite;
}
@keyframes spin {
    from { transform: translateY(-50%) rotate(0deg); }
    to   { transform: translateY(-50%) rotate(360deg); }
}

</style>
</head>
<body>

<div class="login-container">
    <img src="img/logo_AJEFEM.png" class="logo" alt="Logo AJEFEM">

    <h1>ESPACE MEMBRE</h1>
    <div class="subtitle">ACTIONS DE JEUNES ET FEMMES POUR L'ENTRAIDE MUTUELLE</div>

    <?php if ($erreur): ?>
        <div class="error"><?= htmlspecialchars($erreur); ?></div>
    <?php endif; ?>

    <form method="post" action="login.php">
        <div class="form-group">
            <label>Email de connexion</label>
            <input type="email" name="email" placeholder="ex: membre@ajefem.org" required>
        </div>

        <div class="form-group">
            <label>Mot de passe</label>
            <div class="password-wrapper">
    <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
    <span id="togglePass" class="toggle-eye">👁️</span>
</div>

<div id="strengthMsg" class="strength"></div>

<div class="forgot">
    <a href="forgot_password.php">Mot de passe oublié ?</a>
</div>

        </div>

        <button type="submit" class="btn-login">SE CONNECTER</button>
    </form>

       <div class="social-media">
        <a href="https://facebook.com" target="_blank" class="fb"></a>
        <a href="https://twitter.com" target="_blank" class="tw"></a>
        <a href="https://wa.me/000000000" target="_blank" class="wa"></a>
        <a href="https://youtube.com" target="_blank" class="yt"></a>
    </div>

    <div class="footer-info">
        © <?= date('Y'); ?> <span>AJEFEM</span> – Tous droits réservés.
    </div>
</div>

</div>
<script>
// 👁️ Affichage / masquage du mot de passe
document.getElementById("togglePass").addEventListener("click", function () {
    const passField = document.getElementById("password");
    passField.type = passField.type === "password" ? "text" : "password";
    this.textContent = passField.type === "password" ? "👁️" : "🙈";
});

// 💪 Indicateur de force du mot de passe
document.getElementById("password").addEventListener("keyup", function () {
    const strengthMsg = document.getElementById("strengthMsg");
    const value = this.value;
    let strength = "weak";

    if (value.length > 5 && /[A-Z]/.test(value) && /\d/.test(value)) strength = "medium";
    if (value.length > 8 && /[^A-Za-z0-9]/.test(value)) strength = "strong";

    strengthMsg.textContent =
        strength === "weak" ? "Force : Faible" :
        strength === "medium" ? "Force : Moyenne" :
        "Force : Forte";

    strengthMsg.className = "strength " + strength;
});

// ⏳ Animation envoi formulaire
document.querySelector("form").addEventListener("submit", function () {
    const btn = document.querySelector(".btn-login");
    btn.classList.add("loading");
});
</script>

</body>
</html>
