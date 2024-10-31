<?php
session_start();

// Redirigir si no hay sesión activa
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Verifica si el rol existe en la sesión
if (!isset($_SESSION['role'])) {
    die("Error: No se encontró el rol del usuario en la sesión.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoñaSucia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .head {
            background: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        .navbar {
            margin-top: 10px;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }
        .content {
            padding: 20px;
 text-align: center;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="head">
        <h1>Bienvenido a DoñaSucia</h1>
        <div class="navbar">
            <a href="logout.php">Cerrar Sesión</a>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <a href="admin.php">Panel de Administración</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="content">
        <h2>Contenido Principal</h2>
        <!-- Contenido general aquí -->

        <?php if ($_SESSION['role'] == 'admin'): ?>
            <h2>Modo Administrador</h2>
            <form action="admin_actions.php" method="POST">
                <label for="newContent">Contenido a modificar:</label>
                <textarea name="newContent" id="newContent" rows="4" cols="50"></textarea>
                <br>
                <input type="submit" value="Guardar Cambios">
            </form>
        <?php endif; ?>
 </form>
        <?php endif; ?>
    </div>
</body>
</html>
