<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class controlcreditosModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT  `id_creditos` creditos, `id_socios` socios, `fecha_pago` fecha_pago, `cuota_pagada` cuota_pagada FROM `controlcreditos` WHERE 1";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function uno($id_control){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM controlcreditos where id_control=$id_control";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function repetido($id_control){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT count(id_control) as codigomed FROM controlcreditos where id_control=$id_control";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($id_control,$id_creditos,$id_socios,$fecha_pago,$cuota_pagada){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `controlcreditos`(`id_control`,`id_creditos`,`id_socios`,`fecha_pago`,`cuota_pagada`) VALUES ('$id_control','$id_creditos','$id_socios','$fecha_pago','$cuota_pagada')";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
        //$datos = mysqli_query($con, $cadena);
        
    }

    public function Actualizar($id_control,$id_creditos,$id_socios,$fecha_pago,$cuota_pagada){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "UPDATE controlcreditos SET id_control='$id_control', id_creditos='$id_creditos', id_socios='$id_socios', fecha_pago='$fecha_pago', cuota_pagada='$cuota_pagada' WHERE id_control=$id_control";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    }
    public function Eliminar($id_control){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `controlcreditos` WHERE id_control=$id_control";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
    
}
