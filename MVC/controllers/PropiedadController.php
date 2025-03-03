<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PropiedadController {
    public static function index(Router $router){
        $propiedades = Propiedad::all();

        $vendedores = Vendedor::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router){

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $propiedad = new Propiedad($_POST['propiedad']);
    
            // Generar un nombre unico
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
    
            // Setear la imagen
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $manager = new ImageManager(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
    
            $errores = $propiedad->validar();
    
            if(empty($errores)) {
    
                // Subida de archivos
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                //  Guarda la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    
                $propiedad->guardar();

            }
        }
        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router){
        
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);

        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        // Metodo POST para actualizar
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

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}