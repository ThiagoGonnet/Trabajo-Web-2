<?php

class LibrosModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_libreria;charset=utf8', 'root', '');
  }

  //------------------------Libros---------------------------

  public function obtenerLibros()
  {
    $query = $this->db->prepare('SELECT * FROM libros');
    $query->execute();
    $libros = $query->fetchAll(PDO::FETCH_OBJ);
    return $libros;
  }
  public function obtenerLibroPorId($id)
  {
    $query = $this->db->prepare('SELECT * FROM libros WHERE id_libro = ?');
    $query->execute([$id]);
    $libro = $query->fetch(PDO::FETCH_OBJ);
    return $libro;
  }
  public function agregarLibro($titulo, $sinopsis, $anio_de_publicacion, $disponible, $tapa_libro, $id_autor)
  {
    $query = $this->db->prepare("INSERT INTO libros('titulo', 'sinopsis', 'anio_de_publicacion', 'disponible', 'tapa_libro', 'id_autor') values(?,?,?,?,?,?)");
    $query->execute([$titulo, $sinopsis, $anio_de_publicacion, $disponible, $tapa_libro, $id_autor]);
    return $this->db->lastInsertId();
  }

  public function eliminarLibro($id_libro)
  {
    $query = $this->db->prepare('DELETE FROM libros WHERE id_libro = ?');
    $query->execute([$id_libro]);
    return $query->rowCount();
  }

  public function actualizarLibro($titulo, $sinopsis, $anio_de_publicacion, $disponible, $tapa_libro, $id_autor)
  {
    $query = $this->db->prepare("UPDATE libros SET 'titulo' = ?, 'sinopsis' = ?, 'anio_de_publicacion' = ?, 'disponible' = ?, 'tapa_libro' = ?, 'id_autor' = ?) values(?,?,?,?,?,?)");
    $query->execute([$titulo, $sinopsis, $anio_de_publicacion, $disponible, $tapa_libro, $id_autor]);
    return $query->rowCount();
  }

  //-----------------------------Autores----------------------------------

  public function obtenerAutores(){
    $query = $this->db->prepare('SELECT * FROM autores');
    $query->execute();
    $autores = $query->fetchAll(PDO::FETCH_OBJ);
    return $autores;
  }
  //public function obtenerAutorPorId($id){}

  public function agregarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia){
    $query = $this->db->prepare("INSERT INTO libros('nombre', 'fechaDeNacimiento', 'nacionalidad', 'biografia') values(?,?,?,?)");
    $query->execute([$nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $this->db->lastInsertId();
  }

  public function eliminarAutor($id_autor){
    $query = $this->db->prepare('DELETE FROM autores WHERE id_autor = ?');
    $query->execute([$id_autor]);
    return $query->rowCount();
  }

  public function actualizarAutor($nombre, $fechaDeNacimiento, $nacionalidad, $biografia){
    $query = $this->db->prepare("UPDATE autores SET 'nombre' = ?, 'fechaDeNacimiento' = ?, 'nacionalidad' = ?, 'biografia' = ?) values(?,?,?,?)");
    $query->execute([$nombre, $fechaDeNacimiento, $nacionalidad, $biografia]);
    return $query->rowCount();
  }
}
