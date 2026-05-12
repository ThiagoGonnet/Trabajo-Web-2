<?php
// require once controllers
require_once "./app/controllers/UsuariosController.php";
require_once "./app/controllers/LibrosController.php";
require_once "./app/controllers/AutoresController.php";
require_once "./app/controllers/AuthController.php";
require_once "./app/controllers/DeployController.php";

session_start();

// tag base
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


$action = "home";

if (!empty($_GET['action'])) {
  $action = $_GET['action'];
}
$params = explode('/', $action);

switch ($params[0]) {
  case 'home':
    $controller = new LibrosController();
    $controller->mostrarHome();
    break;
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
  case 'autores':
    $controller = new AutoresController();
    $controller->obtenerAutores();
    break;
  case 'verAutor':
    $controller = new AutoresController();
    $id = $params[1];
    $controller->mostrarAutorPorId($id);
    break;
  case 'agregarAutor':
    $controller = new AutoresController();
    $controller->agregarAutor();
    break;
  case 'eliminarAutor':
    $controller = new AutoresController();
    $controller->eliminarAutor();
    break;
  case 'actualizarAutor':
    $controller = new AutoresController();
    $controller->actualizarAutor();
    break;
  case 'login':
    $controller = new AuthController();
    $controller->mostrarLogin();
    break;
  case 'logout':
    $controller = new AuthController();
    $controller->cerrarSesion();
    break;
  case 'do_login':
    $controller = new AuthController();
    $controller->iniciarSesion();
    break;
  case 'home-admin':
    $controller = new AuthController();
    $controller->mostrarHomeAdmin();
  /*case 'register':
      $controller = new UsuariosController();
      $controller->mostrarFormRegistro();
      break;*/
  case 'deploy': // on demand
    $controller = new DeployController();
    $controller->deploy();
    break;
  default:
    echo "Error 404 not found";
}
