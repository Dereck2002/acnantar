<?php
include_once('../../config/sesiones.php');
if (isset($_SESSION["idUsuario"])) {
    $_SESSION["ruta"] = "Usuarios";
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php require_once('../html/head.php')  ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <!-- Sidebar -->
            <?php require_once('../html/menu.php') ?>
            <!-- End of Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- Topbar -->
                    <?php include_once('../html/header.php')  ?>
                    <!-- End of Topbar -->
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"></h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Lista de Usuarios</h6>                              
                                        <button onclick="cargaSelectRoles()" class="btn btn-primary float-left" data-toggle="modal" data-target="#modalUsuarios"> Nuevo</button>                                   
                                    </div>
                                    <div class="card-body">
                                        <table width="100%" cellspacing="0" class="table table-bordered table-striped table-responsive">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombres</th>
                                                    <th>Apellidos</th>
                                                    <th>Correo</th>
                                                    <th>Rol</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id='TablaUsuarios'></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ventanas Modales -->
                <div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulModalUsuarios">Ingresar Usuarios</h5>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="usuarios_form">
                                <div class="modal-body">
                                    <input type="hidden" name="idUsaurio" id="idUsaurio">
                                    <div class="form-group">
                                        <label for="Nombres" class="control-label">Nombres</label>
                                        <input type="text" name="Nombres" id="Nombres" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Apellidos" class="control-label">Apellidos</label>
                                        <input type="text" name="Apellidos" id="Apellidos" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasenia" class="control-label">contrasenia</label>
                                        <input type="text" name="contrasenia" id="contrasenia" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="correo" class="control-label">Correo</label>
                                        <input type="mail" name="correo" id="correo" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="Rol" class="control-label">Rol</label>
                                        <select name="idRoles" id="idRoles" class="form-control">                                         
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-secondary" onclick="limpiar()" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php include_once('../html/footer.php') ?>
                <!-- End of Footer -->
            </div>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <!--scripts-->
        <?php include_once('../html/scripts.php')  ?>
        <script src="./usuarios.js"></script>
    </body>

    </html>


<?php
} else {
    header('Location:../../index.php');
}
?>