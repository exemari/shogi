<?php
// Clase jugador con sus atributos
class Jugador{
    var $nombre;
    var $descripcion;


    function __construct($nombre,$descripcion){
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    function get_nombre(){
        return $this->nombre. "( $this->descripcion )";

    }

    function get_descripcion(){
        return $this->descripcion;

    }
    

}
?>