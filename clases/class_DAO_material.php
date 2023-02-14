<?php 
require_once ("class_Mysql.php");
class DAO_material {
	/* atributos */
	private $mysql;	// objeto de la clase Mysql
	
	/* constructor: inicializa los atributos 
	   se ejecuta al momento de instanciar la clase */	
	public function __construct() {
		$this->mysql = new Mysql();
	}
	
	/* insertar: inserta un nuevo material con los datos dados
	   por parametro */
	public function insertar ($descripcion1, $existencia, $existenciaminima) {
		// se crea la consulta SQL
		$sql = "INSERT INTO material VALUES (0,'$descripcion1', $existencia, $existenciaminima)";
		// se manda a ejecutar
		return $this->mysql->ejecutar($sql);
		}
	
	public function listar ($inicio){
		// se crea la consulta SQL
		$sql = "SELECT * FROM material LIMIT $inicio, 10";
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
		$sql = "SELECT count(id_material) as total FROM material ";
		// se manda a ejecutar
		$res = $this->mysql->ejecutar($sql);
		$total = $this->mysql->getRegistro($res);
		$respuesta[1] = $total['total'];
		return $respuesta;
		
		}
		
		public function eliminar ($id_material){
		// se crea la consulta SQL		
		$sql = "DELETE FROM material WHERE id_material=$id_material";
	   // se manda a ejecutar
		return $this->mysql->ejecutar($sql);
	}
	
	public function getMaterial($id_material){
		//se crea la consulta
		$sql = "SELECT * FROM material WHERE id_material=$id_material";					
			$res= $this->mysql->ejecutar($sql);
			//se manda a ejecutar
			return $this->mysql->getRegistro($res);
			}
			
	public function modificar($idp,$descripcion1, $cantidad, $existenciaminima){
		$sql = "UPDATE material SET descripcion='$descripcion1',existencia= existencia + $cantidad, existencia_minima=$existenciaminima WHERE id_material=$idp";
		return $this->mysql->ejecutar($sql);
		}
	
	public function getDescripcionMaterial(){
		//se crea la consulta
		$sql = "SELECT * FROM material";	
		$res = $this->mysql->ejecutar($sql);
		$respuesta = array();
		while($registro = $this->mysql->getRegistro($res)){
			$respuesta[] = $registro;
		}
		return $respuesta;
	}
	
	/*public function profMaterial($materiales,$cantidad,$id,$real){
		}*/
		
	public function getProfesor($id_profesor){
	// se crea la consulta SQL
		$sql = "SELECT * FROM profesor WHERE id_profesor=$id_profesor";					
		$res = $this->mysql->ejecutar($sql);
		// se manda a ejecutar
		return $this->mysql->getRegistro($res);
	}
		
	
	
	public function insertarProfMaterial ($idp, $idm, $fecha, $cant) {
		$sql = "INSERT INTO `prof-material` VALUES (0,$idp,$idm,'$fecha',$cant)";
		return $this->mysql->ejecutar($sql);
	}
	
	public function actualizarCantidad ($id_material,$cantidad) {
		$sql = "UPDATE material SET existencia = existencia - $cantidad WHERE id_material = $id_material ";
		return $this->mysql->ejecutar($sql);
		}
	
	public function revisarCantidad($id, $cant){
		$sql = "SELECT * FROM material WHERE id_material = $id AND existencia >= $cant";
		$res = $this->mysql->ejecutar($sql);
		if ($this->mysql->getRegistro($res)) { // si esta un registro
			$resultado[0] = "SI"; // si puede hacer la entrega
			$sql = "SELECT * FROM material WHERE id_material = $id AND existencia_minima > existencia - $cant";
			$res = $this->mysql->ejecutar($sql);
			if ($this->mysql->getRegistro($res)) // si esta un registro
				$resultado[1] = "SI"; // si mandarle mensaje de existencia minima
			else
				$resultado[1] = "NO"; // no mandarle mensaje de existencia minima
		} else
			$resultado[0] = "NO";	 
		return $resultado;	
	}
	
	
	public function EntregaProfesor($cedula) {
	
  $sql = "SELECT pro.nombre,pro.apellido, mat.descripcion, pm.cant_otorgada,  pm.fecha_entrega
FROM `prof-material` AS pm, `profesor` AS pro, `material` AS mat
WHERE pro.ci_pro =$cedula
AND pm.id_material = mat.id_material
AND pm.id_profesor = pro.id_profesor";	
	$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
 while ($resu = $this->mysql->getRegistro($res))
 	$resultado[] = $resu;
	
	return $resultado;
	}
	
	public function EntregaMaterialPorFecha($inicio,$principio,$fin) {
	$sql = "SELECT pro.nombre, pro.apellido, mat.descripcion, pm.cant_otorgada, pm.fecha_entrega FROM `prof-material` AS pm, `profesor` AS pro, `material` AS mat WHERE pm.fecha_entrega >= '$principio 00:00:00' AND pm.fecha_entrega <= '$fin 00:00:00' AND pm.id_material = mat.id_material AND pm.id_profesor = pro.id_profesor ORDER BY pm.fecha_entrega ASC LIMIT $inicio, 10";	
	$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
 while ($resu = @$this->mysql->getRegistro($res))
 	$resultado[] = $resu;
	
	return @$resultado;
	
	
}
	
	
	
	/*public function reporteFecha ($principio,$fin) {
		// formato inicio y fin 2011-06-01 23:59:59
		$sql = "SELECT pro.nombre,pro.apellido, mat.descripcion, pm.cant_otorgada, pm.fecha_entrega FROM `prof-material` as pm, `profesor` as pro, `material` as mat WHERE `fecha_entrega` >= '$principio' AND `fecha_entrega` <= '$fin' AND pm.id_profesor = pro.id_profesor AND pm.id_material = mat.id_material ";
		$res = $this->mysql->ejecutar($sql);
			//se manda a ejecutar
 while ($resu = $this->mysql->getRegistro($res))
 	$resultado[] = $resu;
	
	return $resultado;
	}*/
	
	
}	

?>