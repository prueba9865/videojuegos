<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $ano_lanzamiento = $_POST['ano_lanzamiento'];
    $descripcion = $_POST['descripcion'];
    $usuario_id = $_SESSION['usuario_id'];

    $query = $pdo->prepare("INSERT INTO juegos (nombre, genero, ano_lanzamiento, descripcion, usuario_id) VALUES (?, ?, ?, ?, ?)");
    $query->execute([$nombre, $genero, $ano_lanzamiento, $descripcion, $usuario_id]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Videojuego</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Videojuego</h1>
        <form action="agregar_juego.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre del juego" required>
            <input type="text" name="genero" placeholder="Género" required>
            <input type="number" name="ano_lanzamiento" placeholder="Año de lanzamiento" required>
            <textarea name="descripcion" placeholder="Descripción del juego" required></textarea>
            <button type="submit">Agregar Juego</button>
        </form>
    </div>
</body>
</html>