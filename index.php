<?php
	session_start();

?>
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
		<script src="js/modernizr.js"></script>
		<script src="js/wow.min.js" type="text/javascript"></script>
	        <script>
	        new WOW().init();
	        </script>


		<title>Inicio</title>
	</head>
	<body class="wow fadeIn">

		<div id="welcome_card" class="wow fadeInDown bg-white">
			<p class="">BIENVENID<?=($_SESSION['genero'] == "v")? "O" : (($_SESSION['genero'] == "m")? "A":"E"); ?>  <?=$_SESSION['username'] ?></p>
		</div>
		<div class="container pb-5">
			<div class="row">
				<div class="col">
					<header class="wow bounceInLeft">
						<div id="cd-logo" class="">
								<p class="text-center argames">ArGames</p>
								<footer class="text-white blockquote-footer argames_downtext">this is ArGames, a game company with falopa employees </footer>
						</div>
					</header>

					<div id="cd-nav" class="font-weight-bold">
						<a href="#0" class="cd-nav-trigger">Menu<span></span></a>
						<nav id="cd-main-nav">
							<ul class="wow bounceInRight">
								<li ><a href="#cd-logo">INICIO</a></li>
								<li><a href="FAQ.php">F.A.Qs</a></li>
								<?php if ($_SESSION['user_login']): ?>
									<li><a href="perfil.php">PERFIL</a></li>
									<li> <a href="destroy_session.php">SALIR</a></li>
								<?php else: ?>
									<li><a href="formulario_ingreso.php">INGRESAR</a></li>
								<?php endif; ?>

							</ul>
						</nav>
					</div>

				</div>
			</div>
		</div>

		<main>
			<ul id="cd-gallery-items" class="cd-container ">

				<a href="juegos/pacman/index.html" class="anchor_img_game">
					<li class="wow pulse " style="background-image:url('imagenes/pacman_imagen_edit.webp');">
						<div class="container-games">
							<img src="imagenes/transparente.png" alt="Avatar" class="image">
								<div class="overlay container-fluid">
									<div class="row text-left text_game">
										<div class="col-12 font-weight-bold text-1">PAC MAN</div>
										<div class="col-12 text-2">This is Pacman</div>
									</div>

								</div>
					</li>
				</a>
				<a href="juegos/truco/index.html" class="anchor_img_game" >
					<li class="wow pulse" style="background-image:url('imagenes/truco_imagen_edit.jpg'); ">

						<div class="container-games">
							<img src="imagenes/transparente.png" alt="Avatar" class="image">
								<div class="overlay container-fluid">
										<div class="row text-left text_game">
											<div class="col-12 font-weight-bold text-1">TRUCO</div>
											<div class="col-12 text-2">Quier re truco!</div>
										</div>
								</div>
							</div>
					</li>
				</a>

			<a href="juegos/ahorcado/ahorcado_inicio.php" class="anchor_img_game ">
				<li class="wow pulse"	style="background-image:url('imagenes/ahorcado_imagen_edit.webp');">
					<div class="container-games">
						<img src="imagenes/transparente.png" alt="Avatar" class="image">
							<div class="overlay container-fluid">
								<div class="row text-left text_game">
									<div class="col-12 font-weight-bold text-1">AHORCADO</div>
									<div class="col-12 text-2">Adivina la palabra</div>
								</div>
							</div>
				</li>
			</a>

			<a href="juegos/ajedrez/example.html" class=" anchor_img_game">
				<li class="wow pulse" style="background-image:url('imagenes/ajedrez_imagen_edit.jpg'); ">

					<div class="container-games">
						<img src="imagenes/transparente.png" alt="Avatar" class="image">
							<div class="overlay container-fluid">
								<div class="row text-left text_game">
									<div class="col-12 font-weight-bold text-1">AJEDREZ</div>
									<div class="col-12 text-2">Maravillosa jugada</div>
								</div>
							</div>
				</li>
			</a>
			<a href="juegos/damas/index.html" class=" anchor_img_game">
				<li class="wow pulse" style="background-image:url('imagenes/damas.jpg'); ">

					<div class="container-games">
						<img src="imagenes/transparente.png" alt="Avatar" class="image">
							<div class="overlay container-fluid">
								<div class="row text-left text_game">
									<div class="col-12 font-weight-bold text-1">DAMAS</div>
									<div class="col-12 text-2">Comer o se comido</div>
								</div>

							</div>

				</li>
			</a>

			</div>
			<a href="juegos/tateti_multi/tateti.html" class=" anchor_img_game">
				<li class="wow pulse" style="background-image:url('imagenes/tateti.jpg'); ">

					<div class="container-games">
						<img src="imagenes/transparente.png" alt="Avatar" class="image">
							<div class="overlay container-fluid">
								<div class="row text-left text_game">
									<div class="col-12 font-weight-bold text-1">TATETI</div>
									<div class="col-12 text-2">Suerte para mi</div>
								</div>
							</div>

				</li>
			</a>

			</ul>
		</main>
		<div class="container">
			<div class="row mb-3 align-items-center wow fadeInUp">
				<div class="col-lg-10 col-md-9 col-sm-12 text-white">
				 <p class="text-md-left text-center">© <script>document.write(new Date().getFullYear());</script> Todos los derechos reservados. Hecho por <a href="#" class=" text-warning" target="_blank"><span class=" font-weight-bold argames_link">ArGames</span></a></p>
				</div>
				<div class="col-lg-2 col-md-3  col-sm-12 copyrighy_footer justify-content-between d-flex">
					<a style="border:1.1px solid yellow; letter-spacing:0.2em;" class=" m-1 p-1 btn text-warning faqbutton" href="#" role="button">RANKING</a>
					<a style="border:1.1px solid yellow;" class="m-1 p-1 btn text-warning faqbutton" href="FAQ.php" role="button">F.A.Qs</a>
				</div>
			</div>
		</div>

		<script>
					document.getElementById("welcome_card").style.display="block";
					setTimeout(function(){
						document.getElementById("welcome_card").style.display="block";
					var d = document.getElementById("welcome_card");
					d.className = "hinge";
					document.getElementById("welcome_card").style.display="none";
				}, 3000);

		</script>

			<script src="js/jquery-2.1.1.js"></script>
			<script src="js/main.js"></script>
	</body>
</html>
