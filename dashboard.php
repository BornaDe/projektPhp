<?php
session_start();
require 'includes/db.php';

// Detalji o firmi (hardkodirani ili iz baze podataka)
$companyDetails = [
    'name' => 'Firma iz snova d.o.o.',
    'description' => 'Firma iz snova je vodeća kompanija u industriji zapošljavanja s dugogodišnjim iskustvom.',
    'location' => 'Zagreb, Hrvatska',
    'contact' => 'info@firmaizsnova.hr',
    'phone' => '+385 1 123 4567',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalji o firmi</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Google Maps API -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYhG9_GgFvaw9dxuJC1hjvy4Zq-O-uIbk&callback=initMap">
    </script>
    <script>
        function initMap() {
            // Lokacija firme (hardkodirana za primjer)
            const location = { lat: 45.815, lng: 15.981 };

            // Inicijalizacija mape
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
            });

            // Marker na lokaciji firme
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "Lokacija firme iz snova",
            });
        }
    </script>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
        <h1>Detalji o firmi</h1>
        <p><strong>Ime firme:</strong> <?= htmlspecialchars($companyDetails['name']); ?></p>
        <p><strong>Opis:</strong> <?= htmlspecialchars($companyDetails['description']); ?></p>
        <p><strong>Lokacija:</strong> <?= htmlspecialchars($companyDetails['location']); ?></p>
        <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($companyDetails['contact']); ?>"><?= htmlspecialchars($companyDetails['contact']); ?></a></p>
        <p><strong>Telefon:</strong> <?= htmlspecialchars($companyDetails['phone']); ?></p>

        <!-- Google Maps prikaz lokacije -->
        <div id="map"></div>
    </div>
</body>
</html>