<?php 
class conexion{

	var $conexi;

	//se crea una funcion que nos va a hacer la conexion
	function conecta( $s, $u, $c ){

		$conex = mysql_connect( $s, $u, $c );
		$this->conexi = $conex;
	}
}

$server = $_SERVER['SERVER_NAME'];
$serv = "localhost";//nombre del servidor

if( $server == "localhost" ){
		
	$usuario = "root";//nombre del usuario
	$contra = "";//contraseña de acceso al servidor
	$base_datos = 'eyes_wide_shut';
}
else{
	
	$usuario = "digita42_eyes";//nombre del usuario
	$contra = "Eyes2014";//contraseña de acceso al servidor
	$base_datos = 'digita42_eyes';
}


$cono = new conexion();//se crea un nuebo objeto de conexion
$cono->conecta( $serv, $usuario, $contra );
$c = $cono->conexi;
$select = mysql_select_db( $base_datos, $c );//nombre de la base de datos
mysql_query( "SET NAMES utf8" );
mysql_query( "SET CHARACTER_SET utf8" ); 
header( 'Content-type: text/html; charset=utf-8' , true );
?>