<?php
require 'db.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    // Optioneel: validatie toevoegen

    addTask($pdo, $description, $due_date);
}

header('Location: index.php');
exit;
