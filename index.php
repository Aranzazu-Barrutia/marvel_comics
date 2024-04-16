<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro e Inicio de Sesión</title>
    <link rel="stylesheet" href="main.css"> <!-- Add your CSS file here -->
    <script src="../js/validarFom.js"></script>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Registro de Usuario</h2>
            <form action="registro.php" method="post">
                <label for="reg_username">Usuario:</label><br>
                <input type="text" id="reg_username" name="username" required><br>
                <label for="reg_password">Contraseña:</label><br>
                <input type="password" id="reg_password" name="password" required><br>
                <label for="email">Correo Electrónico:</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="phone">Teléfono:</label><br>
                <input type="tel" id="phone" name="phone" required><br>
                <label for="age">Edad:</label><br>
                <input type="number" id="age" name="age" required><br>
                <input type="submit" value="Registrar">
            </form>

        </div>
        <div class="form-container">
            <h2>Iniciar Sesión</h2>
            <form action="inicio_sesion.php" method="post">
                <label for="login_username">Usuario:</label><br>
                <input type="text" id="login_username" name="username" required><br>
                <label for="login_password">Contraseña:</label><br>
                <input type="password" id="login_password" name="password" required><br>
                <input type="submit" value="Iniciar Sesión">
            </form>
        </div>
    </div>


</body>

</html>