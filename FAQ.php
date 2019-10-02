<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/FAQ.css">
	<script src="js/modernizr.js"></script>
	<script src="js/wow.min.js" type="text/javascript"></script>
        <script>
        new WOW().init();
        </script>


	<title>F.A.Qs</title>
</head>
<body class="wow fadeIn">


	<div class="container">
		<div class="row">
			<div class="col">
				<header class="wow bounceInLeft">
					<div id="cd-logo" class="">
							<p class="text-center argames">ArGames</p>
							<footer class="text-white blockquote-footer argames_downtext">this is ArGames, a game company with falopa employees </footer>
					</div>
				</header>

				<div id="cd-nav" class="font-weight-bold ">
					<a href="#0" class="cd-nav-trigger">Menu<span></span></a>
					<nav id="cd-main-nav" >
						<ul class="wow bounceInRight">
							<li><a href="index.php">INICIO</a></li>
							<?php if ($_SESSION['user_login']): ?>
								<li><a href="perfil.php">PERFIL</a></li>
								<li><a href="formulario_ingreso.php">SALIR</a></li>
							<?php else: ?>
								<li><a href="formulario_ingreso.php">INGRESAR</a></li>
								<li><a href="formulario_registro.php">REGISTRARME</a></li>
							<?php endif; ?>
						</ul>
					</nav>
				</div>

			</div>
		</div>
	</div>

			<h2 class="FAQ_text font-weight-bold mb-0 wow jello">F.A.Qs</h2>
			<h2 class="FAQ_SUBTEXT mt-1 mb-5 wow fadeIn">Preguntas frecuentes</h2>

					<!-- <div style="visibility: hidden; position: absolute; width: 0px; height: 0px;">
					  <svg xmlns="http://www.w3.org/2000/svg">
					    <symbol viewBox="0 0 24 24" id="expand-more">
					      <path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z"/><path d="M0 0h24v24H0z" fill="none"/>
					    </symbol>
					    <symbol viewBox="0 0 24 24" id="close">
					      <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/><path d="M0 0h24v24H0z" fill="none"/>
					    </symbol>
					  </svg>
					</div> -->

					 <details class="wow jackInTheBox">  <!--AGREGARLE UN "open" como atributo para que aparezca abierta la tarjeta -->
					  <summary>
					    ¿Que es ArGames?
					    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
					    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
					  </summary>
					  <p class="pt-3">
							Argames es una página de juegos Argentinos, pensada para personas de todas las edades con el objetivo de incentivar la interacción con la cultura argentina a través de juegos propios de la región, como por ejemplo el truco.
						</p>
					</details>

					<details class="wow jackInTheBox">

					  <summary>
					    ¿Como me registro?
					    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
					    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
					  </summary>
					  <p class="pt-3">
							Para registrarte solo tenes que ingresar <a href="formulario_registro.php">ACA</a>, completar todos los campos y listo, ya podes empezar a jugar a través de la página.
						</p>
					</details>

					<details class="wow jackInTheBox">

					  <summary>
					    ¿Como inicio sesion?
					    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
					    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
					  </summary>
					  <p class="pt-3">
							Para poder comenzar a jugar a través de la página tienen que iniciar sesión con un usuario previamente registrado, podes hacerlo debes ingresando <a href="formulario_registro.php">ACA</a> y completar los campos correspondientes y listo!
						</p>
					</details>

					<details class="wow jackInTheBox">
					  <summary>
					    ¿Tengo un problema para iniciar sesión, como puedo solucionarlo?
					    <svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
					    <svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
					  </summary>
					  <p class="pt-3">
							Aun no contamos con sistema de recuperado de cuentas, ingresa <a href="formulario_registro.php">ACA</a> y registrate nuevamente, proximamente lo implementaremos...
						</p>
					</details>


					<details class="wow jackInTheBox">
						<summary>
							¿Puedo jugar online con otra persona?
							<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
							<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
						</summary>
						<p class="pt-3">
							Estamos trabajando en eso! Pronto tendremos noticias.
						</p>
					</details>

					<details class="wow jackInTheBox">
						<summary>
							¿Quién administra ArGames.com?
							<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
							<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
						</summary>
						<p class="pt-3">
							ArGmes.com es administrado por un grupo de programadores.
						</p>
					</details>
					<details class="wow jackInTheBox">
						<summary>
							¿Como cancelar mi cuenta?
							<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
							<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
						</summary>
						<p class="pt-3">
							Para cancelar tu cuenta mandanos un email a <a href="#">argames@consultas.com</a>.
						</p>
					</details>
					<details class="wow jackInTheBox" >
						<summary>
							¿Como puedo enviar una aportacion?
							<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
							<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
						</summary>
						<p class="pt-3">
							Mandanos un correo con tu idea <a href="#">argames@consultas.com</a>.
						</p>
					</details>

					<details class="wow jackInTheBox" >
						<summary>
							¿Como cambiar mi nombre de usuario?
							<svg class="control-icon control-icon-expand" width="24" height="24" role="presentation"></svg>
							<svg class="control-icon control-icon-close" width="24" height="24" role="presentation"></svg>
						</summary>
						<p class="pt-3">
							Para cambiar tu nombre de usuario mandanos un email a <a href="#">argames@consultas.com</a>.
						</p>
					</details>



    	<!--
			<li class="wow pulse">
				<img src="imagenes/thumb.jpg" alt="Preview image">
			</li> -->

			<div class="container pt-5">
				<div class="row mb-3 align-items-center wow fadeInUp">
					<div class="col-lg-10 col-md-9 col-sm-12 text-white">
					 <p class="text-md-left text-center">© <script>document.write(new Date().getFullYear());</script> Todos los derechos reservados. Hecho por <a href="#" class=" text-warning" target="_blank"><span class=" font-weight-bold argames_link">ArGames</span></a></p>
					</div>
					<div class="col-lg-2 col-md-3  col-sm-12 copyrighy_footer justify-content-between d-flex">
						<?php if ($_SESSION['user_login']): ?>
							<a style="border:1.1px solid yellow; letter-spacing:0.2em;" class=" m-1 p-1 btn text-warning faqbutton" href="#" role="button">RANKING</a>
						<?php else: ?>
							<a style="border:1.1px solid yellow; letter-spacing:0.2em;" class=" m-1 p-1 btn text-warning faqbutton" href="index.php" role="button">JUGAR</a>
						<?php endif; ?>
						<a style="border:1.1px solid yellow;" class="m-1 p-1 btn text-warning faqbutton" href="FAQ.html" role="button">F.A.Qs</a>
					</div>
				</div>
			</div>

		<script src="js/jquery-2.1.1.js"></script>
		<script src="js/main.js"></script> <!-- Resource jQuery -->
	</body>
</html>
