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
[9:55 a.m., 31/10/2024] Raul Muñoz: index.html
[9:56 a.m., 31/10/2024] Raul Muñoz: <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoñaSucia</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
        }

        .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 63px;
            background: #171717;
            position: fixed;
            width: 100%;
            z-index: 100;
        }

        .logo a {
            text-decoration: none;
            color: #fff;
            font-size: 24px;
            padding: 10px;
        }

        .navbar {
            display: flex;
            margin-right: 10px;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .navbar a:hover {
            background: #9c27b0;
        }

        .header {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 60vh;
            background: #101010;
            color: #fff;
        }

        .content {
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 80px auto; /* Ajustar el margen superior para no cubrir el encabezado */
            width: 300px;
        }

        .login-container, .register-container {
            margin: 20px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #9c27b0;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #7a1e78;
        }
    </style>
</head>
<body>
    <div class="head">
        <div class="logo"><a href="#">DoñaSucia</a></div>
        <div class="navbar">
            <a href="#">Inicio</a>
            <a href="#">Contacto</a>
        </div>
    </div>

    <div class="header">
        <h1 class="title">Bienvenido a DoñaSucia</h1>
    </div>

    <div class="content">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form method="POST" action="login.php">
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a href="#register" onclick="showRegisterForm()">Regístrate aquí</a></p>
        </div>

        <div id="register-form" class="register-container" style="display: none;">
            <h2>Registro de Usuario</h2>
            <form method="POST" action="register.php">
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <input type="password" name="password" placeholder="Contraseña" required>
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>

    <script>
        // Muestra el formulario de registro
        function showRegisterForm() {
            document.getElementById('register-form').style.display = 'block';
        }
    </script>
</body>
</html>
