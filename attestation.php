<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>QR – Attestation de Réussite Doctorat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- QR Code Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f3f3;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            background: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            width: 360px;
            text-align: center;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }
        h2 {
            font-size: 17px;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #700000;
        }
        p {
            font-size: 13px;
            margin: 3px 0;
            color: #111;
            line-height: 1.3rem;
        }
        #qrcode {
            margin: 15px auto;
        }
        .footer {
            font-size: 11px;
            color: #444;
            margin-top: 10px;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>ATTTESTATION DE RÉUSSITE DE DOCTORAT</h2>

    <p><strong>Nom & Prénom :</strong> BOUDA EDOUARD</p>
    <p><strong>Né le :</strong> 05/01/1980 au Burkina Faso</p>
    <p><strong>Matricule :</strong> 363PHDA22</p>
    <p><strong>Faculté :</strong> Sciences Economiques et de gestion</p>
    <p><strong>Département :</strong> Gestion des Entreprises</p>

    <div id="qrcode"></div>

    <p class="footer">
        Scanner le QR Code pour une vérification officielle
    </p>
</div>

<script>
    // Lien cible du QR Code
    const url = "https://authentification.cirep.ac.cd";

    // Génération du QR Code
    new QRCode(document.getElementById("qrcode"), {
        text: url,
        width: 220,
        height: 220
    });
</script>

</body>
</html>
