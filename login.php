<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit;
    } else {
        echo "Ongeldige inloggegevens.";
    }
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
<h2>Inloggen</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
    <input type="password" name="password" placeholder="Wachtwoord" required><br>
    <button type="submit">Inloggen</button>
</form>
</body>
</html>

