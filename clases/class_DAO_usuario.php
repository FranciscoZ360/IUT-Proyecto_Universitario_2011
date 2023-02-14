<?php 
require_once ("class_Mysql.php");
class DAO_usuario {
	/* atributos */
	private $mysql;	// objeto de la clase Mysql
	
	/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		$this->mysql = new Mysql();
	}
	
	/* devuelve falso si el usuario no coincide,
	   devuelve el registro completo si coincide. */
	public function validar ($login,$pass) {
		$login=md5($login);
		$pass=md5($pass);
		$sql = "SELECT * FROM usuario WHERE login='$login' AND 
				contrasena='$pass'";
		$res = $this->mysql->ejecutar($sql);
		$fila = $this->mysql->getRegistro($res);
		return $fila;
	}
	
	// devuelve false si el login no se encuentra
	// devuelve el registro (la pregunta) si existe
	public function recuperarPregunta ($login){
		$log = md5($login);
		$sql = "SELECT pregunta FROM usuario WHERE login='$log'";
		$res = $this->mysql->ejecutar($sql);
		$registro = $this->mysql->getRegistro($res);
		if ($registro!=false) {
			$sql = "SELECT descripcion FROM preguntas WHERE id_pregunta='".$registro['pregunta']."'";
			$res = $this->mysql->ejecutar($sql);
			$registro = $this->mysql->getRegistro($res);
		}
		return $registro; 
	}
	
	// devuelve true si cambia la contraseña false en caso contrario
	public function cambiarPassword ($login,$respuesta){
		$pass = md5($login);
		$login = md5($login);
		$respuesta = md5($respuesta);
		$sql = "SELECT * FROM usuario WHERE login='$login' AND respuesta = '$respuesta'";
		$res = $this->mysql->ejecutar($sql);
		$registro = $this->mysql->getRegistro($res);
		if ($registro!=false) {
			$sql = "UPDATE usuario SET contrasena='$pass' WHERE login='$login' AND respuesta = '$respuesta'";
			$res = $this->mysql->ejecutar($sql);
			return $res;
		} else
			return false;
	}
	
	
	
	/* insertar: inserta un nuevo registro usuario con los datos dados
	   por parametro */
	public function insertar ($login, $contraseña, $nombre, $apellido, $nivel,
							  $pregunta, $respuesta, $cargo) {
		$login = md5($login);
		$contraseña = md5($contraseña);	// se encripta la clave,el login y la respuesta del usuario
		$respuesta = md5($respuesta);
		
		// se crea la consulta SQL
		$sql = "INSERT INTO usuario VALUES (0,'$login','$contraseña','$nombre',
				'$apellido',$nivel,$pregunta,'$respuesta','$cargo')";
		// se manda a ejecutar
		return $this->mysql->ejecutar($sql);
	}
	
	public function listar (){
		// se crea la consulta SQL
		$sql = "SELECT * FROM usuario";
		$res = $this->mysql->ejecutar($sql);
		$lista = array();
		$cont = 0;
		while ($fila=$this->mysql->getRegistro($res)) {
			$lista[$cont] = $fila;
			$cont++;
		}
		// se manda a ejecutar
		return $lista;
	}
	public function eliminar ($id_usuario){
		// se crea la consulta SQL		
		$sql = "DELETE FROM usuario WHERE id_usuario=$id_usuario";
	   // se manda a ejecutar
		return $this->mysql->ejecutar($sql);
	}
	public function getUsuario($id_usuario){
		// se crea la consulta
		$sql = "SELECT * FROM usuario WHERE id_usuario=$id_usuario";					
		$res = $this->mysql->ejecutar($sql);
		// se manda a ejecutar
		return $this->mysql->getRegistro($res);
	}
	public function modificar($idp,$nombre, $apellido, $nivel, $cargo){
		// se crea la consulta
		$sql = "UPDATE usuario SET nombre='$nombre',apellido='$apellido',nivel=$nivel,cargo='$cargo' WHERE id_usuario=$idp";
		// se manda a ejecutar
		return $this->mysql->ejecutar($sql);
		}
		
		public function CambiarContrasena($id,$contrasena,$nvacontrasena){
			$contrasena=md5($contrasena);
			$nvacontrasena=md5($nvacontrasena);
		// se crea la consulta
		
		$sql = "SELECT * FROM usuario WHERE contrasena='$contrasena' AND id_usuario=$id";
		$res = $this->mysql->ejecutar($sql);
		$registro = $this->mysql->getRegistro($res);
		if ($registro!=false) {
		$sql = "UPDATE usuario SET contrasena='$nvacontrasena' WHERE id_usuario=$id";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
			return $res;
		} else
			return false;
	}
		
}	

?>