<?php
  session_start();


  if (!$_SESSION['user_login']) {   // ESTE SCRIPT SE FIJA SI EL USUARIO ESTA LOGEADO, EN CASO DE QUE NO LO REDIRECCIONA A QUE INGRESE
    header('Location:formulario_ingreso.php');
    exit;
  }

   $Editar = (isset($_POST['editar_perfil']) && !empty($_POST['editar_perfil']))? true:false;
   $AceptarEdicion = (isset($_POST['aceptar_edicion']) && !empty($_POST['aceptar_edicion']))? true:false;

   $usuarios = [];

   if (file_exists("json/usuarios.json")){
     $usuariosJson=file_get_contents('json/usuarios.json');
     $usuarios=json_decode($usuariosJson,true);

   }else{
     echo "THE DATA BASE IS BROCKEN, PLEASE GO THE HELL";
     exit;
   }
   $id=$_SESSION['id'];
   $name = $usuarios['usuarios'][$id]['name'];
   $username = $usuarios['usuarios'][$id]['username'];
   $email = $usuarios['usuarios'][$id]['email'];
   $edad = $usuarios['usuarios'][$id]['edad'];
   $genre= $usuarios['usuarios'][$id]['gen'];
   $password= $usuarios['usuarios'][$id]['password'];

   $emptyUsernameError = false;
   $invalidEmailError = false;
   $notNumericAgeError = false;
   $emptyGenreError = false;
   $confirmPasswordError = false;
   $registeredUsernameError = false;
   $extArchivoError=false;

   if ($AceptarEdicion){

     foreach ($usuarios['usuarios'] as $usuario) {
        if ($usuarios['usuarios'][$id]['username'] != $_POST['username']) {
          if($usuario['username'] == $_POST['username']){
              $registeredUsernameError = true;
            }
         }
     }
     if (!empty($_POST["name"])){
       $name=$_POST["name"];
     }
      if (strlen($_POST["username"]) >= 15) {
        $emptyUsernameError = true;
      }elseif(!empty($_POST["username"])){
        $username=$_POST["username"];
     }
     if (!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)) {
       $invalidEmailError = true;
     }elseif(!empty($_POST["email"]) ){
       $email = $_POST["email"];
     }
     if (!is_numeric($_POST["edad"])) {
       $notNumericAgeError = true;
     }elseif(!empty($_POST["edad"])){
        $edad=$_POST["edad"];
     }
     if (!empty($_POST["gen"])){
       $genre=$_POST["gen"];
     }
     if (!empty($_POST["password"]) ) {
       if (empty($_POST["confirm_password"]) || $_POST["password"]!= $_POST["confirm_password"] ) {
         $confirmPasswordError = true;
       } else {
         $password = md5($_POST["password"]);
       }
     }

     if ($_FILES["imagen"]["error"]===UPLOAD_ERR_OK) {
       $nombre=$_FILES["imagen"]["name"];
       $archivoTmp=$_FILES["imagen"]["tmp_name"];
       $ext=pathinfo($nombre,PATHINFO_EXTENSION);
       $tipoImg=["jpg","png","bmp","JPG","gif"];
       if (in_array($ext,$tipoImg)) {
         $miArchivo=dirname(__FILE__) . "/" . "archivos_subidos/$id." . $ext;
       }else{
           $extArchivoError=true;
       }
     }

     if (!$extArchivoError && !$emptyNameError && !$invalidEmailError && !$notNumericAgeError && !$emptyGenreError && !$confirmPasswordError && !$registeredUsernameError) {

       move_uploaded_file($archivoTmp,$miArchivo);
       echo "El archivo se subio con exito";
           $usuarios['usuarios'][$_SESSION['id']]['name']=$name;
           $usuarios['usuarios'][$id]['email']=$email;
           $usuarios['usuarios'][$id]['username']=$username;
           $usuarios['usuarios'][$id]['gen']=$genre;
           $usuarios['usuarios'][$id]['edad']=$edad;
           $usuarios['usuarios'][$id]['password']=$password;

         if ($_POST['recordarme']!="on"){
           $_SESSION['recordarme']=false;
           setcookie('remember_username', NULL, time()-1);
           setcookie('remember_password', NULL, time()-1);
        }else{
          $_SESSION['recordarme']=true;
          setcookie('remember_username', $username, time()+(10 * 365 * 24 * 60 * 60));
         if (empty($_POST['password'])){
           setcookie('remember_password', $_SESSION['password'], time()+(10 * 365 * 24 * 60 * 60));
         }else{
           setcookie('remember_password', $_POST['password'], time()+(10 * 365 * 24 * 60 * 60));
         }
        }

       $usuariosJson = json_encode($usuarios,JSON_PRETTY_PRINT);
       file_put_contents('json/usuarios.json',$usuariosJson);

     }else{
       $Editar=true;

     }
   }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css">
		<link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/profile.css">
		<link rel="stylesheet" href="css/animate.css">
		<script src="js/modernizr.js"></script>
		<script src="js/wow.min.js" type="text/javascript"></script>
	        <script>
	        new WOW().init();
	        </script>
    <title>Mi perfil</title>
  </head>
  <body class="wow fadeIn">

    <div class="container pb-0">
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
              <ul class="">
                <li ><a href="index.php">INICIO</a></li>
                  <li> <a href="destroy_session.php">SALIR</a></li>
              </ul>
            </nav>
          </div>

        </div>
      </div>
    </div>


    <div class="container emp-profile mt-md-0 wow flipInY">

          <form method="post" enctype="multipart/form-data">
              <div class="row">

                  <div class="col-lg-4">
                          <div class="profile-img mt-md-5 wow swing">
                              <img src="archivos_subidos/<?=$id . "." . $usuarios['usuarios'][$id]['ext_foto']?>" class="" alt=""/><!-- FALTA AGREGAR ALGO-->
                          </div>

                    <?php if ($Editar): ?>
                          <div class="file btn btn-lg btn-primary">
                              Cambiar foto
                            <input type="file" name="imagen" class="btn btn-warning"/>
                            <?=$extArchivoError? "Error al subir la foto": ""; ?>
                          </div>
                    <?php endif; ?>
                  </div>
                  <div class="col-lg-6">
                      <div class="profile-head  ">
                                  <h5 class="">
                                      <?=$username ?>
                                  </h5>
                                  <h6>
                                    Senior   <!--TIPO DE JUGADOR, DEPENDE DE LAS VARIABLES "TIEMPO JUGADO", "SCORE". TRAINEE/JUNIOR/SEMI SENIO/SENIOR  -->
                                  </h6>
                                  <p class="proile-rating">RANKING: <span>8/10</span></p> <!-- HACER UNA SUMA DE TODOS LOS SCORE Y CALCULAR RANKING-->
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mis datos</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Mi rank</a>
                              </li>

                          </ul>
                      </div>
                      <div class="col-md-12">
                          <div class="tab-content profile-tab " id="myTabContent">

                              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6 ">
                                                  <label>ID Usuario</label>
                                              </div>
                                              <div class="col-md-6 ">
                                                  <?=$id?>
                                              </div>
                                          </div>
                                          <div class="row ">
                                              <div class="col-md-6 ">
                                                  <label>Nombre de usuario</label>
                                              </div>
                                              <div class="col-md-6 ">
                                                <?php if ($Editar): ?>
                                                  <input type="text" name="username" class="input_editar" value="<?=$username?>"><?=$registeredUsernameError ? "El nombre de usuario ingresado ya exixste!":"";  ?>
                                                  <?php else: ?>
                                                    <p><?=$username?></p>
                                                <?php endif; ?>

                                              </div>
                                          </div>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Nombre</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                  <input type="text" name="name" class="input_editar" value="<?=$name?>"><?=$emptyNameError ? "El nombre ingresado supera los 15 caracteres!":"";  ?>
                                                  <?php else: ?>
                                                    <p><?=$name?></p>
                                                <?php endif; ?>
                                              </div>
                                          </div>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Email</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                  <input type="text" name="email" class="input_editar" value="<?=$email?>"><?=$invalidEmailError ? "El email no es correcto!":"";  ?>
                                                  <?php else: ?>
                                                    <p><?=$email?></p>
                                                <?php endif; ?>
                                              </div>
                                          </div>

                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Genero</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                  <input class="radio_boton" type="radio" name="gen" value="v"<?= ($genre == "v")?"checked":"" ?>> Varon&nbsp;
                                                  <input class="radio_boton" type="radio" name="gen" value="m"<?= ($genre == "m")?"checked":"" ?>> Mujer&nbsp;
                                                  <input class="radio_boton" type="radio" name="gen" value="o"<?= ($genre == "o")?"checked":"" ?>> Otro
                                                  <?php else: ?>
                                                    <p><?=($genre == "v")? "Varon" : (($genre == "m")? "Mujer":"Otro"); ?> </p>
                                                <?php endif; ?>
                                              </div>
                                          </div>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Edad</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                  <input type="number" name="edad" class="input_editar" value="<?=$edad?>"><?=$notNumericAgeError ? "La edad debe ser numerica!":"";  ?>
                                                  <?php else: ?>
                                                    <p><?=$edad ?></p>
                                                <?php endif; ?>
                                              </div>
                                          </div>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6 pb-2">
                                                  <label>Recordarme</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                  <input type="checkbox" name="recordarme" <?=$_COOKIE['remember_username']!=NULL ? "checked":"";?>>
                                                  <?php else: ?>
                                                    <?php if ($_SESSION['recordarme']): ?>
                                                      <input type="checkbox" class=" mt-2 mb-3" checked disabled>
                                                      <?php else: ?>
                                                        <input type="checkbox" disabled>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                              </div>
                                          </div>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Contraseña</label>
                                              </div>
                                              <div class="col-md-6">
                                                <?php if ($Editar): ?>
                                                    <input type="password" name="password" class="input_editar">
                                                  <?php else: ?>
                                                    <p>&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;</p>
                                                <?php endif; ?>
                                              </div>
                                          </div>
                                        <?php if ($Editar): ?>
                                          <div class="row wow fadeInUp">
                                              <div class="col-md-6">
                                                  <label>Confirmar contraseña</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <input type="password" name="confirm_password" class="input_editar" value="">
                                                  <?= $confirmPasswordError?"Las contraseñas no coinciden":""; ?>
                                              </div>
                                          </div>
                                        <?php endif; ?>
                                        </div>


                              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Experiencia</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>Senior</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Tiempo jugado</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>01:03:30</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Veces jugadas</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>7</p>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <label>Veces ingresadas</label>
                                              </div>
                                              <div class="col-md-6">
                                                  <p>32</p>
                                              </div>
                                          </div>

                              </div>

                          </div>
                      </div>
                  </div>
                  <div class="col-lg-2 text-center wow bounceInLeft">
                  <?php if (isset($_POST['editar_perfil']) && !empty($_POST['editar_perfil'])): ?>
                      <input type="submit" class="profile-edit-btn mt-3 mb-2" name="aceptar_edicion" value="ACEPTAR"/>
                    <?php else: ?>
                      <input type="submit" class="profile-edit-btn mt-3 mb-2" name="editar_perfil" value="EDITAR"/>
                    <?php endif; ?>
                  </div>
              </div>

              <!-- <div class="row">
                  <div class="col-md-4">
                      <div class="profile-work">
                          <p>WORK LINK</p>
                          <a href="">Website Link</a><br/>
                          <a href="">Bootsnipp Profile</a><br/>
                          <a href="">Bootply Profile</a>
                          <p>SKILLS</p>
                          <a href="">Web Designer</a><br/>
                          <a href="">Web Developer</a><br/>
                          <a href="">WordPress</a><br/>
                          <a href="">WooCommerce</a><br/>
                          <a href="">PHP, .Net</a><br/>
                      </div>
                  </div>
              </div> -->
          </form>
      </div>




      <div class="container">
        <div class="row mb-3 align-items-center wow fadeInUp">
          <div class="col-lg-10 col-md-9 col-sm-12 text-white">
           <p class="text-md-left text-center">© <script>document.write(new Date().getFullYear());</script> Todos los derechos reservados. Hecho por <a href="#" class=" text-warning" target="_blank"><span class=" font-weight-bold argames_link">ArGames</span></a></p>
          </div>
          <div class="col-lg-2 col-md-3  col-sm-12 copyrighy_footer justify-content-between d-flex">
            <a style="border:1.1px solid yellow; letter-spacing:0.2em;" class=" m-1 p-1 btn text-warning faqbutton" href="#" role="button">RANKING</a>
            <a style="border:1.1px solid yellow;" class="m-1 p-1 btn text-warning faqbutton" href="FAQ.html" role="button">F.A.Qs</a>
          </div>
        </div>

      </div>










    <!-- <form action="index.html" method="post">
       if ($cookieDelete):
        <label for="borrar_cookie"></label>
        <input type="text" name="" value="">

    </form> -->




    <script src="js/jquery-2.1.1.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
