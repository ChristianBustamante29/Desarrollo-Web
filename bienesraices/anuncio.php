<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casas en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la Propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae expedita unde magnam reiciendis iste, velit modi nam 
            debitis adipisci dolores nostrum ipsa, dignissimos et, consequuntur labore? Non sit reprehenderit et Lorem ipsum dolor sit,
            amet consectetur adipisicing elit. Porro sunt, itaque laborum culpa quaerat fugit blanditiis, tenetur sint numquam optio cum 
            magni possimus. Deserunt, fugit vero! Aliquid labore suscipit nam? Lorem ipsum dolor sit amet consectetur adipisicing elit. 
            Libero natus consectetur facilis, deserunt voluptate odio dolore.</p>
            <p>Facere cupiditate iure maxime dignissimos ea laudantium ipsum quis perspiciatis fuga repellat ipsa corrupti? Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatibus sunt, quos minima molestiae possimus magnam error voluptates. Dolore sapiente optio vel molestiae 
            dignissimos ut nobis consequatur! Eligendi, minus. Nihil, labore! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
    </main>

<?php
    incluirTemplate('footer');
?>