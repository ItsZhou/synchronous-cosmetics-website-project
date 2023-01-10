<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Listado Cosmetica</title>
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="stylesheet" type="text/css" href="css/generalheader.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="css/usuariospaginacion.css">

		<script>
			function validateloginform() {
				let isValidate = true;
				const reLargo = /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

				loginform.email.className		= "";
				loginform.password.className	= "";

				let email = loginform.email.value;
				let password = loginform.password.value;
				
				if ( email.trim() === "" ) {
					loginform.email.className = "error";
					isValidate = false;
				} else if ( !reLargo.test( email ) ) {
                    loginform.email.className = "error";           
                    isValidate = false;
                }
				if ( password.length < 8 ) {
					loginform.email.className = "error";
					isValidate = false;
				}
				return isValidate;
			}
		</script>
		<style>
		</style>
	</head>
	<body>
		<div class='wrapper'>
			<div class='subwrapper'>
				<header>
					<div class='headermain'>
						<div class='logo'>
							<img src='Cosmetica/freezia1.png' class='width100' />
						</div>
						<div class="title">Freezia Cosmetics</div>
						
						<div class='buscador'> 
							<input type='text' name='buscador'placeholder='Buscar'/>
						</div>
						<div class='iniciosesion'>
							<?php
								//echo $userLogged;
							?>
						</div>
						<div class='login hiddenD'> 
							<form name="loginform" method="POST" onsubmit="return validateloginform();" action="login.php">
								<div>
									<input type="text" name="email" placeholder="Direcccion de correo electrónico"/>  
								</div>
								<div>
									<input type="password" name="password" placeholder="Contraseña"/>
								</div>
								<div>
									<input type='submit' name='ir' value='Iniciar Sesion'/>
								</div>
								<!--<button class="login">Iniciar sesión</button>-->
							</form>
		      			</div>
				    </div>
					
					<nav>
						
						<div class='dropdown'>
							<a href='categoriasheet.php'>CUIDADO FACIAL</a>
								<div class='dropdown-content'>
									<?php
										
									?>
									<!--<a href='categoriasheet.php'>Cuidado facial</a>
									<a href='subcategoriasheet.php'>Hola</a>

									<a href='categoriasheet.php'>Limpieza facial</a>-->
								</div>
						</div>
						<div class='dropdown'>
							<a href='categoriasheet.php'>MAQUILLAJE</a>
								<div class='dropdown-content'>
									<?php
										
									?>
									<!--<a href='categoriasheet.php'>Rostro</a>
									<a href='categoriasheet.php'>Ojos</a>
									<a href='categoriasheet.php'>Labios</a>-->
								</div>
						</div>
						<div class='dropdown'>
							<a href='categoriasheet.php'>CUIDADO CORPORAL</a>
								<div class='dropdown-content'>
									<?php
										
									?>
									<!--<a href='categoriasheet.php'>Cabello</a>
									<a href='categoriasheet.php'>Cuerpo</a>-->
								</div>
						</div>
					
						<div class='dropdown'>
							<a href='categoriasheet.php'>MARCAS</a>
								<div class='dropdown-content'>
									<!-- <a href='marcasheet.php'>Klairs</a>
									<a href='marcasheet.php'>The Ordinary</a>
									<a href='marcasheet.php'>Kiehls</a>
									<a href='marcasheet.php'>Aromatica</a>
									<a href='marcasheet.php'>Benton</a>
									<a href='marcasheet.php'>Laneige</a>
									<a href='marcasheet.php'>Yves Rocher</a>
									<a href='marcasheet.php'>Facetheory</a>
									<a href='marcasheet.php'>Giorgio Armani</a>
									<a href='marcasheet.php'>Nyx</a>
									<a href='marcasheet.php'>Clio</a>
									<a href='marcasheet.php'>Etude House</a>
									<a href='marcasheet.php'>Shisheido</a>
									<a href='marcasheet.php'>Isoi</a>
									<a href='marcasheet.php'>Some by mi</a>
									<a href='marcasheet.php'>Kao</a>
									<a href='marcasheet.php'>Rituals</a> -->
									<?php
										echo $listMarcas;
									?>
								</div>
						</div>
					</nav>
				</header>
				<main>
					<?php
						echo $divUsuarios;
					?>

				</main>
			</div>
		</div>
	</body>
</html>