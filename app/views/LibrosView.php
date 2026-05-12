<?php

class LibrosView
{
  public function mostrarHome(){
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/home.phtml";
  }
  /*public function mostrarInicioLibros($libros)
  {
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/home-admin.phtml";
    require_once "./app/views/templates/form-subir-libro.phtml";
    require_once "./app/views/templates/form-eliminar-libro.phtml";
    require_once "./app/views/templates/form-actualizar-libro.phtml";
  }*/
  public function mostrarLibros($libros)
  {
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/libros.phtml";
  }
  public function mostrarLibroPorId($libros)
  {
    require_once "./app/views/templates/layouts/header.phtml";
    require_once "./app/views/templates/libro.phtml";
  }
}
