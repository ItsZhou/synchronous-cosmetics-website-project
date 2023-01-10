 <?php
 	session_start();
	require ("lib/mod004_presentacion.php");

	/* llamadas a las funciones de presentación-modelo para recuperar los datos que serán mostrados en la página. */
 	$header = mod004_getHeader();
    $listMarcas = mod004_getMarcasMenu();
	$categoriasSheet = mod004_getCategoriasSheetMenu();


    

	require ("vista/vista_main.php");
 
?>
