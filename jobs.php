<?php
session_start();
require 'includes/db.php';

// Dohvati sve oglase iz baze
$stmt = $pdo->query("SELECT * FROM jobs");
$jobs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oglasi poslova</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        function showDetails(title, company, location, email, salary, description) {
            // Prikaži modal i postavi detalje
            const modal = document.getElementById('detailsModal');
            document.getElementById('modalTitle').textContent = title || "N/A";
            document.getElementById('modalCompany').textContent = company || "N/A";
            document.getElementById('modalLocation').textContent = location || "N/A";
            document.getElementById('modalEmail').textContent = email || "N/A";
            document.getElementById('modalSalary').textContent = salary ? `${salary} EUR` : "N/A";
            document.getElementById('modalDescription').textContent = description || "N/A";
            modal.style.display = 'flex'; // Prikaz modala
        }

        function closeDetails() {
            // Sakrij modal
            const modal = document.getElementById('detailsModal');
            modal.style.display = 'none'; // Sakrij modal
        }
    </script>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
        <h1>Oglasi poslova</h1>
        <div class="jobs-container">
            <?php foreach ($jobs as $job): ?>
                <div class="job-card" 
                     onclick="showDetails(
                        '<?= htmlspecialchars($job['title']); ?>', 
                        '<?= htmlspecialchars($job['company']); ?>', 
                        '<?= htmlspecialchars($job['location']); ?>', 
                        '<?= htmlspecialchars($job['email']); ?>', 
                        '<?= htmlspecialchars($job['salary']); ?>', 
                        '<?= htmlspecialchars($job['description']); ?>'
                     )">
                    <h2><?= htmlspecialchars($job['title']); ?></h2>
                    <p><strong><?= htmlspecialchars($job['company']); ?></strong></p>
                    <p><?= htmlspecialchars($job['location']); ?></p>
                    <p><strong>Početna plaća:</strong> <?= htmlspecialchars($job['salary']); ?> EUR</p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal za prikaz detalja -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeDetails()">&times;</span>
            <h2 id="modalTitle"></h2>
            <p><strong>Kompanija:</strong> <span id="modalCompany"></span></p>
            <p><strong>Lokacija:</strong> <span id="modalLocation"></span></p>
            <p><strong>E-mail:</strong> <span id="modalEmail"></span></p>
            <p><strong>Početna plaća:</strong> <span id="modalSalary"></span></p>
            <p><strong>Opis posla:</strong></p>
            <p id="modalDescription"></p>
        </div>
    </div>
</body>
</html>
