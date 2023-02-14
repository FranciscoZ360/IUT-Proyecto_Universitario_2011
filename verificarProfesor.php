<?php 
require ("clases/class_DAO_profesor.php");
// crea el objeto dao profesor
try {
	$profesor = new DAO_profesor();
	// capturamos los datos del formulario
	$ci=$_POST['ci'];
	// se consulta
	$nombre = $profesor->consultarProfesor($ci);
	if ($nombre==false)
		$nombre[]=false;
} catch (Exception $e) {
	$nombre[] = false;
}
echo json_encode($nombre);
?>