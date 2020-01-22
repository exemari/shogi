<?
// Clase Principal de la cual heredan todas las piezas.
abstract class Pieza{
    var $nombre;
    var $descripcion;
    var $promocion;
    var $Jugador;
    var $posX;
    var $posY;
    var $tomada;
    var $promocionada;
    var $esrey;

    /* Constructor */
    function __construct($nombre,$jugador,$posx,$posy,$esrey=false){
        $this->nombre = $nombre;
        $this->Jugador = $jugador;
        $this->posX = $posx;
        $this->posY = $posy;
        $this->esrey = $esrey;

    }
    /* Busca la pieza en la posicion */
    function validar_posicion($x,$y){
     
        if ($this->posX == $x && $this->posY == $y && !$this->tomada){
            return true;
        }else{
            return false;
        }

    }
    /* Traspasa pieza al rival y la quita del tablero */
    function tomar_pieza($jugador){
        $this->Jugador = $jugador;
        $this->tomada = true;
        $this->promocionada = false;
    }
    /* Verifica si esta en una posicion en la que puede promocionar */
    function puede_promocionar(){
        if ($this->Jugador->nombre== "jugador1" && $this->posY >=7){
            $this->promocionada = true;
            return true;
        }elseif ($this->Jugador->nombre== "jugador2" && $this->posY <=3){
            $this->promocionada = true;
            return true;
        }
        return false;
    }
    /* Mueve la pieza */
    function mover($posX,$posY){
        $this->posX = $posX;
        $this->posY = $posY;

    }
    /* Verifica si es un movimiento permitido */
    abstract function validar_movimiento($x,$y);
    
    


}
?>