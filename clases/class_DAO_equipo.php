<?php 
require_once ("class_Mysql.php");
class DAO_equipo {
	/* atributos */
	private $mysql;	// objeto de la clase Mysql
	
	/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		$this->mysql = new Mysql();
	}
	
	/* insertar: inserta un nuevo equipo con los datos dados
	   por parametro */
	public function insertar ($tipo, $marca, $serial, $status) {
		// se crea la consulta SQL
		$sql = "INSERT INTO equipo VALUES (0,'$tipo','$marca','$serial', '$status','activo')";
		// se manda a ejecutar
		return $this->mysql->ejecutar($sql);
		}
	
	public function listar ($inicio){
		// se crea la consulta SQL
		$sql = "SELECT * FROM equipo LIMIT $inicio, 10";
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
		$sql = "SELECT count(id_equipo) as total FROM equipo ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}
		
	public function getDescripcionEquipos(){
		//se crea la consulta
		$sql = "SELECT DISTINCT descripcion FROM equipo WHERE status='habilitado' AND disponibilidad='activo'";	
		$res = $this->mysql->ejecutar($sql);
		$respuesta = array();
		while($registro = $this->mysql->getRegistro($res)){
			$respuesta[] = $registro['descripcion'];
		}
		return $respuesta;
	}
	
	public function getDescripcionMarca($des){
		//se crea la consulta
		$sql = "SELECT DISTINCT marca FROM equipo WHERE status='habilitado' AND descripcion='$des' AND disponibilidad='activo'";	
		$res = $this->mysql->ejecutar($sql);
		$respuesta = array();
		while($registro = $this->mysql->getRegistro($res)){
			$respuesta[] = $registro['marca'];
		}
		return $respuesta;
	}
	
	public function getDescripcionSerial($des,$mar){
		//se crea la consulta
		$sql = "SELECT serial FROM equipo WHERE status='habilitado' AND descripcion='$des' AND marca='$mar' AND disponibilidad='activo'";	
		$res = $this->mysql->ejecutar($sql);
		$respuesta = array();
		while($registro = $this->mysql->getRegistro($res)){
			$respuesta[] = $registro['serial'];
		}
		return $respuesta;
	}
	
	public function getEquipo ($id_equipo){
		//se crea la consulta
		$sql = "SELECT * FROM equipo WHERE id_equipo=$id_equipo";					
			$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
			return $this->mysql->getRegistro($res);
			}
			
	public function modificar($idp,$tipo,$marca,$serial,$status){
		$sql = "UPDATE equipo SET descripcion='$tipo',marca='$marca',serial='$serial',status='$status' WHERE id_equipo=$idp";
		return $this->mysql->ejecutar($sql);
		}
		
	public function buscar($serial){
		$sql = "SELECT * FROM equipo WHERE serial='$serial'";
		$res = $this->mysql->ejecutar($sql);
		return $this->mysql->getRegistro($res);
		}
		
	public function insertarProfMaterial($id_profesor,$id_equipo,$horaentrega,$horadev){
          $sql = "INSERT into `prof-equipo` VALUES(0,$id_profesor,$id_equipo,'$horaentrega','$horadev',NULL)";	
	      return $this->mysql->ejecutar($sql);
	}
	
	public function cambiarDisponibilidad($idequipo) {
			$sql = "UPDATE equipo SET disponibilidad = 'prestado' WHERE id_equipo = $idequipo";	
	        return $this->mysql->ejecutar($sql);
		}
		
	public function PrestamosProfesor($cedula) {
	$sql = "SELECT pro.nombre,pro.apellido, eq.descripcion, eq.marca, eq.serial, pe.fecha_entrega, pe.fecha_devolucion, pe.fecha_devolucion_real FROM `prof-equipo` AS pe, `profesor` AS pro, `equipo` AS eq WHERE pro.ci_pro =$cedula AND pe.id_equipo = eq.id_equipo AND pe.id_profesor = pro.id_profesor";	
	$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
 while ($resu = @$this->mysql->getRegistro($res))
 	$resultado[] = $resu;
	
	return $resultado;
	
	
}

	public function PrestamosEquipoPorFecha($inicio,$principio,$fin) {
	$sql = "SELECT pro.nombre, pro.apellido, eq.descripcion, eq.marca, eq.serial, pe.fecha_entrega, pe.fecha_devolucion, pe.fecha_devolucion_real FROM `prof-equipo` AS pe, `profesor` AS pro, `equipo` AS eq WHERE pe.fecha_entrega >= '$principio 00:00:00' AND pe.fecha_entrega <= '$fin 23:59:59' AND pe.id_equipo = eq.id_equipo AND pe.id_profesor = pro.id_profesor ORDER BY pe.fecha_entrega ASC LIMIT $inicio, 10";	
	$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
 while ($resu = @$this->mysql->getRegistro($res))
 	$resultado[] = $resu;
	
	return @$resultado;
	
	
}



public function listarPrestamos ($inicio){
		// se crea la consulta SQL
		$sql = "SELECT pro.nombre, eq.descripcion, eq.marca, eq.serial FROM `prof-equipo` AS pe, `profesor` AS pro, `equipo` AS eq WHERE  pe.id_equipo = eq.id_equipo AND pe.id_profesor = pro.id_profesor AND pe.fecha_devolucion_real IS NULL LIMIT $inicio, 10 ";
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
		$sql = "SELECT count(id_equipo) as total FROM equipo ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}
		
		public function listarPrestamosProfesor ($inicio,$id){
		// se crea la consulta SQL
		$sql = "SELECT eq.descripcion, eq.marca, eq.serial, pe.fecha_entrega, pe.fecha_devolucion FROM `prof-equipo` AS pe, `equipo` AS eq WHERE pe.id_equipo = eq.id_equipo
AND pe.id_profesor = 1 AND pe.fecha_devolucion_real IS NULL LIMIT $inicio, 10 ";
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
		$sql = "SELECT count(id_equipo) as total FROM equipo ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}
		
		public function getCedulaProfesor($id){
			$sql = "SELECT * FROM profesor WHERE id_profesor=$id";
			$res = $this->mysql->ejecutar($sql);
			return $this->mysql->getRegistro($res);
			}
		
		public function modificarEstado($serial){
		$sql = "UPDATE equipo SET disponibilidad='activo'  WHERE serial='$serial'";
		return $this->mysql->ejecutar($sql);
		}
		
		public function devolucion($fecha,$id,$serial){
		$sql = "UPDATE `prof-equipo` pe, equipo eq SET pe.fecha_devolucion_real='$fecha'  WHERE pe.id_profesor= $id AND pe.id_equipo = eq.id_equipo AND eq.serial = '$serial' AND pe.fecha_devolucion_real IS NULL";
		return $this->mysql->ejecutar($sql);
		}
		
		

}
?>