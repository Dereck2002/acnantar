<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/roles.model.php');
$Roles = new RolesModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Roles->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $idRoles = $_POST['idRoles'];    
            $datos = array();   
            $datos = $Roles->uno($idRoles);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            $Detalle = $_POST['Detalle'];
            //$Apellidos = $_POST['Apellidos'];
            //$correo = $_POST['correo'];
            //$contrasenia = $_POST['contrasenia'];
            //$idRoles = $_POST['idRoles'];
            $datos = array();
            //$datos = $Usuario->Insertar($Nombres, $Apellidos, $correo, $contrasenia,$idRoles); 
            $datos = $Roles->Insertar($Detalle);
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
                $idRoles = $_POST['idRoles'];       
                $datos = array();        
                $datos = $Roles->Eliminar($idRoles);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;    
}
