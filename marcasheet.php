 <?php
    require ("lib/mod004_presentacion.php");
	
	if ( isset ( $_GET[ "idMarca" ] ) ) {
        $idMarca = $_GET[ "idMarca" ];
        $marcasSheet = mod004_getMarcasProductosSheet( $idMarca );
    } else {
        // foo
    }
    

	require ("vista/vista_marcasheet.php");
 
?>
