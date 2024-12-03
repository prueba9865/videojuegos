<?php
$host = 'localhost';
$dbname = 'videojuegos';
$username = 'admin'; // Cambia por tu usuario de MySQL
$password = 'admin'; // Cambia por tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Conexión fallida: " . $e->getMessage());
}
?>