<?php

class LibrosView{
  public function mostrarLibros($libros){
    require_once "./app/views/templates/libros.phtml";
  }
  public function mostrarLibroPorId($libros){
    require_once "./app/views/templates/libro.phtml";
  }
}
