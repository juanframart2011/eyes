<?
include( 'Clases/conexion.php' );
include( 'Clases/invitado.php' );

$invitado = new invitado;
$usuarios = $invitado->invitados();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Administrador de invitaciones</title>
</head>
<body>
	<h1>Hola Eugenia bienvenida al administrador de invitaciones</h1>

	<div>Al presionar este botón se le enviará la invitación nuevamente a todos</div>
	<button>Enviar Invitación</button><br>

	<div>Esta tabla es de todos los usurios con sus codigos y quién lo ha visto y quién no</div>
	<table border="1">
		<tr>
			<th>Usuario</th>
			<th>Codigo</th>
			<th>Ha visto la invitación</th>
		</tr>
	<?
	while( $arreglo = mysql_fetch_array( $usuarios ) ){

		if( $arreglo["invi_estatus"] == 1 ){

			$estatus = 'No';
		}
		else{

			$estatus = 'Si';
		}
	?>
		<tr>
			<td><?= $arreglo["invi_email"] ?></td>
			<td><?= $arreglo["invi_codigo"] ?></td>
			<td align="center"><?= $estatus ?></td>
		</tr>
	<?
	}
	?>
	</table>
	<script src="js/jquery-2.1.1.js"></script>
	<script type="text/javascript">
		$( document ).ready( function(){

			$( "button" ).click( function(){

				var ruta = 'mail.php';
				$.post( ruta );
			});
		});
	</script>
</body>
</html>