<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $age = $_POST['age'];

    // Verificar si el usuario ya existe
    $sql_check_user = "SELECT * FROM usuarios WHERE username = ?";
    $stmt_check_user = $conn->prepare($sql_check_user);
    $stmt_check_user->bind_param("s", $username);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if ($result_check_user->num_rows > 0) {
        echo "El nombre de usuario ya está en uso. Por favor, elija otro.";
    } else {
        // Hash de la contraseña (para mayor seguridad)
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar datos en la base de datos
        $sql_insert_user = "INSERT INTO usuarios (username, password, email, phone, age) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_user = $conn->prepare($sql_insert_user);
        $stmt_insert_user->bind_param("sssss", $username, $hashed_password, $email, $phone, $age);

        // Ejecutar la consulta SQL para insertar el usuario si no existe
        if ($stmt_insert_user->execute()) {
            // Redirigir a la página principal después del registro exitoso
            header("Location: principal.php");
            exit();
        } else {
            echo "Error al registrar el usuario: " . $stmt_insert_user->error;
            echo "<br>";
            echo "SQL ejecutada: " . $sql_insert_user;
        }

        // Cerrar declaración
        $stmt_insert_user->close();
    }

    // Cerrar declaración
    $stmt_check_user->close();
}

// Cerrar conexión
$conn->close();
