<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class RolesModel
{
    public function todos(){  //TODO: CProcedimeinto para obtener todos los registros de la BDD
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM roles ";
        $datos = mysqli_query($con,$cadena);
        return $datos;
    }
    public function uno($idRoles){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "SELECT * FROM Roles where idRoles=$idRoles";
        $datos = mysqli_query($con, $cadena);
        return $datos;
    }  
    public function Insertar($detalle){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `roles`(`Detalle`) VALUES ('$detalle')";
        $datos = mysqli_query($con,$cadena);
        //if(mysqli_insert_id($con) > 0){
            //definir el modelo usuarios_roles
            //$UsuarioRoles = new UsuariosRolesModel();
            //return $UsuarioRoles->Insertar(mysqli_insert_id($con), $idRoles);
        //}else{
          //  return 'Error al insertar el rol del usuario';
        //}
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
    public function Eliminar($idRoles){
        $con = new ClaseConexion();
        $con=$con->ProcedimientoConectar();
        $cadena = "DELETE FROM `Roles` WHERE idRoles=$idRoles ";
        if (mysqli_query($con, $cadena)){
            return 'ok';
        }else{
            return mysqli_error($con);
        }
    
    }
}
