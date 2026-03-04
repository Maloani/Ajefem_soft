<?php
// Déterminer la langue sélectionnée
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'fr';

// Empêcher les langues inconnues
if (!in_array($lang, ['fr', 'en'])) {
    $lang = 'fr';
}

// Charger les traductions depuis JSON
$translations = json_decode(file_get_contents("translations.json"), true);

// Fonction de traduction
function t($key) {
    global $translations, $lang;
    return $translations[$lang][$key] ?? $key;
}
?>
