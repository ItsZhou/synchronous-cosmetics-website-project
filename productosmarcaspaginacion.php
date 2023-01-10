 <?php
    require ("lib/mod004_presentacion.php");
	
	if ( isset( $_GET[ "row" ]) ) {
		$initialRow = intval( $_GET[ "row" ] );
    } else {
        $initialRow = 0;
    }
	$amountRowsPerPage = 3;
	
	if ( isset ( $_GET[ "idMarca" ] ) ) {
        $idMarca = $_GET[ "idMarca" ];
		$divProductosMarcas = mod004_getProductosMarcasPaginacion( $idMarca, $initialRow, $amountRowsPerPage );

    } else {
        // foo
		//$divProductosMarcas = "No tengo idMarca en la URL";
    }
	
	/* llamadas a las funciones de presentación-modelo para recuperar los datos que serán mostrados en la página. */
	$header = mod004_getHeader();
	$listMarcas = mod004_getMarcasMenu();
	$categoriasSheet = mod004_getCategoriasSheetMenu();

	require ("vista/vista_productosmarcaspaginacion.php");
 
?>
