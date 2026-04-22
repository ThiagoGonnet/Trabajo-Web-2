<?php

class LibrosView
{
  public function mostrarInicioLibros($libros, $autores)
  {
    require_once "./app/views/templates/header.phtml";
    require_once "./app/views/templates/form-subir-libro.phtml";
    require_once "./app/views/templates/form-eliminar-libro.phtml";
    require_once "./app/views/templates/form-actualizar-libro.phtml";
  }
  public function mostrarLibros($libros)
  {
    require_once "./app/views/templates/header.phtml";
    require_once "./app/views/templates/libros.phtml";
  }
  public function mostrarLibroPorId($libros)
  {
    require_once "./app/views/templates/header.phtml";
    require_once "./app/views/templates/libro.phtml";
  }
}
