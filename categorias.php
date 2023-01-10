 <?php
	session_start();
    require ("lib/mod004_presentacion.php");
	
	if ( isset ( $_SESSION[ "idUser" ], $_SESSION[ "nameUser" ] ) ) {
        $userLogged = "Hola {$_SESSION[ "nameUser" ]}";

    } else {
        $userLogged = "Iniciar Sesión";
    }
	

	/* llamadas a las funciones de presentación-modelo para recuperar los datos que serán mostrados en la página. */
    $header = mod004_getHeader();
	$listMarcas = mod004_getMarcasMenu();
	$categoriasSheet = mod004_getCategoriasSheetMenu();
    

	require ("vista/vista_categorias.php");
 
?>
