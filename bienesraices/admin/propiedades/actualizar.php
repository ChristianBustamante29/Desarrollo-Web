<?php

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager;


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

    // Consulta para obtener todos los vendedores
    $vendedores = vendedor::all();

    // Arreglo con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el codigo despues de que el usauiro envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);

        // Asignar files a una variable
        $imagen = $_FILES['imagen'];

        // Validacion subida de archivos
        $errores = $propiedad->validar();

        // Subida de archivos
        $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $manager = new ImageManager(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }



        if (empty($errores)) {
            if($_FILES['propiedad']['tmp_name']['imagen']){
                // Almacenar la imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }
            
            $propiedad->guardar();
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