<?php
#Clase en la cual se manejara todo lo relacionado con los invitados
class invitado{

	#Aquí se cambia el estatus cuando se ve la página del código
	public function cambiar_estatus( $url, $fecha_validacion ){

		$sql = ' UPDATE `invitado` SET `invi_estatus` = 2, `invi_fecha_validacion` = "'.$fecha_validacion.'" WHERE invi_url = "'.$url.'" ';
		$query = mysql_query( $sql );
		return $query;
	}

	#Con este creamos guardamos toda la información del invitado y ya registramos su código y url única
	public function creacion_invitaciones( $email ){

		$url_unica = $this->crear_encriptado( $email );
		$codigo = $this->crear_codigo( $email );
		$fecha_creacion = date( "Y-m-d H:i:s" );

		$sql = ' INSERT INTO `invitado`( `invi_email`, `invi_codigo`, `invi_url`, `invi_estatus`, invi_fecha_creacion ) VALUES 
		( "'.$email.'", "'.$codigo.'", "'.$url_unica.'",  1, "'.$fecha_creacion.'" ) ';

		$resultado_consulta = mysql_query( $sql );

		if( $resultado_consulta == 1 ){

			//return 'Guardado correctamente => '.$email;
			return $url_unica;
		}
		else{

			return 'Error';
			//return 'Guardado fallido => '.$email;
		}
	}

	/*
	Creación de codigo único:
	Para crear el código pedimos el correo electronico y relizamos diferente ecuaciones
	para sacar 10 digitos del código
	*/
	public function crear_codigo( $email ){

		#primero medimos el largo del email
		$tamano_email = strlen( $email );
		#luego tomamos el segundo caracter tamaño de email
		$segundo_caracter_tamano = substr( $tamano_email, 1 );
		#Segundo multiplicamos el segundo carcater de la medida por el primer segundo actual
		$primer_digito = $segundo_caracter_tamano * substr( date( 's' ), 0, 1 );
		#Luego invocamos la función sumatoria dos digitos para que nos devuelva un solo digito al sumar
		$primer_digito = $this->sumatoria_dos_digitos( $primer_digito, date( 's' ) );

		#Segundo digito de un random del 0 al 9
		$segundo_digito = rand( 0, 9 );

		#tercer digito del primer segundo más el random y después sacamos la letra de la función aleatoriamente
		$tercer_digito = $this->sumatoria_dos_digitos( substr( date( 's' ), 0, 1 ), $segundo_digito );
		$tercer_digito = $this->letra_aleatoria( $tercer_digito );

		#El cuarto digito es año segundo y mes juntos multiplicados por 14 y luego sacamos un número no mayor a 9
		$cuarto_digito_a = date( 'Yms' ) * 14;
		$cuarto_digito = $this->sumatoria_dos_digitos( substr( $cuarto_digito_a, 0, 1 ), substr( $cuarto_digito_a, 1 ) );

		/*
		Los ultimos 6 digitos del codigo los sacamos de concatenar el tercer digito con el primero y 
		mandarlos a la funcíon encriptado
		*/
		$finales_digitos = $this->crear_encriptado( $tercer_digito.$primer_digito );
		#Al final solo tomamos 6 de ese encriptado
		$ultimos_digitos = substr( $finales_digitos, 4, 6 );

		#Armamos la cadena de los 10 digitos unicos
		$codigo = $primer_digito.$segundo_digito.$tercer_digito.$cuarto_digito.$ultimos_digitos;

		return $codigo;
	}

	#Con este creamos encriptamiento
	public function crear_encriptado( $dato ){

		#Primero hacemos un hack con el email
		$encriptado_a = hash( 'sha256', $dato );
		#luego el resultado lo convertimos a md5
		$url = md5( $encriptado_a );
		#Retornamos la transformación final.
		return $url;
	}

	#Sacamos todos los invitados activos
	public function invitados(){

		$sql = ' SELECT `invi_email`, `invi_url`, invi_codigo, invi_estatus FROM `invitado` where invi_estatus=1 ';
		$query = mysql_query( $sql );
		return $query;
	}

	#Este nos da una letra dependiendo del número al azar
	public function letra_aleatoria( $numero ){

		switch ( $numero ) {
			case 0:
				$letra = 'Z';
				break;
			case 1:
				$letra = 'T';
				break;
			case 2:
				$letra = 'F';
				break;
			case 3:
				$letra = 'K';
				break;
			case 4:
				$letra = 'S';
				break;
			case 5:
				$letra = 'J';
				break;
			case 6:
				$letra = 'E';
				break;
			case 7:
				$letra = 'D';
				break;
			case 8:
				$letra = 'N';
				break;
			case 9:
				$letra = 'Y';
				break;
			default:
				$letra = 'A';
				break;
		}
		return $letra;
	}

	#con esta función sumamos dos digitos hasta que de un numero del 0 al 9
	public function sumatoria_dos_digitos( $a, $b ){

		$c = $a + $b;

		if( $c > 9 ){

			$a = substr( $c, 0, 1 );
			$b = substr( $c, 1 );

			$respuesta = $this->sumatoria_dos_digitos( $a, $b );
			return $respuesta;
		}
		else{

			return $c;
		}
	}
	
	#Validar la url si existe o no.
	public function todos_usuarios(){

		$sql = ' SELECT email_invi_email FROM email_invitado ';
		$query = mysql_query( $sql );
		return $query;
	}

	#Validamos si el la url fue usada y se vio el código
	public function validar_estatus( $url ){

		$sql = ' SELECT invi_codigo, COUNT( * ) as estatus from invitado WHERE invi_url = "'.$url.'" ';
		$query = mysql_query( $sql );
		return $query;
	}

	#Validar la url si existe o no.
	public function validar_existe_url( $url ){

		$sql = ' SELECT COUNT( * ) as valido from invitado WHERE invi_url = "'.$url.'" ';
		$query = mysql_query( $sql );
		return $query;
	}
}
?>