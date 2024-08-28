<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db_connection = $_POST['db_connection'];
    $db_host = $_POST['db_host'];
    $db_database = $_POST['db_database'];
    $db_username = $_POST['db_username'];
    $db_password = $_POST['db_password'];

    // Suprimir advertencias de mysqli
    mysqli_report(MYSQLI_REPORT_OFF);

    try {
        // Usar @ para suprimir cualquier advertencia de mysqli::__construct
        $conexion = @new mysqli($db_host, $db_username, $db_password, $db_database);

        if ($conexion->connect_error) {
            // Mostrar un mensaje genérico sin detalles específicos
            throw new Exception("No se pudo conectar a la base de datos. Verifique los datos ingresados.");
        } else {
            echo "<div style='color: green; font-size: 18px; font-weight: bold;'>Conexión exitosa</div><br>";
        }
    } catch (Exception $e) {
        // Mostrar un mensaje de error pequeño y genérico
        echo "<div style='color: red; font-size: 18px; font-weight: bold;'>Error de Conexión:</div>";
        echo "<div style='color: red; font-size: 16px;'>" . htmlspecialchars($e->getMessage()) . "</div>";
    }

    // Verificar si la conexión es válida antes de intentar cerrarla
    if (isset($conexion) && $conexion instanceof mysqli && $conexion->connect_errno === 0) {
        $conexion->close();
    }
} else {
    // Mostrar formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de la Base de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .message {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Configurar Conexión a la Base de Datos</h1>
        <form action="" method="POST">
            <label for="db_connection">Tipo de Conexión:</label>
            <input type="text" id="db_connection" name="db_connection" required><br><br>

            <label for="db_host">Host:</label>
            <input type="text" id="db_host" name="db_host" required><br><br>

            <label for="db_database">Base de Datos:</label>
            <input type="text" id="db_database" name="db_database" required><br><br>

            <label for="db_username">Usuario:</label>
            <input type="text" id="db_username" name="db_username" required><br><br>

            <label for="db_password">Contraseña:</label>
            <input type="password" id="db_password" name="db_password"><br><br> <!-- Contraseña no requerida -->

            <input type="submit" value="Conectar">
        </form>
    </div>
</body>
</html>
<?php
}
?>
