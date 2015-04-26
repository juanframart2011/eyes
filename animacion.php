<?php
$url = $_GET["cod_eyes"];

include( 'Clases/conexion.php' );
include( 'Clases/invitado.php' );

if( empty( $url ) ){

	include( 'error_no_existe.php' );
	//header( 'Location:error_no_existe.php' );
}
else{


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
		
		if( $arreglo_estatus["estatus"] == 10 ){

			include( 'error_estatus.php' );
		}
		else{

			$fecha_validacion = date( "Y-m-d H:i:s" );
			$validador->cambiar_estatus( $url, $fecha_validacion );
		?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Animacion</title>
				<style type="text/css">
				body{
					overflow: hidden;
				}
				video{
					margin-top: -20px;
				}
				#codigo{
					background: red;
					border: none;
					color: white;
					cursor: pointer;
					font-size: 50px;
					font-family: cursive;
					height: 145px;
					padding: 20px;
					width: 350px;
				}
				#codigo_escondido{
					display:none;
					font-family: Helvetica;
					font-size: 40px;
				}
				#contenedor_mensajero{
					
					height: 100%;
					margin:0px auto;
					position: absolute;
					width:100%;
				}
				#mensaje_estatico{
					color:white;
					display: none;
					font-family: Helvetica;
					font-size: 20px;
					text-align: center;
				}
				</style>
			</head>
			<body style="background:black;">
				<div id="contenedor_mensajero">
					<video style="width:100%;" autoplay preload>
						<source src="video/invitacion_a.mp4" type="video/mp4"/>
						<source src="video/invitacion_a.mov" type="video/mov" />
						Tu Explorador no soporta videos, por favor actualizar.
					</video>
					<div id="mensaje_estatico">
						<p>
							Saturday, the 8th of November, two thousand fourteen.<br>
							Nine o´clock.<br>
							At Luis G. Urbina 104, Chapultepec Morales.<br>
							Mandatory Black Tie (Tuxedo and Evening Dress).<br>
							Click in the link below to get your SECRET access code.<br>
						</p>
						<p>
							Remember that your code is personal and you will absolutely NOT gain access without it.<br>
						</p>
						<p>
							<button id="codigo">CODE</button>
							<div id="codigo_escondido"><?= $arreglo_estatus["invi_codigo"] ?></div>
						</p>
					</div>
				</div>
				<script src="js/jquery-2.1.1.js"></script>
				<script type="text/javascript">
					$( document ).ready( function(){

						var video = document.getElementsByTagName("video")[0];
						video.addEventListener( "ended", function () {
						
							$( "#contenedor_mensajero" ).css( "background", "url( 'img/animacion.jpg' )" );
							$( "video" ).fadeOut( "slow", function(){

								$( "#mensaje_estatico" ).fadeIn( "slow" );
							} );
						}, false);

						$( "#codigo" ).click( function(){

							$( this ).fadeOut( "slow", function(){

								$( "#codigo_escondido" ).fadeIn( "slow" );
							} );
						});
					});
				</script>
			</body>
			</html>
		<?
		}
	}
}
?>