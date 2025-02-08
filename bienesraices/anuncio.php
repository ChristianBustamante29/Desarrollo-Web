<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
}

require 'includes/app.php';

$db = conectarDB();

// Consultar
$query = "SELECT * FROM propiedades WHERE id = ${id}";

// Obtener resultado
$resultado = mysqli_query($db, $query);
$propiedad = mysqli_fetch_assoc($resultado);

?>


<?php

    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>">

        <div class="resumen-propiedad">
            <p class="precio">$ <?php echo $propiedad['precio']; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_WC.svg" alt="icono WC">
                    <p><?php echo $propiedad['WC']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

<?php
    // Cerrar la base de datos
    mysqli_close($db);

    incluirTemplate('footer');
?>