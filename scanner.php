<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Scanner QR — AJEFEM</title>
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<style>
body{
    font-family: Arial;
    background:#eef2f7;
    padding:20px;
}
h2{ text-align:center;color:#0b3d91; }
.box {
    max-width:400px;
    margin:auto;
}
</style>
</head>

<body>

<h2>Scanner une Carte AJEFEM</h2>

<div class="box">
    <div id="reader" style="width:100%;"></div>
</div>

<script>
function onScanSuccess(decodedText, decodedResult) {
    window.location.href = decodedText; 
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
</script>

</body>
</html>
