<?php
//TODO: archivos requeridos
require_once('../config/config.php');
class UsuariosRolesModel
{
   
    public function Insertar($idUsuario, $idRoles){
        $con = new ClaseConexion();
        $con = $con->ProcedimientoConectar();
        $cadena = "INSERT INTO `usuarios_roles`(`idUsuario`, `idRoles`) VALUES ('$idUsuario','$idRoles')";
        if (mysqli_query($con,$cadena))
        {
            return 'ok';
        }else{
            return 'error ' . mysqli_error($con);
        }
    }
}
