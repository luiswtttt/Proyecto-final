<?php
// Establecemos los parámetros de conexión a la base de datos
$host = 'localhost'; // Dirección del servidor
$db = 'pdo'; // Nombre de la base de datos
$user = 'root'; // Usuario de la base de datos
$pass = ''; // Contraseña de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');

// Obtener la fecha del inicio de la semana (lunes)
$inicio_semana = date('Y-m-d', strtotime('last monday'));

// Obtener la fecha del inicio del mes
$inicio_mes = date('Y-m-01');

// Verificar si se ha enviado el formulario y qué tipo de reporte se ha seleccionado
if (isset($_POST['tipo'])) {
    $tipo_reporte = $_POST['tipo'];

    // Ejecutar consulta según el tipo de reporte seleccionado
    if ($tipo_reporte == 'semanal') {
        $sql = "SELECT p.producto_id, p.producto_codigo, p.producto_nombre, p.producto_precio, p.producto_stock, c.categoria_nombre, p.producto_fecha
                FROM producto p 
                JOIN categoria c ON p.categoria_id = c.categoria_id
                WHERE p.producto_fecha >= '$inicio_semana' AND p.producto_fecha <= '$fecha_actual'";

        // Ejecutar consulta para reporte semanal
        $result = $conn->query($sql);

        // Mostrar reporte semanal
        if ($result->num_rows > 0) {
            echo "<h1>Reporte Semanal de Productos</h1>";
            echo "<table border='1' class='table'>";
            echo "<tr><th>ID</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Categoría</th><th>Fecha de Registro</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["producto_id"] . "</td>";
                echo "<td>" . $row["producto_codigo"] . "</td>";
                echo "<td>" . $row["producto_nombre"] . "</td>";
                echo "<td>" . $row["producto_precio"] . "</td>";
                echo "<td>" . $row["producto_stock"] . "</td>";
                echo "<td>" . $row["categoria_nombre"] . "</td>";
                echo "<td>" . $row["producto_fecha"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron productos en la última semana.</p>";
        }
    } elseif ($tipo_reporte == 'mensual') {
        $sql = "SELECT p.producto_id, p.producto_codigo, p.producto_nombre, p.producto_precio, p.producto_stock, c.categoria_nombre, p.producto_fecha
                FROM producto p 
                JOIN categoria c ON p.categoria_id = c.categoria_id
                WHERE p.producto_fecha >= '$inicio_mes' AND p.producto_fecha <= '$fecha_actual'";

        // Ejecutar consulta para reporte mensual
        $result = $conn->query($sql);

        // Mostrar reporte mensual
        if ($result->num_rows > 0) {
            echo "<h1>Reporte Mensual de Productos</h1>";
            echo "<table border='1' class='table'>";
            echo "<tr><th>ID</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Categoría</th><th>Fecha de Registro</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["producto_id"] . "</td>";
                echo "<td>" . $row["producto_codigo"] . "</td>";
                echo "<td>" . $row["producto_nombre"] . "</td>";
                echo "<td>" . $row["producto_precio"] . "</td>";
                echo "<td>" . $row["producto_stock"] . "</td>";
                echo "<td>" . $row["categoria_nombre"] . "</td>";
                echo "<td>" . $row["producto_fecha"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron productos en el último mes.</p>";
        }
    } else {
        // Si no se selecciona un tipo específico, mostrar todos los productos
        $sql = "SELECT p.producto_id, p.producto_codigo, p.producto_nombre, p.producto_precio, p.producto_stock, c.categoria_nombre, p.producto_fecha
                FROM producto p 
                JOIN categoria c ON p.categoria_id = c.categoria_id";

        // Ejecutar consulta para mostrar todos los productos
        $result = $conn->query($sql);

        // Mostrar todos los productos
        if ($result->num_rows > 0) {
            echo "<h1>Resumen de Todos los Productos</h1>";
            echo "<table border='1' class='table'>";
            echo "<tr><th>ID</th><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th><th>Categoría</th><th>Fecha de Registro</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["producto_id"] . "</td>";
                echo "<td>" . $row["producto_codigo"] . "</td>";
                echo "<td>" . $row["producto_nombre"] . "</td>";
                echo "<td>" . $row["producto_precio"] . "</td>";
                echo "<td>" . $row["producto_stock"] . "</td>";
                echo "<td>" . $row["categoria_nombre"] . "</td>";
                echo "<td>" . $row["producto_fecha"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron productos.</p>";
        }
    }
}

// Cerrar la conexión
$conn->close();
?>