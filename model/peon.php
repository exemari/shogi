<?php
// Unica pieza funcional
class Peon extends Pieza{
     /* Verifica si es un movimiento permitido */
     function validar_movimiento($posX,$posY){

        try{// Validamos que no de error en calculo

            if ($posX>9 || $posY>9 || ($posX == $this->posX && $posY == $this->posY)) // seria fuera del tablero
                return false;
            if (!$this->promocionada){ // Si no esta promocionado, solo se mueve hacia adelante
                
                if($posX != $this->posX){ // no puede mover a otra columna
                    return false;
                }else if ($this->Jugador->nombre== "jugador1" && $posY != ($this->posY+1)){
                    return false;
                }else if ($this->Jugador->nombre == "jugador2" && $posY != ($this->posY-1)){
                    return false;
                }
            }else{ // Si esta promocionado, puede hacer otros movimientos, como el General de Oro
                $pos_actual = (($this->posY-1) * 9) + $this->posX;
                $permitido[]= $pos_actual - 9;
                $permitido[]= $pos_actual + 9;
                if ($this->Jugador->nombre == "jugador1"){
                    
                    if ($this->posX<9){ // que no este fuera del recuadro
                        $permitido[]= $pos_actual + 10;
                        $permitido[]= $pos_actual + 1;
                    }
                    if ($this->posX>1){
                        $permitido[]= $pos_actual + 8;
                        $permitido[]= $pos_actual - 1;
                    }
                }else{
                
                    if ($this->posX>1){ // que no este fuera del recuadro
                        $permitido[]= $pos_actual - 10;
                        $permitido[]= $pos_actual - 1;
                    }
                    if ($this->posX<9){
                        $permitido[]= $pos_actual - 8; 
                        $permitido[]= $pos_actual + 1;
                    }
                }
                $pos_deseada = (($posY-1)*9) + $posX;
                $existe = array_search($pos_deseada, $permitido);
                if ($existe===false){ // no puede mover aqui
                    return false;
                }
            }
            return true;
        }catch (exception $e) {
            //Solo devolvemos que el movimiento no esta permitido
            return false;

        }
    }
    

}
?>