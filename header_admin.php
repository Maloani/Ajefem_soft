<?php
// ====================================
//  header_admin.php  - AJEFEM
// ====================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Vérification : uniquement ADMIN
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true || strtolower($_SESSION["role"]) !== "admin") {
    header("Location: login.php");
    exit();
}

$fullname = $_SESSION["fullname"] ?? "Administrateur";
$email    = $_SESSION["email"] ?? "";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrateur - AJEFEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #eef2f7;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #ff9800, #ff5722);
            color: #fff;
            padding: 20px 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar-logo img {
            width: 80px;
            height: auto;
            border-radius: 50%;
            background: #fff;
            padding: 5px;
        }

        .sidebar-title {
            margin-top: 8px;
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .sidebar-sub {
            font-size: 11px;
            opacity: 0.9;
        }

        .sidebar-nav {
            margin-top: 25px;
            flex: 1;
        }

        .sidebar-nav a {
            display: block;
            padding: 10px 12px;
            margin-bottom: 6px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            border-radius: 6px;
            transition: background 0.2s, transform 0.1s;
        }

        .sidebar-nav a span.icon {
            margin-right: 8px;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.18);
            transform: translateX(2px);
        }

        .sidebar-footer {
            font-size: 11px;
            margin-top: 10px;
            text-align: center;
            opacity: 0.85;
        }

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: #ffffff;
            padding: 12px 22px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .topbar-left h1 {
            font-size: 18px;
            margin: 0;
        }

        .topbar-left small {
            font-size: 12px;
            color: #555;
        }

        .topbar-right {
            font-size: 13px;
            text-align: right;
        }

        .topbar-right .name {
            font-weight: bold;
        }

        .topbar-right .email {
            font-size: 11px;
            color: #777;
        }

        .topbar-right a.logout-link {
            display:inline-block;
            margin-top:4px;
            padding:4px 10px;
            background:#ff5722;
            color:#fff;
            font-size:12px;
            border-radius:4px;
            text-decoration:none;
        }

        .topbar-right a.logout-link:hover {
            opacity:0.9;
        }

        .page-content {
            padding: 25px 25px 35px;
        }
    </style>
</head>

<body>
<div class="layout">

    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="topbar">
            <div class="topbar-left">
                <h1>Panel Administrateur</h1>
                <small>Gestion centrale de l’ASBL AJEFEM</small>
            </div>
            <div class="topbar-right">
                <div class="name"><?= htmlspecialchars($fullname) ?></div>
                <div class="email"><?= htmlspecialchars($email) ?></div>
                <a href="logout.php" class="logout-link">Se déconnecter</a>
            </div>
        </div>

        <div class="page-content">
