<?php
// Importar base de datos
$db = conectarDB();

// Consultar
$query = "SELECT * FROM propiedades LIMIT ${limite}";

// Obtener resultado
$resultado = mysqli_query($db, $query);


?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" height="280rem">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>
            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio">$ <?php echo $propiedad['precio']; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
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

            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div> <!--.contenido-anuncio-->
    </div><!--anuncio-->
    <?php endwhile; ?>

</div><!--Contenedor-anuncios-->

<?php
// Cerrar la conexion
    mysqli_close($db);
?>