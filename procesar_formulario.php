<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root"; // Usuario por defecto de XAMPP
$password = ""; // Contraseña por defecto de XAMPP
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = $_POST['edad'];

// Validar que los campos no estén vacíos
if(empty($nombre) || empty($email) || empty($edad)) {
    die("Todos los campos son obligatorios.");
}

// Validar el formato del email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Email no válido.");
}

// Validar que la edad sea un número positivo
if(!is_numeric($edad) || $edad <= 0) {
    die("La edad debe ser un número positivo.");
}

// Insertar datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('$nombre', '$email', $edad)";
if ($conn->query($sql) === TRUE) {
    echo "Registro exitoso.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
