<?php
use PHPUnit\Framework\TestCase;

class TestJugador extends TestCase
{
    public function testCreacion()
    {
        require  "../../config/constant.php";
        require  "../../model/jugador.php";
        $nombre="Jugador1";        
        $objeto = new Peon($nombre," Descripcion");

        //validamos que se creo con el nombre
        $this->assertSame($nombre, $objeto->get_nombre());
      
    }
}
?>