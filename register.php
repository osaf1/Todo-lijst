<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$username, $password]);

    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>To-Do Lijst</title>
    <link rel="stylesheet" href="style01.css">
</head>
<body>
<h2>Registreren</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br>
    <button type="submit">Registreren</button>
</form>
</body>
</html>
