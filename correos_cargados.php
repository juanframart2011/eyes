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
$url_unica = $url->todos_usuarios();

echo 'En total son => '.mysql_num_rows( $url_unica ).'<br>';

while ( $arreglo = mysql_fetch_array( $url_unica ) ) {
	
	echo 'email => '.$arreglo["email_invi_email"].' => ';
	$url_unica_creada = $url->creacion_invitaciones( $arreglo["email_invi_email"] );
	echo $url_unica_creada.'<br>';
}
?>