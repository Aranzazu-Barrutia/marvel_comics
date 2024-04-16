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
    // Si hay un error de conexión, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Error de conexión a la base de datos.'));
    exit; // Salir del script para evitar cualquier otra salida
}

// Verificar si se recibió el tipo de recurso
if (isset($_GET['resource_type'])) {
    // Obtener el tipo de recurso desde la URL
    $resource_type = $_GET['resource_type'];

    // Calcular el timestamp y el hash MD5
    $ts = time();
    $public_key = '65d925b1746ea75fc71f7a076fd3bb43';
    $private_key = '0967a8e1d5934246a4fc561261ea5d5bd4a1a0c5';
    $hash = calcularHashMD5($ts, $private_key, $public_key);

    // URL base de la API de Marvel
    $base_url = 'https://gateway.marvel.com/v1/public';

    // Construir la URL de solicitud con el tipo de recurso y los parámetros de autenticación
    $url = "{$base_url}/{$resource_type}?ts={$ts}&apikey={$public_key}&hash={$hash}";

    // Realizar la solicitud a la API de Marvel
    $response = file_get_contents($url);

    // Devolver los datos como JSON
    header('Content-Type: application/json');
    echo $response;
} else {
    // No se recibió el tipo de recurso, devolver un mensaje de error en formato JSON
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Tipo de recurso no especificado.'));
}

// Función para calcular el hash MD5
function calcularHashMD5($ts, $privateKey, $publicKey) {
    $stringToHash = $ts . $privateKey . $publicKey;
    return md5($stringToHash);
}
?>