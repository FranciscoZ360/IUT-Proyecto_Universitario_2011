<?php 
// capturar los datos
$login = $_POST['usuario'];
$password = $_POST['contrasena'];
require("clases/class_DAO_usuario.php");
try {
	$dao = new DAO_usuario();
	$usuario = $dao->validar($login,$password);
	if (!$usuario) { // no es válido
			// redirecciona a login
		header("Location: login.php?error=1"); 
	} else { // el usuario es válido
		session_start(); 	// crea la sesion
		$_SESSION['usuario'] = $usuario['nombre']." ".$usuario['apellido'];
		$_SESSION['nivel'] = $usuario['nivel'];
		$_SESSION['id'] = $usuario["id_usuario"];
		
		header("Location: inicio.php"); 
	}
} catch (Exception $e) {
	header("Location: errorsistema.php");
}
?>