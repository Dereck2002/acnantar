<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/aportaciones.model.php');
$Signos = new AportesModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Signos->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $signos_cod = $_POST['signos_cod'];    
            $datos = array();   
            $datos = $Signos->uno($signos_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $signos_tem = $_POST['signos_tem'];
            $signos_pre = $_POST['signos_pre'];
            $signos_pes = $_POST['signos_pes'];
            $signos_talla = $_POST['signos_talla'];
            $paciente_ced = $_POST['paciente_ced'];
            $datos = array();          
            $datos = $Signos->Insertar($signos_tem, $signos_pre, $signos_pes, $signos_talla, $paciente_ced);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
                $idRoles = $_POST['idRoles'];   
                $Detalle = $_POST['Detalle'];       
                $datos = array();        
                $datos = $Roles->Actualizar($idRoles, $Detalle);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $signos_cod = $_POST['signos_cod'];       
                $datos = array();        
                $datos = $Signos->Eliminar($signos_cod);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
