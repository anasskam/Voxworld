<?php
$db_name = 'mysql:host=localhost;dbname=journal';
$db_username = 'root';
$db_password = 'vox';

try {
    $conn = new PDO($db_name, $db_username, $db_password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}