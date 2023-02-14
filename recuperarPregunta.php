<?php 
require ("clases/class_DAO_usuario.php");
// crea el objeto dao usuario
try {
	$usuario = new DAO_usuario();
	// capturamos los datos del formulario
	$login=$_POST['login'];
	// se consulta
	$pregunta = $usuario->recuperarPregunta($login);
	if($pregunta==false)
		$pregunta[] = false;
} catch (Exception $e) {
	$pregunta[] = false;
}
echo json_encode($pregunta);
?>