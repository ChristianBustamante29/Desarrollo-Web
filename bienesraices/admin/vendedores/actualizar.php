<?php
require '../../includes/app.php';
use App\Vendedor;
estaAutenticado();

// Validar id valido
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {
    header('Location: /admin');
}

// Obtener el arreglo del vendedor
$vendedor = Vendedor::find($id);

// Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // aSIGNAR LOS VALORES
    $args = $_POST['vendedor'];

    // Sincronizar obketo en memoria con lo que se escribio
    $vendedor->sincronizar($args);

    // Validacion
    $errores = $vendedor->validar();

    if(empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>

<main class="contenedor">
        <h1>Actualizar Vendedor</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Guardar Cambios" class="boton boton-verde">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>