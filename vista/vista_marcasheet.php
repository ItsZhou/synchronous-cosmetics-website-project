<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Ficha Marcas</title>
		<link rel="stylesheet" type="text/css" href="css/general.css">
		<link rel="stylesheet" type="text/css" href="css/generalheader.css">
		<link rel="stylesheet" type="text/css" href="css/marcasheet.css">
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
						<div class='iniciosesion'> Iniciar sesión </div>
						<div class='hiddenD'> 
							<form method='POST' > <!-- FALTA -->
								<div>
									<input type="text" placeholder="Direcccion de correo electrónico" name="email" required>  
								</div>
								<div>
									<input type="password" placeholder="Contraseña" name="password" required>
								</div>
								<button class="login">Iniciar sesión</button>
							</form>
		      			</div>
						 
				    </div>
					
					<nav>
						<a href='controlador1.php'><div>CUIDADO FACIAL</div></a>
						<a href='controlador1.php'><div>MAQUILLAJE</div></a>
						<a href='controlador1.php'><div>CUIDADO CORPORAL</div></a>
						<a href='controlador1.php'><div>MARCAS</div></a>
					</nav>
					
				</header>

					<?php
						echo $marcasSheet;
					?>
			</div>
		</div>
	</body>
</html>