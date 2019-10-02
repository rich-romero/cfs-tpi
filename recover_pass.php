<?php
	$email="";
	$username="";
	$invalidEmailError = false;
	$usuarioVacioError= false;


	if (isset($_POST['submit']) && !empty($_POST['submit'])) {

				if (!empty($_POST["email"]) || filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
					$email = $_POST["email"];
		    }else{
					$invalidEmailError = true;
		    }

				if (!empty($_POST["username"])){
					$username = $_POST["username"];
		    }else {
					$usuarioVacioError= true;
		    }

			if (!$invalidEmailError && !$usuarioVacioError) {

					if (file_exists('json/usuarios.json')){
						$usuariosJson= file_get_contents('json/usuarios.json');
						$usuarios = json_decode($usuariosJson,true);

						foreach ($usuarios['usuarios'] as $usuario){
							$usuarioNoExisteError = true;
							if ($usuario['username'] == $username) {
								$usuarioNoExisteError = false;
								if ($usuario['email'] == $email) {
									 header("Location:index.php");
								}
							}

						}


				}else{
						echo "ERROR 505";
						exit;
				}
			}
	}



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
	  <meta charset="utf-8">
		<title>ArGames</title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap.css">
	  <link rel="stylesheet" href="css/animate.css">
	  <link rel="stylesheet" href="css/formulario_estilos.css">
	  <script src="js/wow.min.js" type="text/javascript"></script>
	        <script>
	        new WOW().init();
	        </script>
</head>
<body>

	<div class="container">
		<div class="row ">
			<div class="col text-center pt-4">

				<h2 class="FAQ_text font-weight-bold  wow jello">Recuperar contraseña</h2>
				<h2 class="FAQ_SUBTEXT wow fadeIn">Mandanos un email y a la mayor brevedad te contacatamos para poder recuperarla</h2>

		</div>
	</div>
		<div class="container d-flex h-100">

			<div class="row justify-content-center align-self-centerr">

					<div class="col-md-5">

					</div>

					<div class="col-md-5">

			      <form id="contact-stack-form" class="form wow bounceInRight" method="post">
							<div class="cube-1 w-100 cube">
								<div class=" front"></div>
								<div class=" back"></div>
								<div class=" top"></div>
								<div class=" bottom"></div>
								<div class=" left"></div>
								<div class=" right"></div>
							</div>
							<div class=" cube-2 w-100 cube">
								<div class=" front">
									<label for="name" style="font-style:bold;" class=" label">Nombre</label>
								</div>
								<div class=" back"></div>
								<div class=" top"></div>
								<div class=" bottom"></div>
								<div class=" left"></div>
								<div class=" right"></div>
							</div>
							<div class=" cube-3 w-100 cube">
								<div class=" front"></div>
								<div class=" back"></div>
								<div class=" top"></div>
								<div class=" bottom"></div>
								<div class=" left"></div>
								<div class=" right">	<label for="name" style="font-style:bold;" class=" label">Nombre</label></div>
							</div>
							<div class=" cube-4 w-300 cube">
								<div class=" front"></div>
								<div class=" back"></div>
								<div class=" top"></div>
								<div class=" bottom"></div>
								<div class=" left"></div>
								<div class=" right"></div>
							</div>
							<div class=" cube-5 w-300 cube">
								<div class=" front">
						      <input type="text" name="username" value="<?=empty($_COOKIE['remember_username'])? $username:$_COOKIE['remember_username']?>" placeholder="Tu nombre de usuario" class=" field">
								</div>
								<div class=" back"></div>
								<div class=" top"></div>
								<div class=" bottom"></div>
								<div class=" left"></div>
								<div class=" right"></div>
							</div>
									<!-- RESERVADOR PARA ERRORES DE VALDIACION -->
							<?php if ($usuarioVacioError): ?>
								<div class=" cube-31 w-300 cube text-center">
									<div class=" front">
										<p class=" pt-1 mt-2 texto_validacion">¡El campo usuario esta vacio!</p>
									</div>
									<div class=" back"></div>
									<div class=" top"></div>
									<div class=" bottom"></div>
									<div class=" left"></div>
									<div class=" right"></div>
								</div>
							<?php endif; ?>



						<!-- RESERVADOR PARA ERRORES DE VALDIACION -->
						<div class=" cube-6 w-180 cube">
							<div class=" front"></div>
							<div class=" back"></div>
							<div class=" top"></div>
							<div class=" bottom"></div>
							<div class=" left"></div>
							<div class=" right"></div>
						</div>

						<div class=" cube-8 w-100 cube">
							<div class=" front"></div>
							<div class=" back"></div>
							<div class=" top"></div>
							<div class=" bottom"></div>
							<div class=" left"></div>
							<div class=" right"></div>
						</div>
						<div class=" cube-9 w-300 cube">
							<div class=" front"></div>
							<div class=" back"></div>
							<div class=" top"></div>
							<div class=" bottom"></div>
							<div class=" left"></div>
							<div class=" right"></div>
						</div>
			      	<div class=" cube-2 w-100 cube">
			      		<div class=" front">
			      			<label for="name" style="font-style:bold;" class=" label">Email</label>
			      		</div>
			      		<div class=" back"></div>
			      		<div class=" top"></div>
			      		<div class=" bottom"></div>
			      		<div class=" left"></div>
			      		<div class=" right"></div>
			      	</div>
			      	<div class=" cube-3 w-100 cube">
			      	</div>
			      	<div class=" cube-4 w-300 cube">
			      		<div class=" front"></div>
			      		<div class=" back"></div>
			      		<div class=" top"></div>
			      		<div class=" bottom"></div>
			      		<div class=" left"></div>
			      		<div class=" right"></div>
			      	</div>
			      	<div class=" cube-12 w-300 cube">
			      		<div class=" front">
			      			<input type="email" value="<?=$email ?>" name="email" id="password" placeholder="Ingresa tu email" class=" field">
			      		</div>
			      		<div class=" back"></div>
			      		<div class=" top"></div>
			      		<div class=" bottom"></div>
			      		<div class=" left"></div>
			      		<div class=" right">
			      		</div>
			      	</div>
							<?php if ($invalidEmailError): ?>
								<div class=" cube-31 w-300 cube">
									<div class=" front text-center">
										<p class="pt-1 mt-2 texto_validacion">¡El campo Email esta vacio!</p>
									</div>
									<div class=" back"></div>
									<div class=" top"></div>
									<div class=" bottom"></div>
									<div class=" left"></div>
									<div class=" right"></div>
								</div>

							<?php endif; ?>
							<?php if ($usuarioNoExisteError): ?>
								<div class=" cube-31 w-300 cube">
									<div class=" front text-center">
										<p class="texto_validacion">¡El email o nombre de usuario son incorrectos!</p>
									</div>
									<div class=" back"></div>
									<div class=" top"></div>
									<div class=" bottom"></div>
									<div class=" left"></div>
									<div class=" right"></div>
								</div>
							<?php endif; ?>

			      	<div class=" cube-33 w-300 cube font-weight-bold">
			      			<div class=" front">
			      				<button type="submit" name="submit" id="contact-stack-button" value="enviar" class=" button">RECUPEAR</button>
			      			</div>
			      			<div class=" back"></div>
			      			<div class=" top"></div>
			      			<div class=" bottom"></div>
			      			<div class=" left"></div>
			      			<div class=" right bg-danger"></div>
			      		</div>

			      </form>
			  </div>

				<div class="col-md-1">
				</div>


    	</div>
    </div> <!-- CIERRE DE CONTAINER PRINCIPAL-->

		<div class="container">
			<div class="row mb-3 align-items-center wow fadeInUp">
				<div class="col-lg-10 col-md-9 col-sm-12 text-white">
				 <p class="text-md-left text-center">© <script>document.write(new Date().getFullYear());</script> Todos los derechos reservados. Hecho por <a href="#" class=" text-warning" target="_blank"><span class=" font-weight-bold argames_link">ArGames</span></a></p>
				</div>
				<div class="col-lg-2 col-md-3  col-sm-12 copyrighy_footer justify-content-between d-flex">
					<a style="border:1.1px solid yellow; letter-spacing:0.2em;" class="m-1 p-1 btn btn-yellow faqbutton" href="index.php" role="button">JUGAR</a>
					<a style="border:1.1px solid yellow;" class="m-1 p-1 btn btn-yellow faqbutton" href="FAQ.php" role="button">F.A.Qs</a>
				</div>
			</div>
		</div>



  </body>
</html>
