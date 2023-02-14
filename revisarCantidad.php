<?php
require ("clases/class_DAO_material.php");
//crea el objeto dao material
try {
	$material = new DAO_material();
	//capturamos los datos del formulario
	$id=$_POST['id'];
	$cantidad=$_POST['cant'];
	//$id = 33;
	//$cantidad = 12;
	$revision = $material->revisarCantidad($id,$cantidad);
} catch (Exception $e) {
	$revision[] = false;
}
echo json_encode($revision);
?>