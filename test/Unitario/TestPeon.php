<?php
use PHPUnit\Framework\TestCase;
require  "../../config/constant.php";
require  "../../model/pieza.php";
require  "../../model/peon.php";

class TestPeon extends TestCase
{
    public function testCreacion()
    {
        
        
        $nombre="Peon1";        
        $objeto = new Peon("Peon1",null,1,2);

        //validamos que se creo con el nombre
        $this->assertSame("Peon1", $objeto->nombre);
      
    }

    public function testMover()
    { // Intentamos moverlo a una posicion correcta y a una incorrecta

        $nombre="Peon1";        
        $objeto = new Peon("Peon1",null,1,2);

        //Dentro del tablero
        $res = $objeto->validar_movimiento(8,7);
        $this->assertSame(true, $res);
        
        //Fuera del tablero
        $res = $objeto->validar_movimiento(10,7);
        $this->assertSame(true, $res);
      
    }
}
?>