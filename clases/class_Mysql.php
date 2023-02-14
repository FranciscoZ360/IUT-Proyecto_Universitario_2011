<?php 
class Mysql {
	/* atributos */	
	private $usuario;
	private $contraseña;
	private $bd;
	private $servidor;
	private $id;
	
	/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		// incluir el archivo config.php
		require_once ("config.php");
		// inicializa
		$this->usuario=usuario;
		$this->contraseña=contraseña;
		$this->bd=bd;
		$this->servidor=servidor;
		$this->id = $this->abrirConexion();
	}
	
	/* destructor: se invoca automáticamente al momento de la 
	   destruccion del objeto */
	public function __destruct () {
		@mysql_close ($this->id);
	}
	
	private function abrirConexion () {
		$id = @mysql_connect($this->servidor,$this->usuario,$this->contraseña);
		if (!$id) // si no conecta crea una excepcion
			throw new Exception ("Fallo en los datos de la conexion");
		
		// selecciona la BD
		$seleccion = @mysql_select_db($this->bd,$id);
		if (!$seleccion) // si no puede selecciona la BD
			throw new Exception ("Fallo en el nombre de la Base de Datos");

		return $id; // devuelve el identificador de la conexion
	}
	
	public function ejecutar ($sql) {
		return @mysql_query($sql,$this->id); // @ evita mostrar las advertencias
	}
	
	public function getRegistro ($res) {
		return @mysql_fetch_array($res);	
	}
}
?>