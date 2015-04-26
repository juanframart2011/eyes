<?php
//$url = $_GET["cod_eyes"];

include( 'Clases/conexion.php' );
include( 'Clases/invitado.php' );
//include( 'vista.php' );
/*
if( empty( $url ) ){

	include( 'error_no_existe.php' );
	//header( 'Location:error_no_existe.php' );
}
else{

	include( 'Clases/conexion.php' );
	include( 'Clases/invitado.php' );

	$validador = new invitado;
	$respuesta_validacion = $validador->validar_existe_url( $url );
	$arreglo_respuesta = mysql_fetch_array( $respuesta_validacion );
	
	if( $arreglo_respuesta["valido"] == 0 ){

		include( 'error_no_valido.php' );
		//header( 'Location:error_no_valido.php' );
	}
	else{

		$respuesta_estatus = $validador->validar_estatus( $url );
		$arreglo_estatus = mysql_fetch_array( $respuesta_estatus );
		
		if( $arreglo_estatus["estatus"] == 0 ){

			include( 'error_estatus.php' );
			//header( 'Location:error_estatus.php' );
		}
		else{

			include( 'vista.php' );
			//echo 'Perfecto mostremosle la página por primera y única vez y este es tu codigo => '.$arreglo_estatus["invi_codigo"];
		}
	}
}*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Animacion</title>
</head>
<body style="background:black;">
	<video style="width:100%;" autoplay preload>
		<source src="video/invitacion_b.mp4" type="video/mp4"/>
		<source src="video/invitacion_b.mov" type="video/mov" />
		Your browser does not support the video tag.
	</video>
</body>
</html>