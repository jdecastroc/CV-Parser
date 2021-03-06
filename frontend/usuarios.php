<!DOCTYPE html>
<html dir="ltr" lang="es">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="jdecastroc" />

    <!-- Stylesheets
	============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="style.min.css" type="text/css" />
    <link rel="stylesheet" href="css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="css/dark.min.css" type="text/css" />
    <link rel="stylesheet" href="css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="css/animate.min.css" type="text/css" />
    <link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />

    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

    <title>Everis - Gestión de repositorio</title>

</head>

<?php
	session_start();
  require 'database.php';
  require 'functions.php';
  $lang = "es";
	$allowed = false;
  if((isset($_SESSION["usuario"]) && isset($_SESSION["password"])) && $_SESSION["permisos"] == "administrador")
  {
      $usuario = $_SESSION["usuario"];
      $password = $_SESSION["password"];
			$db = mysqli_connect('hugofs.com','root','universal','everis_cv') or die('Error conectando al servidor de base de datos.');

			$query = "SELECT * FROM usuarios";
			$result = mysqli_query($db, $query);
			while ($row = mysqli_fetch_array($result)) {
				if (($usuario == $row['nombre']) && ($password ==  $row['password'])){
					$allowed = true;
					$nombre_db = $row['nombre'];
					$password_db = $row['password'];
					$permisos_db = $row['permisos'];
				}
			}
  }
?>

<body class="stretched side-header">
    <div id="wrapper" class="clearfix">
      <header id="header" class="no-sticky">

  			<div id="header-wrap">

  				<div class="container clearfix">

  					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

  					<!-- Logo
  					============================================= -->
  					<div id="logo" class="nobottomborder">
  						<a href="index.php" class="standard-logo" data-dark-logo="img/logo-everis.png"><img src="img/logo-everis.png" alt="Everis logo"></a>
  					</div><!-- #logo end -->

  					<!-- Primary Navigation
  					============================================= -->
  					<nav id="primary-menu">
  						<ul>
  							<li><a href="index.php"><div>Índice</div></a></li>
  							<li><a href="gestor.php"><div>Gestión de repositorio</div></a></li>
  							<li><a href="buscador.php"><div>Búsqueda de CV</div></a></li>

  							<?php
  								if ($allowed && $permisos_db == "administrador") {
  							?>
  							<li class="current"><a href="usuarios.php"><div>Gestión de usuarios</div></a> <!-- Solo para administradores-->
  							</li>
                <br><br>
  							<?php } ?>
                <li><a href="ayuda.php"><div>Ayuda</div></a></li>
                <li><a href="contacto.php"><div>Contacto</div></a></li>
  						</ul>

  					</nav><!-- #primary-menu end -->

  					<div class="clearfix visible-md visible-lg">
  						<a href="https://github.com/hugo19941994/CV-Parser" class="social-icon si-small si-borderless si-github">
  							<i class="icon-github"></i>
                <i class="icon-github"></i>
  						</a>
  					</div>

  				</div>

  			</div>

  		</header><!-- #header end -->

        <!-- Content
		============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="promo promo-full promo-border header-stick bottommargin-lg">
                    <div class="container clearfix">
                        <h3>Gestión de usuarios de la aplicación</h3>
                        <span>Gestione los usuarios y los permisos de los mismos para securizar el acceso a la aplicación.</span>
                    </div>
                </div>

                <div class="container clearfix">

                  <?php
                    if ($allowed) {
                  ?>
                    <div class="col_half">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title text-center">Alta de usuario</div>
                            </div>

                            <div class="panel-body">
                              <div>
                                <label style="margin-top: 2%;">Nombre de usuario: </label>
                                <input type="text" class="form-control col-xs-3" id="nuevoUsuarioNombre">
                              </div>
                              <div>
                                <label style="margin-top: 2%;">Contraseña de usuario: </label>
                                <input type="text" class="form-control col-xs-3" id="nuevoUsuarioPassword">
                                </div>
                                <div>
                                <label style="margin-top: 2%;">Permisos: </label>
                                <select id="nuevoUsuarioPermisos" class="form-control  col-xs-3">
                                  <option value="administrador">Administrador</option>
                  								<option selected="" value="basicos">Basicos</option>
                  							</select>
                                </div>
                                <div>
                                  <a href="#" class="button button-3d fcenter tab-linker" id="altaUsuario" rel="4" style="margin-top: 2%;">Alta usuario</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col_half col_last">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="panel-title text-center">Baja de usuario</div>
                            </div>

                            <div class="panel-body">

                                <p>Introduzca el nombre del usuario a dar de baja</p>
                                <label>Nombre de usuario: </label>
                                <input type="text" class="form-control col-xs-3" id="borrarUsuarioId">

                                <div>
                                  <a href="#" class="button button-3d fcenter tab-linker" id="bajaUsuario" rel="4" style="margin-top: 2%;">Baja usuario</a>
                                </div>
                            </div>
                        </div>
                  </div>
                  <?php
                } else {
                  ?>
                <div class="col_full">
                  <div>
                    <h3>Usuario incorrecto</h3>
                    <p>Usted no tiene acceso para ver esta página. Vuelva a la pantalla de acceso para entrar con el usuario proporcionado por el administrador del sistema.</p>
                  </div>
                </div>
                <?php
                }
                ?>

              </div> <!--Container end-->

          </div>
        </div>
    </section>
    <!-- #content end -->

    </div>
    <!-- #wrapper end -->
    <div id="seccionError"></div>

    <!-- JavaScripts externos
	============================================= -->
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/usuarios.js"></script>

    <!-- Footer Scripts
	============================================= -->
    <script type="text/javascript" src="js/functions.js"></script>

</body>

</html>
