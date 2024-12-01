<?php
session_start();
require 'includes/db.php';

// Provjeri je li admin prijavljen
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

// Obradi uređivanje posla
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $company = $_POST['company'];
        $location = $_POST['location'];
        $email = $_POST['email'];
        $salary = $_POST['salary'];
        $description = $_POST['description'];

        $stmt = $pdo->prepare("UPDATE jobs SET title = ?, company = ?, location = ?, email = ?, salary = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $company, $location, $email, $salary, $description, $id]);
        header("Location: manage_jobs.php"); // Refresh stranice
        exit();
    }

    // Obradi brisanje posla
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $stmt = $pdo->prepare("DELETE FROM jobs WHERE id = ?");
        $stmt->execute([$id]);
        header("Location: manage_jobs.php"); // Refresh stranice
        exit();
    }
}

// Dohvati sve oglase iz baze
$stmt = $pdo->query("SELECT * FROM jobs");
$jobs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upravljanje poslovima</title>
    <link rel="stylesheet" href="css/styles.css">
    <script>
        // Funkcija za otvaranje popup prozora za dodavanje admina
        function openAddAdminWindow() {
            const width = 600;
            const height = 400;
            const left = (window.innerWidth - width) / 2;
            const top = (window.innerHeight - height) / 2;
            window.open('add_admin.php', 'Dodaj Admina', `width=${width},height=${height},top=${top},left=${left}`);
        }
    </script>
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
        <h1>Upravljanje poslovima</h1>
        <button onclick="openAddAdminWindow()" class="add-admin-button">Dodaj Admina</button>
        <?php foreach ($jobs as $job): ?>
            <form method="POST" action="manage_jobs.php" class="job-form">
                <input type="hidden" name="id" value="<?= $job['id']; ?>">
                <label for="title">Naslov:</label>
                <input type="text" name="title" value="<?= htmlspecialchars($job['title']); ?>" required>
                <label for="company">Kompanija:</label>
                <input type="text" name="company" value="<?= htmlspecialchars($job['company']); ?>" required>
                <label for="location">Lokacija:</label>
                <input type="text" name="location" value="<?= htmlspecialchars($job['location']); ?>" required>
                <label for="email">E-mail:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($job['email']); ?>" required>
                <label for="salary">Početna plaća (EUR):</label>
                <input type="number" step="0.01" name="salary" value="<?= htmlspecialchars($job['salary']); ?>" required>
                <label for="description">Opis:</label>
                <textarea name="description" required><?= htmlspecialchars($job['description']); ?></textarea>
                <button type="submit" name="edit">Uredi</button>
                <button type="submit" name="delete">Obriši</button>
            </form>
        <?php endforeach; ?>
    </div>
</body>
</html>
