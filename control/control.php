<?
// Controlador que se encarga de manejar todo el flujo de llamados
session_start();
require("config/constant.php");
require("model/pieza.php");
require("model/peon.php");
require("model/caballo.php");
require("model/lancero.php");
require("model/torre.php");
require("model/general_oro.php");
require("model/general_plata.php");
require("model/rey.php");
require("model/alfil.php");
require("model/factory_pieza.php");
require("model/jugador.php");
require("model/tablero.php");
require("model/mensajes.php");


//$_SESSION["tablero"] = null;

$tablero = Tablero::getInstance(C_FILAS,C_COLUMNAS);
$mensaje=new Mensajes("");

if ($_REQUEST[reiniciar]){ // Reiniciamos la partida
  $mensaje->obtener_mensaje(2);
  $tablero->reiniciar();
  $tablero = Tablero::getInstance(9,9);
    
}elseif ($_REQUEST[iniciar]){ // inicializamos todo
  $tablero->iniciar_partida($_REQUEST["jugador1"],$_REQUEST["jugador2"]);  
  $mensaje->obtener_mensaje(1);


}elseif ($_REQUEST[mover]){ // Movemos una pieza
  $res = $tablero->mover_pieza($_REQUEST["f_pieza"],$_REQUEST["f_x"],$_REQUEST["f_y"]); 
  if ($res == 0){ 
    $mensaje->obtener_mensaje(3);
  } elseif ($res == 1){ 
    $mensaje->obtener_mensaje(4);
  } elseif ($res == 2){ 
    $mensaje->obtener_mensaje(5);
  } elseif ($res == 3){ 
    $mensaje->obtener_mensaje(6);
  }elseif ($res == 4){ 
    $mensaje->obtener_mensaje(7);
  }


}else if ($_REQUEST[reingresar]){ // Reingresamos una pieza
  $res = $tablero->reingresar($_REQUEST["f_pieza"],$_REQUEST["f_x"],$_REQUEST["f_y"]); 
  if ($res == 0){ 
    $mensaje->obtener_mensaje(8);
  } elseif ($res == 1){ 
    $mensaje->obtener_mensaje(9);
  } elseif ($res == 2){ 
    $mensaje->obtener_mensaje(5);
  } elseif ($res == 3){ 
    $mensaje->obtener_mensaje(6);
  }elseif ($res == 4){ 
    $mensaje->obtener_mensaje(10);
  }
}else if ($_REQUEST[promocionar]){ // Promocionamos una pieza
  $res = $tablero->promocionar($_REQUEST["f_pieza"]); 
  if ($res == 0){ 
    $mensaje->obtener_mensaje(11);
  } elseif ($res == 1){ 
    $mensaje->obtener_mensaje(12);
  } elseif ($res == 2){ 
    $mensaje->obtener_mensaje(5);
  } elseif ($res == 3){ 
    $mensaje->obtener_mensaje(13);
  }
}

require_once("pages/inicio.php"); // Mostramos nuestra pagina unica
$tablero->persistir(); // Siempre guardamos el estado actual del tablero


?>