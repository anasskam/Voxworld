<?php

$db_name = 'mysql:host=localhost;dbname=journal';
$username = 'root';
$password = '';

$conn = new PDO($db_name, $username, $password);
var_dump($conn);
?>