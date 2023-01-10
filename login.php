 <?php
 	session_start();
    require ("lib/mod004_presentacion.php");
	
 	if ( isset($_POST[ "email" ], $_POST[ "password" ]) ) {
		$email 		= $_POST[ "email" ];
		$password	= $_POST[ "password" ];
		echo $email . "" . $password;
		$retorno = mod003_validateUser( $email, $password );
	} else {
		//echo "Algo raro pasa";
	}
    
 
?>
