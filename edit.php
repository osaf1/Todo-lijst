<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: index.php');
    exit;
}

// Stap 1: Haal bestaande taak op
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) {
    echo "Taak niet gevonden.";
    exit;
}

// Stap 2: Verwerk het formulier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    updateTask($pdo, $id, $description, $due_date);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Taak bewerken</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>✏️ Taak aanpassen</h1>

    <form method="POST">
        <input type="text" name="description" value="<?= htmlspecialchars($task['description']) ?>" required>
        <input type="datetime-local" name="due_date" value="<?= date('Y-m-d\TH:i', strtotime($task['due_date'])) ?>" required>
        <button type="submit">💾 Opslaan</button>
    </form>

    <p><a href="index.php">⬅️ Terug naar overzicht</a></p>
</body>
</html>
