 <?php
    require ("lib/mod004_presentacion.php");
	
	if (isset ( $_GET [ "idSubCategoria" ]) ){
		$idSubCategoria = $_GET [ "idSubCategoria" ];
		$subCategoriasSheet = mod004_getSubCategoriasSheet( $idSubCategoria ); 
	} else {
		//foo
	}
    

	require ("vista/vista_subcategoriasheet.php");
 
?>
