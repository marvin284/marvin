<?php
session_start();

// Verificar que el usuario esté autenticado y que sea un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Configuración de la base de datos
$host = 'localhost';
$db = 'Duno01';
$user = 'root';
$pass = '123456';

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar todos los usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <style>
        /* Tus estilos aquí */
    </style>
</head>
<body>
    <div class="head">
        <h1>Panel de Administración</h1>
        <a href="logout.php">Cerrar Sesión</a>
    </div>
 <div class="content">
        <h2>Lista de Usuarios</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while($user = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td>
                            <a href="edit_user.php?id=<?php echo $user['id']; ?>">Editar</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" onclick=>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
<?php
session_start();

// Verificar que el usuario esté autenticado y que sea un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

// Aquí puedes agregar tu código para mostrar la lista de usuarios o cualquier otro contenid>
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
</head>
<body>
    <h1>Panel de Administración</h1>

    <div>
        <!-- Enlace para crear un nuevo usuario -->
        <a href="create_user.php">Crear Nuevo Usuario</a>
    </div>

    <div>
        <!-- Aquí podrías incluir la lista de usuarios existentes o cualquier otra funcional>
        <h2>Lista de Usuarios</h2>
        <!-- Código para mostrar la lista de usuarios -->
    </div>

    <a href="index.php">Volver a la Página Principal</a>
</body>
</html>

<?php
$conn->close(); // Cierra la conexión a la base de datos
?>
