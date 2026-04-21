<?php

// tag base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// require once controllers
require_once "./app/controllers/LibrosController.php";
/*require_once "./app/controllers/AutoresController.php"; */

$action = "libros";

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}
$params = explode('/', $action);

switch ($params[0]) {
  case 'libros':
    $controller = new LibrosController();
    $controller->mostrarLibros();
    break;
  case 'verLibro':
    $controller = new LibrosController();
    $id = $params[1];
    $controller->mostrarLibroPorId($id);
    break;
  case 'agregarLibro':
    $controller = new LibrosController();
    $controller->agregarLibro();
    break;
  case 'eliminarLibro':
    $controller = new LibrosController();
    $controller->eliminarLibro();
    break;
  case 'actualizarLibro':
    $controller = new LibrosController();
    $controller->actualizarLibro();
    break;
  default: echo "Error 404 not found";
}
