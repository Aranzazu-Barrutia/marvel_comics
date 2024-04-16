<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "series";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Iniciar sesión
session_start();

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE username = ?";

    // Preparar la declaración SQL y vincular parámetros
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);

        // Ejecutar la declaración SQL
        $stmt->execute();

        // Obtener el resultado de la consulta
        $result = $stmt->get_result();

        // Verificar si se encontró un usuario con el nombre de usuario proporcionado
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña proporcionada con la contraseña almacenada
            if (password_verify($password, $row['password'])) {
                // Iniciar sesión y almacenar el nombre de usuario en la variable de sesión
                $_SESSION['username'] = $username;
                // Redirigir al usuario a la página principal
                header("Location: principal.php");
                exit();
            } else {
                echo "Contraseña incorrecta<br>";
            }
        } else {
            echo "Usuario no encontrado<br>";
        }

        // Cerrar declaración
        $stmt->close();
    } else {
        echo "Error al preparar la declaración SQL: " . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>