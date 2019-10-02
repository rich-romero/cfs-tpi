<?php

  session_start();

  if ($_SESSION['user_login']) {
    header('Location:index.php');
    exit;
  }

  $username=NULL;

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
  $_SESSION['user_login']=false;
  if (empty($_POST['username'])) {
    $usuarioVacioError= true;
  }else {
    $username =$_POST['username'];
  }
  if (empty($_POST['password'])){
    $encontraseñaVaciaError= true;
  }else {
    $contraseña=$_POST['password'];
  }

  $archivo = 'json/usuarios.json';

  if (file_exists($archivo)){
    $usuariosJson = file_get_contents($archivo);
    $usuarios = json_decode($usuariosJson,true);
    $usuarioExiste = false;
    foreach ($usuarios['usuarios'] as $usuario){
      if ($usuario['username'] == $username) {
        $usuarioExiste = true;
        $contraseñaEncriptada = md5($contraseña);
        if ($usuario['password'] == $contraseñaEncriptada){
          $_SESSION['id']=$usuario['id'];
          $_SESSION['username']=$_POST['username'];
          $_SESSION['password']=$_POST['password'];
          $_SESSION['genero']=$usuario['gen'];
          if($_POST['recordarme']=="on"){
            $_SESSION['recordarme']=true;
            setcookie('remember_username', $_SESSION['username'], time()+(10 * 365 * 24 * 60 * 60));
            setcookie('remember_password', $_SESSION['password'], time()+(10 * 365 * 24 * 60 * 60));
          }else{
            setcookie('remember_username', NULL, time()-1);
            setcookie('remember_password', NULL, time()-1);
          }
          $_SESSION['user_login']=true;
          header('Location:index.php');
          exit;
        }else {
          $contraseñaIncorrectaError = true;
          break;
        }
      }
    }

    if (!$usuarioExiste) {
      $usuarioNoExisteError= true;
    }
  }else{
    echo "ERROR 505";
    exit;
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

			<div class="row align-items-center">

				<div  class="col-xl-4 col-lg-5 col-md-12 wow rubberBand ">
					<p class="text-center argames">ArGames</p>
					<footer class="text-lg-left text-sm-center blockquote-footer argames_downtext">this is ArGames, a game company with falopa employees </footer>
				</div>

				<div class="col-xl-4 col-lg-2 col-md-2"></div>

      		<div class="col-xl-4 col-lg-5 col-md-10 ">

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
            	<?php if (isset($usuarioVacioError)): ?>
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
            	<?php if (isset($usuarioNoExisteError)): ?>
            		<div class=" cube-31 w-300 cube">
            			<div class=" front text-center">
            				<p class=" pt-1 mt-2 texto_validacion">¡El usuario no existe!</p>
            			</div>
            			<div class=" back"></div>
            			<div class=" top"></div>
            			<div class=" bottom"></div>
            			<div class=" left"></div>
            			<div class=" right"></div>
            		</div>
            	<?php endif; ?>
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
            	<div class=" cube-10 w-100 cube">
            		<div class=" front">
            			<label for="contraseña" class=" label">Contraseña</label>
            		</div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"><label for="contraseña" class=" label">Contraseña</label></div>
            	</div>
            	<div class=" cube-11 w-300 cube">
            		<div class=" front"></div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"></div>
            	</div>
            	<div class=" cube-12 w-300 cube">
            		<div class=" front">
            			<input type="password" value="<?=empty($_COOKIE['remember_password'])? NULL:$_COOKIE['remember_password'] ?>"name="password" id="password" placeholder="Tu contraseña" class=" field">
            		</div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right">
            		</div>
            	</div>
              <div class=" cube-17 w-300 cube">
                <div class=" front"></div>
                <div class=" back"></div>
                <div class=" top"></div>
                <div class=" bottom"></div>
                <div class=" left"></div>
                <div class=" right"></div>
              </div>
              <div class="cube-12 w-300 cube">
                <div class="front p-2" >
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="recordarme" class="custom-control-input" id="customControlValidation1" <?=$_COOKIE['remember_username']!="" ?"checked": ""; ?>>
                    <label style="color:rgba(73, 73, 73, 0.84);" class="custom-control-label label mt-1" for="customControlValidation1">
                      RECORDARME
                    </label>
                  </div>
                </div>
                <div class=" back"></div>
                <div class=" top"></div>
                <div class=" bottom"></div>
                <div class=" left"></div>
                <div class=" right">
                </div>
              </div>

          		<?php if (isset($contraseñaIncorrectaError)): ?>
          			<div class=" cube-31 w-300 cube">
          				<div class=" front text-center" >
          					<p class=" pt-1 mt-2  texto_validacion">¡contraseña incorrecta!</p>
          				</div>
          				<div class=" back"></div>
          				<div class=" top"></div>
          				<div class=" bottom"></div>
          				<div class=" left"></div>
          				<div class=" right"></div>
          			</div>
          		  <?php endif; ?>
            	<div class=" cube-16 w-300 cube">
            		<div class=" front"></div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"></div>
            	</div>
            	<div class=" cube-17 w-300 cube">
            		<div class=" front"></div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"></div>
            	</div>
            	<div class="cube-26 w-300 cube">

            		<div class="front font-weight-bold text-center pt-2" style="background-color:#f2d357; ">
                      <a  style="color:rgb(77, 77, 77); text-decoration:none;" href="recover_pass.php">¿TE OLVIDASTE LA CONTRASEÑA?</a>
                </div>
            		<div class="back"></div>
            		<div class="top"></div>
            		<div class="bottom"></div>
            		<div class="left"></div>
            		<div class="right" style="background-color:#ab9955;"></div>
            	</div>


              <div class=" cube-10 w-100 cube font-weight-bold">
                <div class=" front">
                  <a href="formulario_registro.php">
                    <button id="contact-stack-button" style="background-color:grey; color:white; font-size:1em;" type="button" class=" button">REGISTRO</button>
                  </a>
              </div>
                <div class=" back"></div>
                <div class=" top"></div>
                <div class=" bottom"></div>
                <div class=" left"></div>
                <div class=" right">
                  <a href="formulario_registro.php"><button id="contact-stack-button" style="background-color:grey; color:white; font-size:1.5em;" type="button" class=" button">REGISTRO</button></a>
                </div>
              </div>
            	<div class=" cube-1 w-100 cube">
            		<div class=" front"></div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"></div>
            	</div>
            	<div class=" cube-30 w-300 cube">
            		<div class=" front"></div>
            		<div class=" back"></div>
            		<div class=" top"></div>
            		<div class=" bottom"></div>
            		<div class=" left"></div>
            		<div class=" right"></div>
            	</div>
            	<div class=" cube-33 w-300 cube font-weight-bold">
            			<div class=" front">
            				<button type="submit" name="submit" id="contact-stack-button" value="enviar" class=" button">Ingresar</button>
            			</div>
            			<div class=" back"></div>
            			<div class=" top"></div>
            			<div class=" bottom"></div>
            			<div class=" left"></div>
            			<div class=" right">
            			<button type="submit" name="submit" value="enviar" id="contact-stack-button" style="background-color:red; color:yellow; font-size:1.5em;" class=" button">ENTRAR</button>
            			</div>
            		</div>
            </form>
        </div>

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

    	</div>
    </div>



    <div class=" destroy_button" ><a href="pagina_boton_secreto.html">SECRET</a></div>

  </body>
</html>
