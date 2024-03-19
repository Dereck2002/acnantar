<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/socios.model.php');
$Socio = new SociosModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Socio->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $Cedula_socio = $_POST['Cedula_socio'];    
            $datos = array();   
            $datos = $Socio->uno($Cedula_socio);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

            case 'repetido':
                $paciente_ced = $_POST['paciente_ced'];    
                $datos = array();   
                $datos = $Socio->repetido($paciente_ced);   
                $respuesta = mysqli_fetch_assoc($datos);   
                echo json_encode($respuesta);   
                break;
    
        case 'insertar':
            $Cedula_socio = $_POST['Cedula_socio'];
            $Nombres_socio = $_POST['Nombres_socio'];          
            $Fecha_nacimiento_socio = $_POST['Fecha_nacimiento_socio'];
            $Telefono_socio = $_POST['Telefono_socio'];
            $Direccion_socio = $_POST['Direccion_socio'];         
            $Email_socio = $_POST['Email_socio'];
            $Ocupacion_socio = $_POST['Ocupacion_socio'];
            $Fecha_ingreso_socio = $_POST['Fecha_ingreso_socio'];                    
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $Socio->Insertar($Cedula_socio, $Nombres_socio,$Fecha_nacimiento_socio,$Telefono_socio,$Direccion_socio,$Email_socio,$Ocupacion_socio,$Fecha_ingreso_socio);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
                $Id_socio = $_POST['Id_socio'];
                $Cedula_socio = $_POST['Cedula_socio'];
                $Nombres_socio = $_POST['Nombres_socio'];               
                $Fecha_nacimiento_socio = $_POST['Fecha_nacimiento_socio'];
                $Telefono_socio = $_POST['Telefono_socio'];               
                $Direccion_socio = $_POST['Direccion_socio'];
                $Email_socio = $_POST['Email_socio'];
                $Ocupacion_socio = $_POST['Ocupacion_socio'];
                $Fecha_ingreso_socio= $_POST['Fecha_ingreso_socio'];    
                $datos = array();        
                $datos = $Socio->Actualizar($Id_socio,$Cedula_socio, $Nombres_socio,$Fecha_nacimiento_socio,$Telefono_socio,$Direccion_socio,$Email_socio,$Ocupacion_socio,$Fecha_ingreso_socio);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $Cedula_socio= $_POST['Cedula_socio'];
                    
                $datos = array();        
                $datos = $Socio->Eliminar($Cedula_socio);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
