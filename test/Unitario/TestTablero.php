<?php
session_start();

use PHPUnit\Framework\TestCase;

class TestTablero extends TestCase
{
    public function testCreacion()
    {
        require  "../../config/constant.php";
        require  "../../model/tablero.php";
        
        $tablero = new Tablero(C_FILAS,C_COLUMNAS);

        //posiciones del tablero
        $this->assertSame(81, $tablero->get_filas()*$tablero->get_columnas());
      
    }
}
?>