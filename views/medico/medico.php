<?php
include_once('../../config/sesiones.php');
if (isset($_SESSION["idUsuario"])) {
    $_SESSION["ruta"] = "Usuarios";
?>

    <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php require_once('../html/head.php')  ?>
        <style>
            @media print{
                .no-imprimir{
                    display: none;
                }
            }
        </style>
        <script>
    function asignarValor() {
      var valor = "nuevo"; // Valor que deseas asignar al input
      document.getElementById("bandera").value = valor;
    }
  </script>
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
                            <h1 class="h3 mb-0 text-gray-800">MEDICOS</h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-4" id="Impresion">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Lista de Médicos</h6>                              
                                        <button  onclick="asignarValor()" class="btn btn-primary float-left no-imprimir" data-toggle="modal" data-target="#modalUsuarios"> Nuevo</button>                                   
                                        <button  onclick="imprimirJavascript()" class="btn btn-primary float-left no-imprimir" > Imprimir</button>                                   
                                    
                                    </div>
                                    <div class="card-body">
                                        <table width="100%" cellspacing="0" class="table table-bordered table-striped table-responsive">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cedula</th>
                                                    <th>Apellidos y Nombres</th>
                                                  
                                                    <th>Especialidad</th>
                                                    <th>Telefono</th>
                                                    <th>Correo</th>
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
                                <h5 class="modal-title" id="titulModalUsuarios">Ingresar Datos del Medico</h5>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="usuarios_form" >
                                <div class="modal-body">
                                    <input type="hidden" name="bandera" id="bandera">
                                    
                                    <div class="form-group">
                                        <label for="medico_cod" class="control-label">Cédula</label>
                                        <input type="text" name="medico_cod" id="medico_cod" class="form-control" onblur="" onfocusout="validarCedula(this.value);repetido(this.value)" required>
                                       
                                        <div class="alert alert-danger d-none" role="alert" id="mensaje"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="medico_ape" class="control-label">Apellidos y Nombres</label>
                                        <input type="text" name="medico_ape" id="medico_ape" class="form-control" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="medico_esp" class="control-label">Especialidad</label>
                                        <input type="text" name="medico_esp" id="medico_esp" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="medico_tel" class="control-label">Teléfono</label>
                                        <input type="text" name="medico_tel" id="medico_tel" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="medico_cor" class="control-label">E-mail</label>
                                        <input type="email" name="medico_cor" id="medico_cor" class="form-control">                                         
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
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
        <script src="./medico.js"></script>

    </body>

    </html>


<?php
} else {
    header('Location:../../index.php');
}
?>