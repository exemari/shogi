<?php
session_start();
require("../../config/constant.php");
require("../../model/pieza.php");
require("../../model/peon.php");
require("../../model/caballo.php");
require("../../model/lancero.php");
require("../../model/torre.php");
require("../../model/general_oro.php");
require("../../model/general_plata.php");
require("../../model/rey.php");
require("../../model/alfil.php");
require("../../model/factory_pieza.php");
require("../../model/jugador.php");
require("../../model/tablero.php");
require("../../model/mensajes.php");
use PHPUnit\Framework\TestCase;

//Probamos ejecutar una partida completa
class TestCompleto extends TestCase
{
    public function testPartida()
    {

        
        $tablero = new Tablero(C_FILAS,C_COLUMNAS);

        $tablero->iniciar_partida("jugador1","jugador2"); 

        // Tratamos mover una pieza a una posicion que no se puede 
    $this->assertSame(3,  $tablero->mover_pieza("P1_1",1,5)); 
        

        $tablero->mover_pieza("P1_1",1,4);
       // echo $tablero->buscar_pieza(1,4);
        $tablero->mover_pieza("P2_6",6,6);
        $tablero->mover_pieza("P1_1",1,5);
        $tablero->mover_pieza("P2_6",6,5);


        $tablero->mover_pieza("P1_1",1,6);
        $tablero->mover_pieza("P2_6",6,4);
        $tablero->mover_pieza("P1_1",1,7);// Aqui come la pieza P2_1
        $tablero->mover_pieza("P2_6",6,3);// Aqui come la pieza P1_6
        $tablero->reingresar("P2_1",5,8); // Reingresamos la pieza p2_1 en frente al rey

        // Buscamos pieza tomada
        echo "Piezas tomadas: ".$tablero->buscar_tomadas();
        $this->assertSame(" P1_6 ", $tablero->buscar_tomadas()); 

        $tablero->promocionar("P2_6"); // Promocionamos la pieza P2_5
        $tablero->mover_pieza("P1_2",2,4);
       
        $tablero->mover_pieza("P2_6",6,2);
        $tablero->mover_pieza("P1_2",2,5);
        $tablero->mover_pieza("P2_6",5,1); // Con la pieza promocionada, que permite mov cruzado, matamos al rey

        echo "Ganador: ".$tablero->ganador->nombre;


        // Validamos que en la posicion 2 5, esta la pieza P1_2
        $this->assertSame("P2_6", $tablero->buscar_pieza_pos(5,1,"")->nombre); 

        // Validamos que la pieza p2_6 esta promocionada
        $this->assertSame(true, $tablero->buscar_pieza_pos(5,1,"")->promocionada); 

        //Validamos que el ganador es el jugador2
        $this->assertSame("jugador2", $tablero->ganador->nombre);
      
    }
}
?>