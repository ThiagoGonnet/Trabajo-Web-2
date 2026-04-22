<?php

class AutoresModel
{
  private $db;

  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;dbname=db_libreria;charset=utf8', 'root', '');
  }
  public function obtenerAutores()
  {
    $query = $this->db->prepare('SELECT * FROM autores');
    $query->execute();
    $autores = $query->fetchAll(PDO::FETCH_OBJ);
    return $autores;
  }
}
