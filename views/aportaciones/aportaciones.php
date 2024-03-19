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
                                <div class="card shadow mb-4" id="Impresion">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Aportaciones de los socios</h6>                              
                                        <button onclick="cargaSelectSocios()" class="btn btn-primary float-left no-imprimir" data-toggle="modal" data-target="#modalUsuarios"> Nuevo</button>                                   
                                        <button onclick="imprimirJavascript()" class="btn btn-primary float-left no-imprimir" > Imprimir</button>
                                    </div>
                                    
                                    <div class="card shadow mb-3">
                                        <label for="pacientes" class="control-label">Nombres de Socios</label>
                                        <select name="paciente_ced" id="paciente_ced" class="form-control" style="width: 30%;">                                         
                                        </select>
                                        <div class="card-header py-3">                        
                                            <button onclick="cargaSelectSocios()" class="btn btn-primary float-left no-imprimir" data-toggle="modal" data-target="#modalUsuarios">Ejecutar</button>                                   
                                        </div>
                                    </div>
                                    
                                    <div class="card-body">
                                    
                                    <table width="100%" cellspacing="0" class="table table-bordered table-striped table-responsive">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombres</th>
                                                    <th>Fecha</th>
                                                    <th>Aportaciones</th>
                                                    <th>Descripcion</th>
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
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="titulModalUsuarios">Ingresar Aportaciones</h5>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="usuarios_form">
                                <div class="modal-body">
                                    <input type="hidden" name="signos_cod" id="signos_cod">
                                    <!--<div class="form-group">
                                        <label for="signos_fec" class="control-label">FECHA</label>
                                        <input type="date" name="signos_fec" id="signos_fec" class="form-control" required>
                                    </div>-->
                                    <div class="form-group">
                                        <label for="signos_tem" class="control-label">Temperatura</label>
                                        <input type="text" name="signos_tem" id="signos_tem" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signos_pre" class="control-label">Presión Arterial</label>
                                        <input type="text" name="signos_pre" id="signos_pre" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="signos_pes" class="control-label">Peso</label>
                                        <input type="text" name="signos_pes" id="signos_pes" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="signos_talla" class="control-label">Talla</label>
                                        <input type="text" name="signos_talla" id="signos_talla" class="form-control">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="pacientes" class="control-label">Pacientes</label>
                                        <select name="paciente_ced" id="paciente_ced" class="form-control">                                         
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
        <script src="./aportaciones.js"></script>
    </body>

    </html>
<?php
} else {
    header('Location:../../index.php');
}
?>