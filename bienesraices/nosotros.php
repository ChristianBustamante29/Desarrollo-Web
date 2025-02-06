<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Conoce Sobre Nosotros</h1>
        <div class="nosotros-section">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Imagen Nosotros">
                </picture>
            </div>

            <div class="texto">
                <blockquote>
                    25 Años de Experiencia
                </blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae expedita unde magnam reiciendis iste, velit modi nam 
                debitis adipisci dolores nostrum ipsa, dignissimos et, consequuntur labore? Non sit reprehenderit et Lorem ipsum dolor sit,
                amet consectetur adipisicing elit. Porro sunt, itaque laborum culpa quaerat fugit blanditiis, tenetur sint numquam optio cum 
                magni possimus. Deserunt, fugit vero! Aliquid labore suscipit nam? Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Libero natus consectetur facilis, deserunt voluptate odio dolore.</p>
                <p>Facere cupiditate iure maxime dignissimos ea laudantium ipsum quis perspiciatis fuga repellat ipsa corrupti? Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatibus sunt, quos minima molestiae possimus magnam error voluptates. Dolore sapiente optio vel molestiae 
                dignissimos ut nobis consequatur! Eligendi, minus. Nihil, labore! Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        <div/>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo ipsa dolorem modi laboriosam animi a facilis
                incidunt nam illum. Quisquam unde sed modi, cumque accusantium eius nam vitae ex voluptates! Lorem, ipsum dolor sit 
                amet consectetur adipisicing elit. Et tempore commodi maiores ab saepe ipsum quos. Sed mollitia sapiente aliquid culpa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo ipsa dolorem modi laboriosam animi a facilis
                incidunt nam illum. Quisquam unde sed modi, cumque accusantium eius nam vitae ex voluptates! Lorem, ipsum dolor sit 
                amet consectetur adipisicing elit. Et tempore commodi maiores ab saepe ipsum quos. Sed mollitia sapiente aliquid culpa.</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo ipsa dolorem modi laboriosam animi a facilis
                incidunt nam illum. Quisquam unde sed modi, cumque accusantium eius nam vitae ex voluptates! Lorem, ipsum dolor sit 
                amet consectetur adipisicing elit. Et tempore commodi maiores ab saepe ipsum quos. Sed mollitia sapiente aliquid culpa.</p>
            </div>
        </div>
    </section>

<?php
    incluirTemplate('footer');
?>