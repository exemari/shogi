<!--Pagina unica que muestra todo el contenido del sitio-->
<html>
<head>
<link rel="stylesheet" href="css/estilos.css">
 
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

	<title>Shogi Game</title>
	
</head>
<body>
	<h1>Partida de Shogi</h1>
	<div id="referencias">Referencias: R (Rey) / O (General Oro) / Q (General Plata) / C (Caballo)
	 / L (Lancero) / A (Alfil) / T (Torre) / P (Peon) 
	</div>
<!-- Boton para reiniciar-->
	<?php if ($tablero->get_iniciado()){?>
		<form method = "post">
			<button type="submit" value="reiniciar" name="reiniciar">Reiniciar partida</button>
		</form>
	<?php } ?>
<!-- Tablero de juego-->
	<table  id="tablero" border="1">
		<?php for ($i=0;$i<=$tablero->get_filas();$i++){
	 		echo "<tr>";
			for ($j=0;$j<=$tablero->get_columnas();$j++){
				$num = "";
				$class="";
				if ($i==0 && $j>0){
					$num = "X$j";
					$class="td_fondo";
				}elseif($i>0 && $j==0){
					$num = "Y$i";
					$class="td_fondo";
				}
				echo "<td class='celda $class'> <div id='pos_$i$j'/>$num";
				echo $tablero->buscar_pieza($j,$i);
				echo "</td>";
			}
			echo "</tr>";
		}?>
	</table>
	<h3><?php echo $mensaje->get_mensaje()?></h3>

<!-- Cuando el tablero NO esta iniciado-->	
	<?php if (!$tablero->get_iniciado()){?>
		<form method = "post" id="FJugadores">
			<table>
				<tr>
					<td>Jugador 1</td>
					<td>Jugador 2</td>
					<td></td>
				</tr>	
				<tr>
					<td><input type="text" name="jugador1" id="jugador1" required="true"></td>
					<td><input type="text" id="jugador2" name="jugador1"  required="true"></td>
					<td><button type="submit" value="iniciar" name="iniciar"  >Iniciar partida</button></td>
				</tr>
			</table>
		</form>

<!-- Cuando el tablero esta iniciado-->	
	<?php }elseif(!$tablero->ganador){ ?>

		Turno actual: <span id="<?php echo $tablero->get_turno()->nombre;?>"><?php echo $tablero->get_turno()->get_nombre();?></span>
		
		<form method="post">
			<table>
				<tr>
					<td>Pieza</td>
					<td>X</td>
					<td colspan="3">Y</td>
				</tr>
				<tr>
					<td><input type="text" name="f_pieza" required="true"></td>
					<td><input type="number" name="f_x" ></td>
					<td><input type="number" name="f_y"></td>
					<td><button type="submit" value="mover" name="mover">Mover</button></td>
					<td><button type="submit" value="reingresar" name="reingresar">Reingresar</button></td>
					<td><button type="submit" value="promocionar" name="promocionar">Promocionar</button></td>
				</tr>
				<?php if ($tablero->buscar_tomadas()){?>

					<tr><td colspan="5"><b>Piezas Tomadas:</b> 	<?php echo($tablero->buscar_tomadas())?></td><tr>

				<?php } ?>
			</table>
		</form>
		<span class="aclaraciones">
			<h3>Aclaraciones</h3>
			<i>* Solo están implementados los movimientos del Peon.</i><br>
			<i>* Para mover, complete el nombre de la pieza, la posicion X y la posición Y.</i><br>
			<i>* Para promocionar, complete el nombre de la pieza.</i><br>
			<i>* Para reingesar una pieza, complete el nombre de la pieza tomada y la posición X e Y en la que quiere ingresarla.</i><br>

		</span>	
	<?php }else{// Hay un ganador?>
		<h2> Felicitaciones! El ganador es: <?php echo $tablero->ganador->get_nombre()?><h2>
		<form method = "post">
			<button type="submit" value="reiniciar" name="reiniciar">Reiniciar partida</button>
		</form>
	<?php } ?>

</body>
</html>