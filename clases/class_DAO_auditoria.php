<?php 
require_once ("class_Mysql.php");
class DAO_auditoria {
	/* atributos */
	private $mysql;	// objeto de la clase Mysql
	
	/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		$this->mysql = new Mysql();
	}
	
	public function auditar ($usuario, $accion, $tabla, $descripcion ,$fecha){
		$sql = "INSERT INTO auditoria VALUES ('0','$usuario','$accion','$tabla','$descripcion','$fecha')";
		$res = $this->mysql->ejecutar($sql);
		return $res;
	}
	
public function listarAuditoria ($inicio){
		// se crea la consulta SQL
		$sql = "SELECT * FROM auditoria LIMIT $inicio, 10";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$lista = array();
		$cont = 0;
		while ($fila=$this->mysql->getRegistro($res)) {
			$lista[$cont] = $fila;
			$cont++;
		}
		// se guardan los registro a mostrar
		$respuesta[0] = $lista;
		$sql = "SELECT count(id_auditoria) as total FROM auditoria ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}	
}
