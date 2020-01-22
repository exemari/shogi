<?php
// Clase encargada de manejar toda la funcionalidad del tablero
class Tablero{
   
	var $filas;
    var $columnas;
    var $Jugador1;
    var $Jugador2;
    var $iniciado;
    var $piezas;
    var $fila_peon_j1 = 3;
    var  $fila_peon_j2 = 7;
    var $turno;
    var $ganador;
    
    private static $instance;

    public function __construct($filas,$columnas)
    {
        $this->filas = $filas;
        $this->columnas = $columnas;
    }

    // Obtiene una instancia unica y la busca en la sesion
    public static function getInstance($filas,$columnas)
    {

       
        //echo self::$instance;
        if (!self::$instance instanceof self) {
            
            if (!$_SESSION["tablero"]){
               
             self::$instance = new self($filas,$columnas);
            }else{
                self::$instance = unserialize($_SESSION["tablero"]);
            }
        }

        return self::$instance;
    }

    //Cantidad de Filas
    function get_filas(){
        return  $this->filas;

    }
    //Cantidad de columnas
	 function get_columnas(){
        return  $this->columnas;

    }
    //Seteamos los jugadores
    function set_jugadores($jugador1,$jugador2){
        $this->Jugador1 = new Jugador("jugador1",$jugador1);
        $this->Jugador2 = new Jugador("jugador2",$jugador2);
    }

    //Iniciamos la partida
    function iniciar_partida($jugador1,$jugador2){
        $this->iniciado = true;
        $this->set_jugadores($jugador1,$jugador2);
        $factory = new Factory_pieza();
        // Iniciamos Peones
        for ($i=1;$i<=$this->get_filas();$i++){ // Creamos los peones para el jugador 1
            $pos = $this->get_fila_inicio("Peon",1,$i);
            
            
            $this->piezas[$pos] = $factory->get_pieza("Peon","P1_$i",$this->Jugador1,$i,3);
            

        }
        for ($i=1;$i<=$this->get_filas();$i++){ // Creamos los peones para el jugador 2
            
            $pos = $this->get_fila_inicio("Peon",2,$i);
            
            $this->piezas[$pos] = $factory->get_pieza("Peon","P2_$i",$this->Jugador2,$i,7);
          

        }
        // Colocamos el Rey para cada jugador
        $this->piezas[5] = $factory->get_pieza("Rey","R1_1",$this->Jugador1,5,1);
        $this->piezas[77] = $factory->get_pieza("Rey","R2_1",$this->Jugador2,5,9);

        //Generales de Oro para cada pieza
        $this->piezas[4] = $factory->get_pieza("General_Oro","O1_1",$this->Jugador1,4,1);
        $this->piezas[6] = $factory->get_pieza("General_Oro","O1_2",$this->Jugador1,6,1);
        $this->piezas[76] = $factory->get_pieza("General_Oro","O2_1",$this->Jugador2,4,9);
        $this->piezas[78] = $factory->get_pieza("General_Oro","O2_2",$this->Jugador2,6,9);

        //Generales de Plata para cada pieza
        $this->piezas[3] = $factory->get_pieza("General_Plata","Q1_1",$this->Jugador1,3,1);
        $this->piezas[7] = $factory->get_pieza("General_Plata","Q1_2",$this->Jugador1,7,1);
        $this->piezas[75] = $factory->get_pieza("General_Plata","Q2_1",$this->Jugador2,3,9);
        $this->piezas[79] = $factory->get_pieza("General_Plata","Q2_2",$this->Jugador2,7,9);

        //Caballos para cada pieza
        $this->piezas[2] = $factory->get_pieza("Caballo","C1_1",$this->Jugador1,2,1);
        $this->piezas[8] = $factory->get_pieza("Caballo","C1_2",$this->Jugador1,8,1);
        $this->piezas[74] = $factory->get_pieza("Caballo","C2_1",$this->Jugador2,2,9);
        $this->piezas[80] = $factory->get_pieza("Caballo","C2_2",$this->Jugador2,8,9);

        //Lanceros para cada pieza
        $this->piezas[1] = $factory->get_pieza("Lancero","L1_1",$this->Jugador1,1,1);
        $this->piezas[9] = $factory->get_pieza("Lancero","L1_2",$this->Jugador1,9,1);
        $this->piezas[73] = $factory->get_pieza("Lancero","L2_1",$this->Jugador2,1,9);
        $this->piezas[81] = $factory->get_pieza("Lancero","L2_2",$this->Jugador2,9,9);
        
        //Torre y alfil
        $this->piezas[11] = $factory->get_pieza("Alfil","A1_1",$this->Jugador1,8,2);
        $this->piezas[17] = $factory->get_pieza("Torre","T1_1",$this->Jugador1,2,2);
        $this->piezas[65] = $factory->get_pieza("Alfil","A2_1",$this->Jugador2,2,8);
        $this->piezas[71] = $factory->get_pieza("Torre","T2_1",$this->Jugador2,8,8);

        $this->turno = 1; // arrancamos con el turno jugador 1
    }
    //Cambiamos turno
    function cambiar_turno(){
        if ($this->turno ==1)
            $this->turno =2;
        else
            $this->turno = 1;    
    }
    //Devolvemos el jugador en turno
    function get_turno(){
        if ($this->turno ==1)
            return $this->Jugador1;
        else
            return $this->Jugador2;
    }
    //Vemos si esta iniciada la partida
    function get_iniciado(){
        return $this->iniciado;
    }
    //Persistimos en sesion
    function persistir(){

        $_SESSION["tablero"] = serialize($this);
    }
    //Reiniciamos el tablero
    function reiniciar(){
        self::$instance = null;
        $_SESSION["tablero"] = null;
        
    }
    // Buscamos si no hay una pieza en esa posicions
    function buscar_pieza($x,$y){
        
        foreach($this->piezas as $p){
            
           $existe = $p->validar_posicion($x,$y); 
           if ($existe){
               
               $class="";
               if ($p->promocionada){
                   $class="promocionada";
               }
               return "<span id='".$p->Jugador->nombre."' class='$class'>".$p->nombre."</span>";
           }

        }

    }
    //Devolvemos las piezas tomadas por el jugador
    function buscar_tomadas(){
        
        $ret="";
        
        foreach($this->piezas as $p){
            
           $existe = $p->tomada; 
           if ($p->tomada && $p->Jugador->get_nombre() == $this->get_turno()->get_nombre()){
               
               $ret .= " $p->nombre ";
           }

        }
        return $ret;

    }

    // Vemos en que fila inicia
    function get_fila_inicio($pieza,$jug,$i){
        switch ($pieza){
            case "Peon":
                if ($jug==1){
                    $pos = $i + (3-1) * $this->get_filas();
                    break;
                }else{
                    $pos = $i + (7-1) * $this->get_filas();  
                    break; 
                }
        }
        return $pos;

    }
    // Movemos la pieza
    function mover_pieza($p,$x,$y){
        $pieza = $this->buscar_por_nombre($p,false);
        if ($pieza){
            
            if ($pieza->Jugador->get_nombre() == $this->get_turno()->get_nombre()){ // es del jugador la pieza
                $mov_permitido = $pieza->validar_movimiento($x,$y);
                
                if (!$mov_permitido){// No puede hacer este movimiento
                    return 3;
                }else{// Todo OK
                    // vemos si hay una pieza propia
                    $pieza_propia = $this->buscar_pieza_pos($x,$y,"propia");
                    if ($pieza_propia){
                        return 4;
                    }else{
                        //vemos si hay piezas para capturar.
                        $pieza_rival = $this->buscar_pieza_pos($x,$y,"rival");
                        if ($pieza_rival){// Si hay una pieza rival, la tomamos
                            
                            $pieza_rival->tomar_pieza($this->get_turno());
                            if ($pieza_rival->esrey){
                                $this->ganador = $this->get_turno();
                            }
                        }
                        $pieza->mover($x,$y);
                        $this->cambiar_turno();
                }
                }
                return 0;
            }else{
                return 2; // significa que no es del jugador
            }
        }else{
            return 1; // significa que no existe
        }
        
    }

    // Reingresamos la pieza
    function reingresar($p,$x,$y){
        $pieza = $this->buscar_por_nombre($p,true);
        if ($pieza){
            
            if ($pieza->Jugador->get_nombre() == $this->get_turno()->get_nombre()){ // es del jugador la pieza
                $mov_permitido = true;
                if (!$mov_permitido){// No puede hacer este movimiento
                    return 3;
                }else{// Todo OK
                    // vemos si hay una pieza propia
                    $hay_pieza = $this->buscar_pieza_pos($x,$y,"");
                    if ($hay_pieza){
                        return 4;
                    }else{
                        $pieza->tomada = false;
                        $pieza->mover($x,$y);
                        $this->cambiar_turno();
                }
                }
                return 0;
            }else{
                return 2; // significa que no es del jugador
            }
        }else{
            return 1; // significa que no existe
        }
        
    } 
    //Promocionamos la pieza
    function promocionar($p){
        $pieza = $this->buscar_por_nombre($p,false);
        if ($pieza && !$pieza->promocionada){ // Si existe y no esta promocionada
            
            if ($pieza->Jugador->get_nombre() == $this->get_turno()->get_nombre()){ // es del jugador la pieza
                $puede_promocionar = $pieza->puede_promocionar();
                if (!$puede_promocionar){// No puede hacer este movimiento
                    return 3;
                }else{// puede promocionar
                    $this->cambiar_turno();
                    return 0;
                }
            }else{
                return 2; // significa que no es del jugador
            }
        }else{
            return 1; // significa que no existe
        }
        
    }
    // Buscamos la pieza por nombre
    function buscar_por_nombre($n,$tomada){
        foreach($this->piezas as &$p){
            
           if (strtoupper($p->nombre) == strtoupper($n) && $p->tomada == $tomada){
                return $p;
            }
 
         }
         return false; 
    }
    // Vemos si hay una pieza en esa posicion
    function buscar_pieza_pos($x,$y,$tipo){
       
        foreach($this->piezas as &$p){
            
           $existe = $p->validar_posicion($x,$y); 
           
           if ($existe && $p->Jugador->get_nombre() != $this->get_turno()->get_nombre() && $tipo=="rival"){
              
               return $p;
           } elseif ($existe && $p->Jugador->get_nombre() == $this->get_turno()->get_nombre() && $tipo=="propia"){
            
            return $p;
            }elseif ($existe && $tipo==""){
                
                return $p;
            }

        }

    }


}
?>