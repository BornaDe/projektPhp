<?php
session_start();
require 'includes/db.php';

// Provjeri je li admin prijavljen
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    echo "<script>alert('Novi admin uspješno dodan!'); window.close();</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Admina</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Dodaj Novog Admina</h2>
        <form method="POST" action="add_admin.php">
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" placeholder="Korisničko ime" required>
            <label for="password">Lozinka:</label>
            <input type="password" name="password" placeholder="Lozinka" required>
            <button type="submit">Dodaj Admina</button>
        </form>
    </div>
</body>
</html>
