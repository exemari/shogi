<?php
//Clase encargada de crear todas las piezas.
class Factory_pieza{

    public function get_pieza($tipo,$nombre,$jugador,$posx,$posy){
        switch($tipo){
            case "Peon":
                return new Peon($nombre,$jugador,$posx,$posy);
                break;
            case "Rey":
                return new Rey($nombre,$jugador,$posx,$posy,true);
                break;
            case "General_Oro":
                return new General_Oro($nombre,$jugador,$posx,$posy);
                break;    
            case "General_Plata":
                return new General_Plata($nombre,$jugador,$posx,$posy);
                break;
            case "Lancero":
                return new Lancero($nombre,$jugador,$posx,$posy);
                break;
            case "Caballo":
                return new Caballo($nombre,$jugador,$posx,$posy);
                break;
            case "Alfil":
                return new Alfil($nombre,$jugador,$posx,$posy);
                break;   
            case "Torre":
                return new Torre($nombre,$jugador,$posx,$posy);
                break; 
        }
    }
}
?>