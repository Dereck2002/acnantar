<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/controlcreditos.model.php');
$Medico = new controlcreditosModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Medico->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $id_control = $_POST['id_control'];    
            $datos = array();   
            $datos = $Medico->uno($id_control);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;
        
        case 'repetido':
            $id_control = $_POST['id_control'];    
            $datos = array();   
            $datos = $Medico->repetido($id_control);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $id_control = $_POST['id_control'];
            $medico_ape = $_POST['medico_ape'];
            
            $medico_esp = $_POST['medico_esp'];
            $medico_tel = $_POST['medico_tel'];
            $medico_cor = $_POST['medico_cor'];           
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $Medico->Insertar($medico_cod,$medico_ape,$medico_esp,$medico_tel,$medico_cor);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
                $id_control = $_POST['id_control'];
                $medico_ape = $_POST['medico_ape'];               
                $medico_esp = $_POST['medico_esp'];
                $medico_tel = $_POST['medico_tel'];
                $medico_cor = $_POST['medico_cor'];     
                $datos = array();        
                $datos = $Medico->Actualizar($id_control,$medico_ape,$medico_esp,$medico_tel,$medico_cor);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $id_control = $_POST['id_control'];
                     
                $datos = array();        
                $datos = $Medico->Eliminar($id_control);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
