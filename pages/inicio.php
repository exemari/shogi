<!--Pagina unica que muestra todo el contenido del sitio-->
<html>
<head>
<link rel="stylesheet" href="css/estilos.css">
 
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

	<title>Shogi Game</title>
	
</head>
<body>

	<h1>Partida de Shogi</h1>
	
	<div id="referencias">Referencias: R (Rey) / O (General Oro) / Q (General Plata) / C (Caballo)
	 / L (Lancero) / A (Alfil) / T (Torre) / P (Peon) <a  href="#collapseRef" data-toggle="modal" data-target="#collapseRef" class="badge badge-info" >
					Ver aclaraciones
		  	</a>
	</div>
<!-- Boton para reiniciar-->
	<?php if ($tablero->get_iniciado()){?>
		<form method = "post">
		<button class="btn btn-primary" type="submit" value="reiniciar" name="reiniciar">
		Reiniciar partida</button>
		
		</form>
	<?php } ?>
<!-- Tablero de juego-->

	<table  id="tablero" class="table table-bordered table-sm" style="width:50%">
		<?php for ($i=0;$i<=$tablero->get_filas();$i++){
	 		echo "<tr>";
			for ($j=0;$j<=$tablero->get_columnas();$j++){
				$num = "";
				$class="";
				if ($i==0 && $j>0){
					$num = "X$j";
					$class="table-info";
				}elseif($i>0 && $j==0){
					$num = "Y$i";
					$class="table-info";
				}
				echo "<td class='celda $class' > $num";
				echo $tablero->buscar_pieza($j,$i);
				echo "</td>";
			}
			echo "</tr>";
		}?>
	</table>
	<?php if($mensaje->get_mensaje()) {?>
	<div class="alert alert-dark" role="alert" style="width:50%"><?php echo $mensaje->get_mensaje()?></div>
	<?php } ?>

<!-- Cuando el tablero NO esta iniciado-->	
	<?php if (!$tablero->get_iniciado()){?>
		<form method = "post" id="FJugadores">
			<table lass="table table-bordered table-dark">
				<tr>
					<td>Jugador 1</td>
					<td>Jugador 2</td>
					<td></td>
				</tr>	
				<tr>
					<td><input type="text" name="jugador1" id="jugador1" required="true"></td>
					<td><input type="text" id="jugador2" name="jugador2"  required="true"></td>
					<td><button type="submit" value="iniciar" name="iniciar" class="btn btn-primary" >Iniciar partida</button></td>
				</tr>
			</table>
		</form>

<!-- Cuando el tablero esta iniciado-->	
	<?php }elseif(!$tablero->ganador){ ?>

			
		<form method="post">
			<table >
				<tr>
					<td>Pieza</td>
					<td>X</td>
					<td colspan="3">Y</td>
				</tr>
				<tr>
					<td><input type="text" name="f_pieza" required="true"></td>
					<td><input type="number" name="f_x" ></td>
					<td><input type="number" name="f_y"></td>
					<td><button type="submit" value="mover" name="mover" class="btn btn-success">Mover</button></td>
					<td><button type="submit" value="reingresar" name="reingresar" class="btn btn-warning">Reingresar</button></td>
					<td><button type="submit" value="promocionar" name="promocionar" class="btn btn-dark">Promocionar</button></td>
				</tr>
				<?php if ($tablero->buscar_tomadas()){?>

					<tr><td colspan="5"><b>Piezas Tomadas:</b> 	<?php echo($tablero->buscar_tomadas())?></td><tr>

				<?php } ?>
			</table>
		</form>
		<span id="<?php echo $tablero->get_turno()->nombre;?>"><b>Turno actual:</b> <?php echo $tablero->get_turno()->get_nombre();?></span>
		<br>
		
		
	<?php }else{// Hay un ganador?>
		<h2> Felicitaciones! El ganador es: <?php echo $tablero->ganador->get_nombre()?><h2>
		<form method = "post">
			<button type="submit" value="reiniciar" name="reiniciar"  class="btn btn-primary">Reiniciar partida</button>
		</form>
	<?php } ?>

<!-- Popup aclaraciones -->
	<div class="modal fade" id="collapseRef" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Aclaraciones</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
					<i>* Solo están implementados los movimientos del Peon.</i><br>
					<i>* Para mover, complete el nombre de la pieza, la posicion X y la posición Y.</i><br>
					<i>* Para promocionar, complete el nombre de la pieza.</i><br>
					<i>* Para reingesar una pieza, complete el nombre de la pieza tomada y la posición X e Y en la que quiere ingresarla.</i><br>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				
			</div>
			</div>
		</div>
	</div>
</body>
</html>