<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class AportesModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT socios.Nombres_socio 'nombres' ,transacciones.fecha_aportes 'fecha', transacciones.Valor_aportes 'aporte',transacciones.desc_aportes 'descripcion' FROM transacciones INNER JOIN socios on socios.Id_socio=transacciones.id_socio ORDER BY socios.Nombres_socio ASC";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function uno($signos_cod){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM `signosvitales` INNER JOIN pacientes on pacientes.paciente_ced=signosvitales.paciente_ced  where signos_cod=$signos_cod";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($signos_tem, $signos_pre, $signos_pes, $signos_talla, $paciente_ced){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena ="INSERT INTO `signosvitales`(`paciente_ced`, `signos_tem`, `signos_pre`, `signos_pes`, `signos_talla`) VALUES ('$paciente_ced','$signos_tem', '$signos_pre','$signos_pes', '$signos_talla')";
        $datos = mysqli_query($con,$cadena);
    }

    public function Actualizar($idRoles,$detalle){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE `roles` SET `detalle`='$detalle' WHERE idroles=$idRoles";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function Eliminar($signos_cod){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `signosvitales` WHERE signos_cod=$signos_cod ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
}
