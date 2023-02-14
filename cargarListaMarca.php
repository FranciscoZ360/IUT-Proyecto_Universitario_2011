<?php 
require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$usuario = new DAO_equipo();
	// capturamos los datos del formulario
	$des=$_POST['des']; // descripcion
	// se consulta
	$res = $usuario->getDescripcionMarca($des);
	if(count($res)==0)
		$res[] = false;
} catch (Exception $e) {
	$res[] = false;
}
echo json_encode($res);
?>