 <?php
    require ("lib/mod004_presentacion.php");

	if ( isset ($_GET [ "idUsuario"]) ) {
		$idUsuario = $_GET [ "idUsuario" ];
		$usuariosSheet = mod004_getUsuariosSheet( $idUsuario );
	} else {
		//foo
	}

	require ("vista/vista_usuariosheet.php");
 
?>
