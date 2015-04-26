<?php
include( 'Clases/conexion.php' );
include( 'Clases/invitado.php' );

$url = new invitado;

/*
for( $i = 20; $i <= 40; $i++ ){

	$email = 'ju'.$i.'n@ktbo.com.mx';
	$url_unica = $url->creacion_invitaciones( $email );
	echo $url_unica.'<br>';
}
*/
$url_unica = $url->invitados();

while ( $arreglo = mysql_fetch_array( $url_unica ) ) {
	
	echo 'email => '.$arreglo["invi_email"].' url => '.$arreglo["invi_url"].'<br>';
}
//print_r( $url_unica );

?>