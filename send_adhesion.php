<?php
// Charger la connexion PDO
require_once "config.php";

/* --- TRAITEMENT DU FORMULAIRE --- */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name       = trim($_POST["name"] ?? "");
    $email      = trim($_POST["email"] ?? "");
    $phone      = trim($_POST["phone"] ?? "");
    $sex        = trim($_POST["sex"] ?? "");
    $address    = trim($_POST["address"] ?? "");
    $profession = trim($_POST["profession"] ?? "");
    $message    = trim($_POST["message"] ?? "");

    // Vérification des champs obligatoires
    if ($name === "" || $email === "" || $phone === "" || $sex === "" || $address === "") {
        header("Location: adhesion.php?error=" . urlencode("Veuillez remplir tous les champs obligatoires."));
        exit();
    }

    try {

        // Préparer la requête d'insertion
        $sql = "INSERT INTO adhesions_requets 
                (name, email, phone, sex, address, profession, message)
                VALUES (:name, :email, :phone, :sex, :address, :profession, :message)";

        $stmt = $pdo->prepare($sql);

        // Exécuter la requête
        $stmt->execute([
            ":name"       => $name,
            ":email"      => $email,
            ":phone"      => $phone,
            ":sex"        => $sex,
            ":address"    => $address,
            ":profession" => $profession,
            ":message"    => $message
        ]);

        // Message de succès
        header("Location: adhesion.php?success=" . urlencode("Votre adhésion a été envoyée avec succès !"));
        exit();

    } catch (Exception $e) {

        // Message d'erreur
        header("Location: adhesion.php?error=" . urlencode("Erreur lors de l'enregistrement. Veuillez réessayer."));
        exit();
    }
}

// Si aucune donnée n'a été envoyée
header("Location: adhesion.php?error=" . urlencode("Aucune donnée reçue."));
exit();
?>
