<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class SociosModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM socios order by nombres_socio ASC";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function repetido($paciente_ced){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(paciente_ced) as codigopac FROM pacientes where paciente_ced=$paciente_ced";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function uno($Cedula_socio){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM socios where Cedula_socio=$Cedula_socio";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($Cedula_socio, $Nombres_socio,$Fecha_nacimiento_socio,$Telefono_socio,$Direccion_socio,$Email_socio,$Ocupacion_socio,$Fecha_ingreso_socio){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `socios`(`Cedula_socio`, `Nombres_socio`,`Fecha_nacimiento_socio`,`Telefono_socio`,`Direccion_socio`,`Email_socio`,`Ocupacion_socio`,`Fecha_ingreso_socio`) VALUES ('$Cedula_socio', '$Nombres_socio','$Fecha_nacimiento_socio','$Telefono_socio','$Direccion_socio','$Email_socio','$Ocupacion_socio','$Fecha_ingreso_socio')";
        
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
        //$datos = mysqli_query($con, $cadena);
        
    }
    public function Actualizar($Id_socio,$Cedula_socio, $Nombres_socio,$Fecha_nacimiento_socio,$Telefono_socio,$Direccion_socio,$Email_socio,$Ocupacion_socio,$Fecha_ingreso_socio){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE socios SET Cedula_socio='$Cedula_socio', Nombres_socio='$Nombres_socio', Fecha_nacimiento_socio='$Fecha_nacimiento_socio', Telefono_socio='$Telefono_socio', Direccion_socio='$Direccion_socio', Email_socio='$Email_socio', Ocupacion_socio='$Ocupacion_socio',Fecha_ingreso_socio='$Fecha_ingreso_socio'  WHERE Cedula_socio=$Cedula_socio";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function Eliminar($Cedula_socio){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `socios` WHERE Cedula_socio=$Cedula_socio ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
    
}
