<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router){

        $errores = Vendedor::getErrores();

        $vendedor = new Vendedor;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Crear una nueva isntancia
            $vendedor = new Vendedor($_POST['vendedor']);
        
            // validar campos vacios
            $errores = $vendedor->validar();
        
            // No hay errores
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function actualizar(Router $router){

        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');

        // Obtener datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

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
        
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor
        ]);
    }
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar el id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                // Valida el tipo a eliminar
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}