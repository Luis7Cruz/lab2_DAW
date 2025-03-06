<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Determinar el número total de registros
$sql = "SELECT COUNT(*) AS total FROM usuarios";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_registros = $row['total'];

// Definir el número de registros por página
$registros_por_pagina = 10;
$total_paginas = ceil($total_registros / $registros_por_pagina);

// Determinar la página actual
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$inicio = ($pagina_actual - 1) * $registros_por_pagina;

// Consultar datos para la página actual
$sql = "SELECT id, nombre, email, edad FROM usuarios LIMIT $inicio, $registros_por_pagina";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Usuarios Registrados</h1>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["edad"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Enlaces de paginación
    echo '<div class="pagination-container">';
    for ($i = 1; $i <= $total_paginas; $i++) {
        echo '<a class="pagination-link" href="mostrar_datos.php?pagina=' . $i . '">' . $i . '</a> ';
    }
    echo '</div>';
} else {
    echo "No hay usuarios registrados.";
}

// Cerrar la conexión
$conn->close();
?>
