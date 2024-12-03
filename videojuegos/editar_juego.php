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

// Obtener los detalles del juego
$query = $pdo->prepare("SELECT * FROM juegos WHERE id = ? AND usuario_id = ?");
$query->execute([$id_juego, $_SESSION['usuario_id']]);
$juego = $query->fetch(PDO::FETCH_ASSOC);

if (!$juego) {
    // Si no se encuentra el juego o no pertenece al usuario, redirigir al índice
    header('Location: index.php');
    exit;
}

// Si se envía el formulario, actualizar el videojuego
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $genero = $_POST['genero'];
    $ano_lanzamiento = $_POST['ano_lanzamiento'];
    $descripcion = $_POST['descripcion'];

    // Actualizar el juego
    $query = $pdo->prepare("UPDATE juegos SET nombre = ?, genero = ?, ano_lanzamiento = ?, descripcion = ? WHERE id = ? AND usuario_id = ?");
    $query->execute([$nombre, $genero, $ano_lanzamiento, $descripcion, $id_juego, $_SESSION['usuario_id']]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Videojuego</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Editar Videojuego</h1>
        <form action="editar_juego.php?id=<?php echo $juego['id']; ?>" method="POST">
            <input type="text" name="nombre" placeholder="Nombre del juego" value="<?php echo $juego['nombre']; ?>" required>
            <input type="text" name="genero" placeholder="Género" value="<?php echo $juego['genero']; ?>" required>
            <input type="number" name="ano_lanzamiento" placeholder="Año de lanzamiento" value="<?php echo $juego['ano_lanzamiento']; ?>" required>
            <textarea name="descripcion" placeholder="Descripción del juego" required><?php echo $juego['descripcion']; ?></textarea>
            <button type="submit">Actualizar Juego</button>
        </form>
        <a href="index.php" class="button">Cancelar</a>
    </div>
</body>
</html>