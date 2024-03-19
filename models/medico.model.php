<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class MedicoModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM medico order by medico_ape ASC";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function uno($medico_cod){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM medico where medico_cod=$medico_cod";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function repetido($medico_cod){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(medico_cod) as codigomed FROM medico where medico_cod=$medico_cod";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($medico_cod,$medico_ape,$medico_esp,$medico_tel,$medico_cor){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `medico`(`medico_cod`,`medico_ape`,`medico_esp`,`medico_tel`,`medico_cor`) VALUES ('$medico_cod','$medico_ape','$medico_esp','$medico_tel','$medico_cor')";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
        //$datos = mysqli_query($con, $cadena);
        
    }

    public function Actualizar($medico_cod,$medico_ape,$medico_esp,$medico_tel,$medico_cor){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE medico SET medico_cod='$medico_cod', medico_ape='$medico_ape', medico_esp='$medico_esp', medico_tel='$medico_tel', medico_cor='$medico_cor' WHERE medico_cod=$medico_cod";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function Eliminar($medico_cod){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `medico` WHERE medico_cod=$medico_cod ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
    
}
