<?php
// ====================================
//  sidebar.php  - AJEFEM
// ====================================
?>
<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="img/logo_AJEFEM.png" alt="Logo AJEFEM">
        <div class="sidebar-title">AJEFEM</div>
        <div class="sidebar-sub">Panel Administrateur</div>
    </div>

    <nav class="sidebar-nav">
        <a href="dashboard.php" class="active">
            <span class="icon">📊</span> Tableau de bord
        </a>
        <a href="liste_membres.php">
            <span class="icon">📇</span> Liste des membres
        </a>
        <a href="ajouter_membre.php">
            <span class="icon">➕👤</span> Ajouter un membre
        </a>
        <a href="gestion_cotisations.php">
            <span class="icon">💰</span> Cotisations & adhésions
        </a>
        <a href="generer_carte.php">
            <span class="icon">🎫</span> Cartes AJEFEM (QR Code)
        </a>
        <a href="generer_carteService.php">
            <span class="icon">🎫</span> Cartes Service
        </a>
        <a href="fiches_adhesion.php">
            <span class="icon">📑</span> Fiches d’adhésion
        </a>
        <a href="points_focaux.php">
            <span class="icon">📍</span> Points focaux
        </a>
        <a href="liste_membresonline.php">
            <span class="icon">🌍</span> Adhésions en ligne
        </a>
        <a href="messages_contact.php">
            <span class="icon">✉️</span> Messages reçus
        </a>
        <a href="documents.php">
            <span class="icon">📂</span> Documents & PV
        </a>
        <a href="realisationsAdd.php">
            <span class="icon">🛠️</span> Ajouter réalisation
        </a>
        <a href="liste_realisations.php">
            <span class="icon">🏆</span> Nos réalisations
        </a>
        <a href="getion_projets.php">
            <span class="icon">📌</span> Nos Projets
        </a>
        <a href="rapport_mensuel.php">
            <span class="icon">📆</span> Nos Rapports
        </a>
        
        <a href="verifications_admin.php">
            <span class="icon">📆</span> Les scans carte service
        </a>
        
    </nav>

    <div class="sidebar-footer">
        © <?= date('Y'); ?> AJEFEM<br>
        Actions de Jeunes et Femmes pour l’Entraide Mutuelle
    </div>
</aside>
