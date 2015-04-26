<?
include( 'Clases/conexion.php' );
include( 'Clases/invitado.php' );

$usuarios = new invitado;

$usuarios = $usuarios->invitados();

while( $arreglo = mysql_fetch_array( $usuarios ) ){
	
	//echo $arreglo["email_invi_email"].'<br>';
	
	$html = '<!DOCTYPE html>
	<html>
	<head>
		<title>Newsletter</title>
		<style type="text/css">
			body, html {
					background:black;
					padding:0; 
					margin:0;
				}
		</style>
	</head>
	<body style="background:black;margin:0;padding:0;">
		<table align="center" border="1" style="background:black;border:1px solid black;" width="600">
			<th width="100%" style="color:white;">
				<h1>
					Please watch the next video!<br>
					It contains all de information of the party<br>
					Regards, A. Cassab & J. Sourasky
				</h1>
				<img align="center" src="http://digitalizandote.com/Eyes_Wide_Shut/img/invitacion.jpg" /><br><br>
				<a href="http://digitalizandote.com/Eyes_Wide_Shut/animacion.php?cod_eyes='.$arreglo["invi_url"].'">
					<button style="background:red;border:none;color:white;cursor:pointer;font-family:cursive;font-size:25px;padding:40px;">Ver Invitation</button>
				</a>
			</th>
		</table>
	</body>
	</html>';
	
	$adireccion = $arreglo["invi_email"];
	//$adireccion = 'juanframart2011@hotmail.com';
	//$adireccion = 'eugeniadelavegac@hotmail.com';
	$comentario = "Personal invitation Abraham Cassab & Jack Sourasky Birthday Party";//comentario
	$asunto = "Abraham Cassab & Jack Sourasky";//asunto
	
	$nombre = $nombre;//quien envia el correo
	$demail = "Birthday_Party@gmail.com";//asunto
	//$cabeceras = "Content-type: text/html, From: $demail";//tipo de texto en el correo 

	//$headers = "From: $demail";
	//$headers .= "Content-type: text/html;";
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $demail <$demail>\r\n";
	$headers .= "Reply-To: $demail\r\n";
	$headers .= "Return-path: $demail\r\n";
	
	$dedireccion = $email;
	$comentario = trim( $comentario );

	if( mail( $adireccion, $asunto, $html, $headers ) ){
	
		echo 'Felicidades se envio a '.$arreglo["invi_email"];
	}
	else{
	
		echo 'No se envio a '.$arreglo["invi_email"];
	}
	echo '<br>';
}
?>


<!--
email: paty_gu2000@hotmail.com
contraseña: Trident2014
celular: 0445523487610
Cumpleaños: 10 de agosto de 1980
-->