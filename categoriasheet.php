 <?php
    require ("lib/mod004_presentacion.php");
	
	if (isset ( $_GET [ "idCategoria" ]) ){
		$idCategoria = $_GET [ "idCategoria" ];
		$categoriasSheet = mod004_getCategoriasSheet( $idCategoria ); 
	} else {
		//foo
	}
    

	require ("vista/vista_categoriasheet.php");
 
?>
