 <?php
    require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "row" ]) ) {
		$initialRow = intval( $_GET[ "row" ] );
    } else {
        $initialRow = 0;
    }
	$amountRowsPerPage = 3;
	/* llamadas a las funciones de presentación-modelo para recuperar los datos que serán mostrados en la página. */
	$divUsuarios = mod004_getUsuariosPaginacion( $initialRow, $amountRowsPerPage );
	$listMarcas = mod004_getMarcasMenu();
	$divCategorias = mod004_getCategorias();

	require ("vista/vista_usuariospaginacion.php");
 
?>
