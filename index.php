<!DOCTYPE html>
<html lang="es">
  <head>
    <title>LogIn</title>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <link rel="stylesheet" href="./css/main.css" />
  </head>
  <body class="cover" style="background-image: url(./assets/img/fondo3.jpg)">
    <form action="controllers/usuario.controller.php?op=login" method="post" autocomplete="off" class="full-box logInForm">
      <p class="text-center text-muted">
        <i class="zmdi zmdi-account-circle zmdi-hc-5x"></i>
      </p>
      <p class="text-center text-muted text-uppercase">
        Inicia sesión con tu email
      </p>
                                        <?php
                                        if (isset($_GET['op'])) {
                                            switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET
                                                case '1':
                                        ?>
                                                    <div class="form-group">
                                                        <div class="alert alert-danger">
                                                            El usuario o la contrasenia son incorrectos
                                                        </div>
                                                    </div>
                                                <?php
                                                    break;
                                                case '2':
                                                ?>
                                                    <div class="form-group">
                                                        <div class="alert alert-danger">
                                                            Por favor, llene las cajas de texto
                                                        </div>
                                                    </div>
                                        <?php
                                            }
                                        }
                                        ?>
      <div class="form-group label-floating">
        <label class="control-label" for="correo">Usuario</label>
        <input class="form-control" id="correo" name="correo" type="mail" />
        <p class="help-block">Escribe tú E-mail</p>
      </div>

      <div class="form-group label-floating">
        <label class="control-label" for="contrasenia">Contraseña</label>
        <input class="form-control" id="contrasenia" name="contrasenia" type="password" />
        
        <p class="help-block">Escribe tú contraseña</p>
      </div>

      <div class="form-group text-center">
        <input type="submit" value="Iniciar sesión" class="btn btn-raised btn-danger"/>
      </div>
    </form>

    <!--====== Scripts -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/material.min.js"></script>
    <script src="./js/ripples.min.js"></script>
    <script src="./js/sweetalert2.min.js"></script>
    <script src="./js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="./js/main.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="./public/vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./public/js/sb-admin-2.min.js"></script>
    <script>
      $.material.init();
    </script>
  </body>
</html>


