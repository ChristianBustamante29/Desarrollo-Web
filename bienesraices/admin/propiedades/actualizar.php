<?php

    use App\Propiedad;

    require '../../includes/app.php';

    estaAutenticado();

    // Validar id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id) {
        header('Location: /admin');
    }


    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);


    //  Consultar para obtener los vendedores
    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];

    // Ejecutar el codigo despues de que el usauiro envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        debuguear($propiedad);

        // Asignar files a una variable
        $imagen = $_FILES['imagen'];

        if (!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if (!$precio) {
            $errores[] = "El precio es obligatorio";
        }

        if (strlen( $descripcion ) < 50 ) {
            $errores[] = "La descripción es obligatoria y debe tener almenos 50 caracteres";
        }

        if (!$habitaciones) {
            $errores[] = "El número de baños es obligatorio";
        }

        if (!$WC) {
            $errores[] = "El número de baños es obligatorio";
        }

        if (!$estacionamiento) {
            $errores[] = "El número de estacionamientos es obligatorio";
        }

        if (!$vendedorId) {
            $errores[] = "Elige un vendedor";
        }

        // Validar por tamaño 1mb maximo
        $medida = 1000 * 1000;
        if($imagen['size'] > $medida) {
            $errores[]= 'La imagen es muy pesada';
        }


        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // Revisar que el arreglo de errores este vacio
        if (empty($errores)) {
            // Crear carpeta
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            $nombreImagen = '';

          // Subida de archivos
            if ($imagen['name']) {
                
                unlink($carpetaImagenes . $propiedad['imagen']);

            // // Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            // // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
            } else {
                $nombreImagen = $propiedad['imagen'];
            }

            

            


             // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo = '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}',
            habitaciones = ${habitaciones}, WC = ${WC}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id} ";

            // echo $query;

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // Redireccionar usuario

                header("Location: /admin?resultado=2");
            }
        }

    }



    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>