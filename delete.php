<?php
require 'db.php';
require 'functions.php';

$id = $_GET['id'] ?? null;

if ($id) {
    deleteTask($pdo, $id);
}

header('Location: index.php');
exit;
