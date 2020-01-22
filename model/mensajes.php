<?php
//Clase que muestra los menssajes
class Mensajes{

    var $texto;
    function __construct($texto){
        $this->texto = $texto;
    }
    function get_mensaje(){
        return $this->texto;
    }
    function set_mensaje($texto){
        $this->texto = $texto;
    }
    /* Obtenemos los mensajes por ID*/
    function obtener_mensaje($id){

        switch($id){
            case 1:
                $this->texto = "Partida iniciada";
            break;
            case 2:
                $this->texto = "Partida reiniciada";
            break;
            case 3:
                $this->texto = "Movimiento completado";
            break;
            case 4:
                $this->texto = "No existe la pieza.";
            break;
            case 5:
                $this->texto = "La pieza no pertenece al jugador.";
            break;
            case 6:
                $this->texto = "El movimiento no esta permitido.";
            break;
            case 7:
                $this->texto = "Hay una pieza propia en esa posición.";
            break;
            case 8:
                $this->texto = "Pieza reingresada";
            break;
            case 9:
                $this->texto = "No existe la pieza o no se puede reingresar.";
            break;
            case 10:
                $this->texto = "Hay una pieza en esa posición.";
            break;
            case 11:
                $this->texto = "Pieza promocionada";
            break;
            case 12:
                $this->texto = "No existe la pieza o ya se encuentra promocionada.";
            break;
            case 13:
                $this->texto = "La pieza no puede ser promocionada.";
            break;
            

        }
    }

}
?>