<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Obtener datos del formulario para la edición
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = $_POST['edad'];
// Actualizar datos en la base de datos
$sql = "UPDATE usuarios SET nombre='$nombre', email='$email', edad=$edad WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Registro actualizado exitosamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
