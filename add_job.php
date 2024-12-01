<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $company = $_POST['company'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $salary = $_POST['salary'];

    $stmt = $pdo->prepare("INSERT INTO jobs (title, description, company, location, email, salary) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $description, $company, $location, $email, $salary]);

    $success = "Oglas za posao je uspješno dodan!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj posao</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'includes/nav.php'; ?>
    <div class="container">
        <h1>Dodajte oglas za posao</h1>
        <?php if (isset($success)): ?>
            <p class="success"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form method="POST" action="add_job.php">
            <input type="text" name="title" placeholder="Naslov posla" required>
            <input type="text" name="company" placeholder="Ime kompanije" required>
            <input type="text" name="location" placeholder="Lokacija" required>
            <input type="email" name="email" placeholder="E-mail kompanije" required>
            <input type="number" step="0.01" name="salary" placeholder="Početna plaća (u EUR)" required>
            <textarea name="description" placeholder="Opis posla" rows="5" required></textarea>
            <button type="submit">Dodaj posao</button>
        </form>
    </div>
</body>
</html>
