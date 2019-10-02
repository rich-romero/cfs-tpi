<?php
  // $categoriasJson = file_get_contents('categorias.json');
  // $categorias = json_decode($categoriasJson, true);

  $name = "";
  $username ="";
  $email = "";
  $edad ="";
  $genre="";
  $password="";
  $usuarios = [];
  $id="";

  $emptyNameError = false;
  $emptyUsernameError = false;
  $invalidEmailError = false;
  $notNumericAgeError = false;
  $emptyGenreError = false;
  $notSetPasswordError = false;
  $confirmPasswordError = false;
  $registeredUsernameError = false;
  $extArchivoError=false;


  if (isset($_POST["submit"])) {

    if (empty($_POST["name"])){
      $emptyNameError = true;
    } else {
      $name=$_POST["name"];
    }
    if (empty($_POST["username"]) || strlen($_POST["username"]) >= 15){
      $emptyUsernameError = true;
    } else {
      $username=$_POST["username"];
    }
    if (empty($_POST["email"]) || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
      $invalidEmailError = true;
    }else {
      $email = $_POST["email"];
    }
    if (empty($_POST["edad"]) || !is_numeric($_POST["edad"])){
      $notNumericAgeError = true;
    } else {
      $edad=$_POST["edad"];
    }

    if (empty($_POST["gen"])){
      $emptyGenreError = true;
    }else{
      $genre=$_POST["gen"];
    }

    if (empty($_POST["password"])) {
      $notSetPasswordError = true;
    } elseif (empty($_POST["confirm_password"]) || $_POST["password"]!= $_POST["confirm_password"] ) {
      $confirmPasswordError = true;
    } else {
      $password = $_POST["password"];
    }


    if (file_exists("json/usuarios.json")) {
      $usuariosJson=file_get_contents('json/usuarios.json');
      $usuarios=json_decode($usuariosJson,true);
      $posUltUser=count($usuarios["usuarios"]);

      if (is_null($posUltUser)|| $posUltUser==0) {
        $usuarios["id"]=0;
      }else{
        $ultId=$usuarios["usuarios"][$posUltUser-1]["id"];
        $usuarios["id"]=$ultId+1;
      }
      foreach ($usuarios["usuarios"] as $us) {
        if ($us["username"] == $username) {
          $registeredUsernameError = true;
          break;
        }
      }
    }else {
      $usuarios["id"]=0;
    }
    $id=$usuarios["id"];

    if ($_FILES["imagen"]["error"]===UPLOAD_ERR_OK) {
      $nombre=$_FILES["imagen"]["name"];
      $archivoTmp=$_FILES["imagen"]["tmp_name"];
      $ext=pathinfo($nombre,PATHINFO_EXTENSION);
      $tipoImg=["jpg","png","bmp","JPG","gif"];
      if (in_array($ext,$tipoImg)) {
        $miArchivo=dirname(__FILE__) . "/" . "archivos_subidos/$id." . $ext;
        /*if(file_exists($miArchivo)){
          $subirArchivoError=true;
          echo "el archivo ya existe en el repo";*/
      }else{
          $extArchivoError=true;
      }
    }
    /*
    Guardaremos los usuarios en el archivo usuarios.json. Si el archivo existe,
    leemos el contenido del archivo, lo decodificamos y lo cargamos en el array usuarios.
    Si el archivo no existe, creamos un array vacio con el mismo nombre.
    */



    // Evaluamos si no se produjo ningún error. Si esto es así, procedemos a procesar la información del formulario
    if (!$emptyNameError && !$invalidEmailError && !$notNumericAgeError && !$emptyInterestError && !$emptyGenreError && !$notSetPasswordError && !$confirmPasswordError && !$registeredUsernameError && !$extArchivoError) {
      // Encriptamos la contraseña
      $md5Pass = md5($password);
      move_uploaded_file($archivoTmp,$miArchivo);
      echo "El archivo se subio con exito";
      $usuario = [
        "name"=>$name,
        "email"=>$email,
        "username" => $username,
        "edad"=>$edad,
        "gen"=>$genre,
        "password"=>$md5Pass,
        "id"=>$id,
        "ext_foto"=>$ext
      ];
      $usuarios["usuarios"][]=$usuario;
      $usuariosJson = json_encode($usuarios,JSON_PRETTY_PRINT);
      file_put_contents('json/usuarios.json',$usuariosJson);
      move_uploaded_file($archivoTmp,$miArchivo);

      header("Location:index.html");
      exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Registrarme</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700&display=swap" rel="stylesheet">

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

  <div class="col-xl-4 col-lg-5 col-md-12 ">
		<div class="container">

      <div class="row wow rubberBand">
				<p class=" text-center argames ">ArGames</p>
		    <footer class="blockquote-footer argames_downtext">this is argames, an argentinian games page</footer>
			</div>

			<div class="row">
				<img src="imagenes/balls_colision.gif" class="img-fluid mt-4 float-left" alt="imagen_de_un_metegol" height="">
			</div>


			</div>



  </div>

  <div class="col-xl-4 col-lg-2 col-md-2"></div>

  <div class="col-xl-4 col-lg-5 col-md-10 ">

    <form id="contact-stack-form" class="form wow slideInRight" action='' method='post' enctype="multipart/form-data">
        <div class="cube-1 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-2 w-100 cube">
          <div class="front">
            <label for="name" class="label">Nombre</label>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-3 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-4 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-5 w-300 cube">
          <div class="front">
            <input type="text" name="name" value='<?= $name ?>' maxlength="50" id="name" placeholder="Tu nombre" class="field">
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

              <!-- RESERVADO PARA VALIDACIONES -->
          <?php if ($emptyNameError): ?>
            <div class="cube-31 w-300 cube text-center wow slideInRight">
              <div class="front">
                <p class="pt-2  texto_validacion">¡Nombre vacio!</p>
              </div>
              <div class="back"></div>
              <div class="top"></div>
              <div class="bottom"></div>
              <div class="left"></div>
              <div class="right"></div>
            </div>
          <?php endif; ?>
            <!-- RESERVADO PARA VALIDACIONES -->

        <div class="cube-6 w-180 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <div class="cube-8 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-9 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-10 w-100 cube">
          <div class="front">
            <label for="email" class="label">Usuario</label>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-11 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-12 w-300 cube">
          <div class="front">
            <input type="text" name="username" value='<?= $username?>' maxlength="50" id="username" placeholder="Un nombre de usuario" class="field">
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($emptyUsernameError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡Nombre de usuario vacio!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->

        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($registeredUsernameError): ?>
          <div class="cube-31 w-300 cube text-center wow slideInRight">
            <div class="front">
              <p class="pt-2  texto_validacion">¡El nombre de usuario ya existe!</p>
            </div>
            <div class="back"></div>
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="left"></div>
            <div class="right"></div>
          </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->


        <div class="cube-13 w-100 cube">
        <div class="top"></div>
        </div>
        <div class="cube-14 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-15 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>




        <div class="cube-10 w-100 cube">
        <div class="front">
        <label for="email" class="label" style="text-align:center;">Email</label>
        </div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-11 w-300 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-12 w-300 cube">
        <div class="front">
          <input type="email" name="email" value='<?= $email?>' maxlength="50" id="email" placeholder="Un correo electronico" class="field">
        </div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right">
        </div>
        </div>
        <div class="cube-23 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($invalidEmailError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡El formato del email es invalido!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->
        <div class="cube-24 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-25 w-100 cube">
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        </div>
        <div class="cube-29 w-300 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-30 w-300 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>

        <div class="cube-1 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-2 w-100 cube">
        <div class="front">
        <label for="name" class="label">Genero</label>
        </div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-3 w-100 cube">
        <div class="front"></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-13 w-100 cube">
        <div class="front"><label for="varon" class="label" style="text-align:center;">Varon &nbsp;<input class="radio_boton" type="radio" name="gen" value="v"<?= ($genre == "v")?"checked":"" ?>></label></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-14 w-100 cube">
        <div class="front"><label for="mujer" class="label" style="text-align:center;">Mujer &nbsp;<input class="radio_boton" type="radio" name="gen" value="m"<?= ($genre == "m")?"checked":"" ?>></label></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>
        <div class="cube-15 w-100 cube">
        <div class="front"><label for="otro" class="label" style="text-align:center;">Otro &nbsp;<input class="radio_boton" type="radio" name="gen" value="o"<?= ($genre == "o")?"checked":"" ?>></label></div>
        <div class="back"></div>
        <div class="top"></div>
        <div class="bottom"></div>
        <div class="left"></div>
        <div class="right"></div>
        </div>

        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($notNumericAgeError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡Debe indicar un genero!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->


        <div class="cube-2 w-100 cube">
        <div class="front">
        <label for="edad" class="label">Edad</label>
        </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-3 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <div class="cube-2 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-24 w-100 cube">
            <div class="front"><input type="number" name="edad" value="<?= $edad?>" class="field" placeholder="Tu edad" require></div>
            <div class="back"></div>
            <div class="top"></div>
            <div class="bottom"></div>
            <div class="left"></div>
            <div class="right"></div>
        </div>
        <div class="cube-3 w-100 cube">
        </div>
        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($notNumericAgeError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡La edad debe ser de tipo numerica!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->
        <div class="cube-1 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-2 w-100 cube">
          <div class="front">
            <label for="name" class="label">Foto</label>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-3 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <div class="cube-5 w-300 cube">
          <div class="front custom-file">
            <div class="custom-file mt-2 ">
              <input type="file" name="imagen" style="background-color:#f5a741; border:none;"  class="custom-file-input" id="customFileLang" lang="es"/>
              <label class="custom-file-label " style="background:#f5a741;color:black; margin-right: 10px;border:none;" for="customFileLang">Seleccionar foto de perfil</label>
            </div>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($extArchivoError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡El formato del archivo es incorrecto!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->

        <div class="cube-2 w-100 cube">
          <div class="front">
          <label for="name" class="label">Contraseña</label>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>


        <div class="cube-3 w-100 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>


        <div class="cube-4 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-5 w-300 cube">
          <div class="front">
            <input type="password" name="password" id="password" placeholder="Una contraseña" class="field">
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <!-- RESERVADO PARA VALIDACIONES -->
        <?php if ($notSetPasswordError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front">
            <p class="pt-2  texto_validacion">¡Debe indicar una contraseña!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->

        <div class="cube-26 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <div class="cube-28 w-100 cube">
          <div class="front">
          <label for="confirmar" class="label">Confirmar</label>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-29 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-30 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <div class="cube-5 w-300 cube">
          <div class="front">
          <input type='password' name='confirm_password' id="confirmar" placeholder="Confirmar contraseña" class="field">
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php if ($confirmPasswordError): ?>
        <div class="cube-31 w-300 cube text-center wow slideInRight">
          <div class="front ">
            <p class="pt-2 texto_validacion">¡Debe indicar una contraseña!</p>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>
        <?php endif; ?>
        <!-- RESERVADO PARA VALIDACIONES -->

        <div class="cube-32 w-300 cube">
          <div class="front"></div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
        </div>

        <div class="cube-33 w-300 cube">
          <div class="front">
            <button type="submit" name="submit" value="enviar" id="contact-stack-button" class="button">registrarme</button>
          </div>
          <div class="back"></div>
          <div class="top"></div>
          <div class="bottom"></div>
          <div class="left"></div>
          <div class="right"></div>
          </div>
          </form>
        </div>

        <div class=" container">
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


    <div class="destroy_button" style="">
      <a href="pagina_boton_secreto.html">SECRET</a>
    </div>


  </body>
</html>
