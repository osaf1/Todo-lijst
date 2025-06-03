<?php
require 'db.php';
require 'functions.php';

$tasks = getTasks($pdo);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>To-Do Lijst</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📝 Mijn To-Do Lijst</h1>

    <!-- Formulier om een taak toe te voegen -->
    <form method="POST" action="add.php">
        <input type="text" name="description" placeholder="Wat moet je doen?" required><br>
        <input type="datetime-local" name="due_date" required><br>
        <button type="submit">➕ Toevoegen</button><br>
    </form>

    <!-- Lijst met bestaande taken -->
    <ul>
        <?php foreach ($tasks as $task): 
            $isPast = strtotime($task['due_date']) < time();
        ?>
            <li class="<?= $isPast ? 'red' : '' ?>">
                <?= htmlspecialchars($task['description']) ?> - 
                <?= date('d-m-Y H:i', strtotime($task['due_date'])) ?>
                <span>
                    <a href="edit.php?id=<?= $task['id'] ?>">✏️</a>
                    <a href="delete.php?id=<?= $task['id'] ?>" onclick="return confirm('Weet je zeker dat je deze taak wilt verwijderen?')">❌</a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>

</body>
</html>
