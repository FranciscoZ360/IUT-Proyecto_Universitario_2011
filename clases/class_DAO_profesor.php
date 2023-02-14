<?php 
require_once ("class_Mysql.php");
class DAO_profesor {
	
	/* atributos */
	private $mysql;	// objeto de la clase Mysql

/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		$this->mysql = new Mysql();
	}
	
	/* insertar: inserta un nuevo registro profesor con los datos dados
	   por parametro */

public function insertar($n_empleado,$cedula,$nombre,$apellido){
   // se crea la consulta SQL
		$sql = "INSERT INTO profesor VALUES(0,'$n_empleado',$cedula,'$nombre','$apellido')";
// se manda a ejecutar
		return $this->mysql->ejecutar($sql);
		}
		
	public function listar ($inicio){
		// se crea la consulta SQL
		$sql = "SELECT * FROM profesor LIMIT $inicio, 10";
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
		$sql = "SELECT count(id_profesor) as total FROM profesor ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}
	
	public function eliminar ($id_profesor){
		// se crea la consulta SQL		
		$sql = "DELETE FROM profesor WHERE id_profesor=$id_profesor";
	   // se manda a ejecutar
		return $this->mysql->ejecutar($sql);
	}
	
	public function getProfesor($id_profesor){
	// se crea la consulta SQL
		$sql = "SELECT * FROM profesor WHERE id_profesor=$id_profesor";					
		$res = $this->mysql->ejecutar($sql);
		// se manda a ejecutar
		return $this->mysql->getRegistro($res);
	}
	
	public function consultarProfesor($ci_profesor){
	// se crea la consulta SQL
		$sql = "SELECT * FROM profesor WHERE ci_pro = $ci_profesor";					
		$res = $this->mysql->ejecutar($sql);
		// se manda a ejecutar
		return $this->mysql->getRegistro($res);
		
	}
	
	public function modificar($idp, $nro_carnet, $ci_pro, $nombre, $apellido){
		$sql = "UPDATE profesor SET nro_carnet='$nro_carnet',ci_pro=$ci_pro,nombre='$nombre',apellido='$apellido' WHERE id_profesor=$idp";
		return $this->mysql->ejecutar($sql);
		}
}
?>