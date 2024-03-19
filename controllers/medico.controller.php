<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/medico.model.php');
$Medico = new MedicoModel; //TODO:Declaracion de variable
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
            $medico_cod = $_POST['medico_cod'];    
            $datos = array();   
            $datos = $Medico->uno($medico_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;
        
        case 'repetido':
            $medico_cod = $_POST['medico_cod'];    
            $datos = array();   
            $datos = $Medico->repetido($medico_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $medico_cod = $_POST['medico_cod'];
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
                $medico_cod = $_POST['medico_cod'];
                $medico_ape = $_POST['medico_ape'];               
                $medico_esp = $_POST['medico_esp'];
                $medico_tel = $_POST['medico_tel'];
                $medico_cor = $_POST['medico_cor'];     
                $datos = array();        
                $datos = $Medico->Actualizar($medico_cod,$medico_ape,$medico_esp,$medico_tel,$medico_cor);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $medico_cod = $_POST['medico_cod'];
                     
                $datos = array();        
                $datos = $Medico->Eliminar($medico_cod);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
