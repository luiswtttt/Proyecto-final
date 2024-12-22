<?php
// Incluir el archivo de conexión
include 'conexion.php';  // Asegúrate de que la ruta sea la correcta

// Llamar a la función conexion para obtener la conexión a la base de datos
$conexion = conexion();  // Esto llama a la función y asigna el resultado a la variable $conexion
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body id="home-page">
    <!-- Contenido principal de la página -->
    <section class="home-content">
        <div class="welcome-message">
            <h1>Bienvenido Administrador Principal!</h1>
        </div>
    </section>

    <!-- Sección informativa dinámica de Inventario -->
    <section class="info-inventory">
        <div class="info-item">
            <h3>Total de Usuarios</h3>
            <p id="user-count">
                <?php
                // Realiza la consulta para obtener el total de usuarios
                $query = $conexion->query("SELECT COUNT(*) FROM usuario");  // Cambié 'usuarios' a 'usuario'
                $totalUsuarios = $query->fetchColumn();
                echo $totalUsuarios;  // Muestra el número de usuarios
                ?>
            </p>
        </div>
        <div class="info-item">
            <h3>Total de Productos</h3>
            <p id="product-count">
                <?php
                // Realiza la consulta para obtener el total de productos
                $query = $conexion->query("SELECT COUNT(*) FROM producto");  // Cambié 'productos' a 'producto'
                $totalProductos = $query->fetchColumn();
                echo $totalProductos;  // Muestra el número de productos
                ?>
            </p>
        </div>
        <div class="info-item">
            <h3>Total de Categorías</h3>
            <p id="category-count">
                <?php
                // Realiza la consulta para obtener el total de categorías
                $query = $conexion->query("SELECT COUNT(*) FROM categoria");  // Cambié 'categorias' a 'categoria'
                $totalCategorias = $query->fetchColumn();
                echo $totalCategorias;  // Muestra el número de categorías
                ?>
            </p>
        </div>
    </section>

    <!-- Aquí podrías agregar un gráfico o más detalles informativos -->
</body>
</html>


