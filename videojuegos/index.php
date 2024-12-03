<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Obtener los videojuegos del usuario logueado
$query = $pdo->prepare("SELECT * FROM juegos WHERE usuario_id = ?");
$query->execute([$_SESSION['usuario_id']]);
$juegos = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Videojuegos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $_SESSION['nombre_usuario']; ?>!</h1>
        <a href="agregar_juego.php" class="button">Agregar Juego</a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Año</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($juegos as $juego): ?>
                    <tr>
                        <td><?php echo $juego['nombre']; ?></td>
                        <td><?php echo $juego['genero']; ?></td>
                        <td><?php echo $juego['ano_lanzamiento']; ?></td>
                        <td><?php echo $juego['descripcion']; ?></td>
                        <td>
                            <a href="editar_juego.php?id=<?php echo $juego['id']; ?>">Editar</a>
                            <a href="eliminar_juego.php?id=<?php echo $juego['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="logout.php" class="button">Cerrar sesión</a>
    </div>
</body>
</html>