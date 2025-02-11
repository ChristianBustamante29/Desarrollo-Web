<?php

require 'funciones.php';
require 'templates/config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectarnos a la base de datos

$db = conectarDB();


use App\ActiveRecord;


ActiveRecord::setDB($db);