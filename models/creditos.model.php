<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class CreditosModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT s1.Nombres_socio AS socio, s2.Nombres_socio AS garante, c.fecha_credito AS fecha_credito, c.valor_credito AS valor_credito, c.destino_credito AS destino, c.plazo_credito AS plazo, c.valor_aprobado AS valor_aprobado, c.plazo_aprobado AS plazo_aprobado, c.fecha_aprobacion AS fecha_aprobacion, c.cuota_mensual AS cuota FROM creditos AS c INNER JOIN socios AS s1 ON c.id_socios = s1.Id_socio INNER JOIN socios AS s2 ON c.id_garante = s2.Id_socio";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function uno($id_creditos){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `creditos` INNER JOIN pacientes on historial.paciente_ced=pacientes.paciente_ced where id_creditos=$id_creditos";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($historial_det, $historial_diag, $historial_trat, $paciente_ced, $id_control){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `creditos`(`historial_det`, `historial_diag`, `historial_trat`, `paciente_ced`, `medico_cod`) VALUES ('$historial_det', '$historial_diag', '$historial_trat', '$paciente_ced', '$id_control')";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }        
    }
    public function Actualizar($id_creditos, $historial_det, $historial_diag, $historial_trat){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE creditos SET historial_det='$historial_det', historial_det='$historial_det', historial_diag='$historial_diag', historial_trat='$historial_trat' WHERE id_creditos=$id_creditos";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function Eliminar($id_creditos){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `creditos` WHERE id_creditos=$id_creditos ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
    
}
