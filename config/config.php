<?php     
//TODO: Clase para conectar con la base de datos
class ClaseConexion{
    public $conexion;
    protected $db;
    private $host = "localhost"; //TODO: Variable del servidor  -- conexion en la misma maquina
    //private $host = "192.168.100.21"; //TODO: Variable del servidor  -- conexion en una red lan

    private $usuario = "root";//TODO: Variable del usuario
    private $password = '';//TODO: Variable del pwd
    private $base = 'cajaahorronantar';//TODO: Variable del base de datos

//TODO: Procedimiento para conectar a la base de datos
    public function ProcedimientoConectar(){
        $this->conexion = mysqli_connect($this->host,$this->usuario,$this->password, $this->base);
        mysqli_query($this->conexion,"SET NAMES utf8");
        if($this->conexion == 0){
            die('error al conectarse al servidor' . mysqli_error($this->conexion));
        }
        $this->db= mysqli_select_db($this->conexion, $this->base);
        if($this->db == 0){
            die('error al conectarse a la base de datos'. mysqli_error($this->conexion));
        }
        return $this->conexion;
    }
}
