<?php
	function mod001_conectoBD () {
		$direccion  = "localhost";
		$usuario    = "root";
		$contrasena = "";
		$database   = "cosmetica_v1";
		
		$link = mysqli_connect( $direccion, $usuario, $contrasena, $database );
        
		if ( !$link ) {
			echo "Conexion fallida";
		} 
		
		return $link;
	}

	function mod001_desconectoBD ( $link ) {
		// Realizar la query de desconexión.
        mysqli_close( $link );
	}
?>
