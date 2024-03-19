<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/historial.model.php');
$Historial = new HistorialModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Historial->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $historial_cod = $_POST['historial_cod'];    
            $datos = array();   
            $datos = $Historial->uno($historial_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;
        
        case 'repetido':
            $medico_cod = $_POST['medico_cod'];    
            $datos = array();   
            $datos = $Historial->repetido($historial_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            //$historial_cod = $_POST['historial_cod'];
            $historial_det = $_POST['historial_det'];
            $historial_diag = $_POST['historial_diag'];
            $historial_trat = $_POST['historial_trat'];
            $paciente_ced = $_POST['paciente_ced'];
            $medico_cod= $_POST['medico_cod'];
            $datos = array();
            $datos = $Historial->Insertar($historial_det, $historial_diag, $historial_trat, $paciente_ced,$medico_cod);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
            $historial_cod = $_POST['historial_cod'];
            $historial_det = $_POST['historial_det'];
            $historial_diag = $_POST['historial_diag'];
            $historial_trat = $_POST['historial_trat'];
              
                $datos = array();        
                $datos = $Historial->Actualizar($historial_cod, $historial_det, $historial_diag, $historial_trat);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $historial_cod = $_POST['historial_cod'];                 
                $datos = array();        
                $datos = $Historial->Eliminar($historial_cod);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;        
}
