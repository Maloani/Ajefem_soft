<?php
// ======================================
//   config.php - AJEFEM
//   Fichier central de connexion DB
// ======================================

// Empêcher l'accès direct au fichier
if (basename($_SERVER["PHP_SELF"]) == basename(__FILE__)) {
    die("Accès direct interdit.");
}

// Paramètres de connexion
$db_host = "127.0.0.1";     // À adapter si ton hébergeur fournit autre chose
$db_name = "jfm_ajefemdb";
$db_user = "jfm";
$db_pass = 'LAFCp8&t6jCZY84h';  // IMPORTANT : guillemets simples !!

// Connexion PDO
try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8",
        $db_user,
        $db_pass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("<h3 style='color:red;'>Erreur de connexion à la base de données :</h3>" 
        . $e->getMessage());
}
?>
