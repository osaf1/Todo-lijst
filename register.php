<?php
require 'db.php';

$error = ''; // Variabele voor foutmelding

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Controleer of gebruikersnaam al bestaat
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $existingUser = $stmt->fetch();

    if ($existingUser) {
        $error = '❗ Deze gebruikersnaam bestaat al.';
    } else {
        // Gebruikersnaam is nieuw → toevoegen
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$username, $password]);

        header('Location: login.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registreren - To-Do Lijst</title>
    <link rel="stylesheet" href="style01.css">
</head>
<body>
<h2>Registreren</h2>

<!-- Laat foutmelding zien als die er is -->
<?php if (!empty($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>



  <div class="container">
    <h2>Registreren</h2>
    <form method="POST">
      <input type="text" name="username" placeholder="Gebruikersnaam" required><br>
      <input type="password" name="password" placeholder="Wachtwoord" required><br>
      <button type="submit">Registreren</button>
    </form>

    <!-- Link onder het formulier, binnen de container -->
    <p><a href="login.php">Al een account? Inloggen</a></p>
  </div>
</body>
