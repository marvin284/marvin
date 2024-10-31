<?php
error_reporting(E_ALL); // Mostrar todos los errores
ini_set('display_errors', 1); // Habilitar la visualización de errores

session_start(); // Iniciar la sesión

// Configuración de la base de datos
$host = 'localhost'; // Cambia si es necesario
$db = 'Duno01'; // Nombre de tu base de datos
$user = 'root'; // Tu usuario de MySQL
$pass = '123456'; // Tu contraseña de MySQL

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar el formulario de inicio de sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta a la base de datos
    $sql = "SELECT * FROM usuarios WHERE username = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifica la contraseña
        if ($password === $user['password']) { // Verifica que la contraseña coincida
            $_SESSION['user_id'] = $user['id']; // Guardar el ID del usuario en la sesión
            $_SESSION['role'] = $user['rol']; // Guardar el rol del usuario en la sesión
            header('Location: index.php'); // Redirigir a la página principal
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

$conn->close(); // Cierra la conexión a la base de datos
?>
