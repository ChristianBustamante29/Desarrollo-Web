<?php

namespace Model;

class ActiveRecord {
     // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];
    


    // Definir la conexion a la bd
    public static function setDB($database) {
        self::$db = $database;
    }

    

    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear(){

        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();


        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";  
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

            // Mensaje de exito
            if($resultado) {
                // Redireccionar al usuario.
                header('Location: /admin?resultado=1');
            }
    }

    public function actualizar() {
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = " UPDATE " . static::$tabla . " SET ";
        $query .=  join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' " ;
        $query .= " Limit 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar usuario
            header("Location: /admin?resultado=2");
        }   
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " Limit 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3');
        }
    }

    // Identificar y unir los atriburos de la bd
    public function atributos(){
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(){
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach($atributos as $key => $value){
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Validacion
    public static function getErrores(){
        return static::$errores;
    }
    
    public function validar(){
        static::$errores = [];
        return static::$errores;
    }

    public function setImagen($imagen) {
        // Elimina la imagen previa
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }

        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo

    public function borrarImagen(){
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Lista todos los registros
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtiene determinado numero de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca un registro por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query) {
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }


        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static;


        foreach($registro as $key => $value){
            if( property_exists( $objeto, $key ) ){
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $args = [] ){
        foreach($args as $key => $value) {
            if(property_exists($this, $key ) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}