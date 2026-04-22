<?php

class AutoresView
{
    /*public function mostrarHeader(){
        require_once "./app/views/templates/header.phtml";
    }*/
    public function mostrarAutores($autores)
    {
        require_once "./app/views/templates/header.phtml";
        require_once "./app/views/templates/autores.phtml";
    }
    public function mostrarAutorPorId($autores)
    {
        require_once "./app/views/templates/header.phtml";
        require_once "./app/views/templates/autor.phtml";
    }
}