<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Verificar si se ha pasado un ID en la URL
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id_juego = $_GET['id'];

// Verificar si el videojuego pertenece al usuario logueado
$query = $pdo->prepare("SELECT * FROM juegos WHERE id = ? AND usuario_id = ?");
$query->execute([$id_juego, $_SESSION['usuario_id']]);
$juego = $query->fetch(PDO::FETCH_ASSOC);

if (!$juego) {
    // Si no se encuentra el juego o no pertenece al usuario, redirigir al índice
    header('Location: index.php');
    exit;
}

// Eliminar el videojuego
$query = $pdo->prepare("DELETE FROM juegos WHERE id = ? AND usuario_id = ?");
$query->execute([$id_juego, $_SESSION['usuario_id']]);

header('Location: index.php');
exit;
?>