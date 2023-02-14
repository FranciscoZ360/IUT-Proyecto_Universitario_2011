<?php 
require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$equipo = new DAO_equipo();
	
$resultado = $equipo->getTodosEquipos();



}
catch (Exception $e){
	
}

?>