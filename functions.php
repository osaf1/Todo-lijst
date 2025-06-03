<?php

function getTasks($pdo) {
    $stmt = $pdo->query("SELECT * FROM tasks ORDER BY due_date ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addTask($pdo, $description, $due_date) {
    $stmt = $pdo->prepare("INSERT INTO tasks (description, due_date) VALUES (?, ?)");
    $stmt->execute([$description, $due_date]);
}

function updateTask($pdo, $id, $description, $due_date) {
    $stmt = $pdo->prepare("UPDATE tasks SET description = ?, due_date = ? WHERE id = ?");
    $stmt->execute([$description, $due_date, $id]);
}

function deleteTask($pdo, $id) {
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
}
?>
