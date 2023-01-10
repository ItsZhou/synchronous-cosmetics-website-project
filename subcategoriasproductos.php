 <?php
    require ("lib/mod004_presentacion.php");
	
	if (isset ( $_GET [ "idSubCategoriaProducto" ]) ){
		$idSubCategoriaProducto = $_GET [ "idSubCategoriaProducto" ];
		$subCategoriaProducto = mod004_getSubCategoriasProductos( $idSubCategoriaProducto ); 
	} else {
		//foo
	}
    
	$header = mod004_getHeader();
    $listMarcas = mod004_getMarcasMenu();
	$categoriasSheet = mod004_getCategoriasSheetMenu();

	require ("vista/vista_subcategoriasproductos.php");
 
?>
