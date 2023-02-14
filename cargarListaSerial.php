<?php 
require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$usuario = new DAO_equipo();
	// capturamos los datos del formulario
	$des=$_POST['des']; // descripcion
	$mar=$_POST['mar']; // marca
	// se consulta
	$res = $usuario->getDescripcionSerial($des,$mar);
	if(count($res)==0)
		$res[] = false;
} catch (Exception $e) {
	$res[] = false;
}
echo json_encode($res);
?>