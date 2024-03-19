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
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        
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
                            <div class="col-lg-12 mb-4" id="Impresion">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3" class="botones-container" >
                                        <h6 class="m-0 font-weight-bold text-primary">ATENCION MEDICA</h6>                              
                                        <button onclick="cargaSelectPacientes();cargaSelectMedicos()" class="btn btn-primary float-left no-imprimir" data-toggle="modal" data-target="#modalUsuarios"> Nuevo</button>
                                        <button onclick="imprimirJavascript()" class="btn btn-primary float-left no-imprimir" > Imprimir</button>
                                    </div>
                                    <div class="card-body">
                                        <table width="100%" cellspacing="0" class="table table-bordered table-striped table-responsive">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Apellidos y Nombres</th>
                                                   
                                                    <th>Fecha</th>
                                                    <th>Estado</th>
                                                    <th>Diagnostico</th>
                                                    <th>Tratamiento</th>
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
                                <h6 class="modal-title" id="titulModalUsuarios">Ingresar Atención Medica</h6>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="usuarios_form">
                                <div class="modal-body">
                                    <input type="hidden" name="historial_cod" id="historial_cod">
                                    <div class="form-group">
                                        <label for="pacientes" class="control-label">Pacientes</label>
                                        <select name="paciente_ced" id="paciente_ced" class="form-control">                                         
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="medico_cod" class="control-label">Medico</label>
                                        <select name="medico_cod" id="medico_cod" class="form-control">                                         
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label">Estado del Paciente</label>
                                        <textarea placeholder="Ingrese el estado del Paciente" class="form-control"  name="historial_det" id="historial_det" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label">Diagnostico</label>
                                        <textarea type="text" name="historial_diag" id="historial_diag" class="form-control" cols="30" rows="2" 
                                        required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label">Tratamiento</label>
                                        <textarea type="text" name="historial_trat" id="historial_trat" class="form-control" cols="30" rows="2" 
                                        required></textarea>
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
<!-- Ventanas Modal RECETAS -->
                <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modalRecetas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="titulModalUsuarios">Registrar Receta Medica</h6>
                                <button type="button" onclick="limpiar()" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="Recetas_form">
                                <div class="modal-body">
                                    <input type="hidden" name="receta_cod" id="receta_cod">
                                    <input type="hidden" name="paciente_ced1" id="paciente_ced1">
                                    <input type="hidden" name="medico_cod1" id="medico_cod1">
                                    
                                    <div class="form-group">
                                        <label  class="control-label">Prescripcion</label>
                                        <textarea placeholder="Ingrese la prescripción medica" class="form-control"  name="receta_pres" id="receta_pres" cols="30" rows="4"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label  class="control-label">Indicaciones</label>
                                        <textarea placeholder="Ingrese las indicaciones" type="text" name="receta_indi" id="receta_indi" class="form-control" cols="30" rows="2" 
                                        required></textarea>
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
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <script src="./historial.js"></script>
      
    </body>

    </html>
<?php
} else {
    header('Location:../../index.php');
}
?>