<?php
error_reporting(0);
//TODO: Requerimeintos
require_once('../config/sesiones.php');
require_once('../models/recetas.model.php');
$Recetas = new RecetasModel; //TODO:Declaracion de variable
switch ($_GET['op']) {  //TODO: Clausula de desicion para obtener variable tipo GET

    case 'todos':
        $datos = array();
        $datos = $Recetas->todos();
        while ($fila = mysqli_fetch_assoc($datos)) {
            $todos[] = $fila;
        }
        echo json_encode($todos);
        break;
        
        case 'uno':
            $receta_cod = $_POST['receta_cod'];    
            $datos = array();   
            $datos = $Recetas->uno($receta_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;
        
        case 'repetido':
            $receta_cod = $_POST['receta_cod'];    
            $datos = array();   
            $datos = $Historial->repetido($historial_cod);   
            $respuesta = mysqli_fetch_assoc($datos);   
            echo json_encode($respuesta);   
            break;

        case 'insertar':
            //$historial_cod = $_POST['historial_cod'];
            $receta_pres = $_POST['receta_pres'];
            $receta_indi = $_POST['receta_indi'];
            $paciente_ced = $_POST['paciente_ced1'];
            $medico_cod= $_POST['medico_cod1'];

            $datos = array();
            $datos = $Recetas->Insertar($receta_pres, $receta_indi,$paciente_ced, $medico_cod);
            echo json_encode($datos);
            break;
    
            case 'actualizar':
            $receta_cod = $_POST['receta_cod'];
            
            $receta_est = $_POST['receta_est'];
              
                $datos = array();        
                $datos = $Recetas->Actualizar($receta_cod, $receta_est);        
                //$respuesta = mysqli_fetch_assoc($datos);        
                echo json_encode($datos);        
                break;
        
            case 'eliminar':        
                $receta_cod = $_POST['receta_cod'];                 
                $datos = array();        
                $datos = $Recetas->Eliminar($receta_cod);       
               //$respuesta = mysqli_fetch_assoc($datos);       
                echo json_encode($datos);       
                break;        
}
