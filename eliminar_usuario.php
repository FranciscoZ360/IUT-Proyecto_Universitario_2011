<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
if ($_SESSION['nivel']!=1) {
	// redirecciona a error de acceso
	header("Location: inicio.php?error=2");
	exit; // detenga el script
}


require ("clases/class_DAO_usuario.php");

// crea el objeto dao usuario
try {
	$usuario = new DAO_usuario(); 
	//se captura el id del dato que se va a eliminar
	$id_usuario = $_GET['id_usuario'];
	
	$obtener = $usuario->getUsuario($id_usuario);
	
	//se elimina
	$exito = $usuario->eliminar($id_usuario);
	if ($exito) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "ELIMINAR";
		$tabla = "USUARIO";
		$descripcion = "Elimino al usuario :"." ".$obtener[3]." ".$obtener[4];
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	}
}   catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body><font face="calibri">
<table width="800" height="570" border="0" align="center" cellpadding="0" cellspacing="0">  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="150" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="527" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    
    <center><p>Detalle de la operacion:<br><?php 
if($exito)
  echo "Se ha eliminado el registro";
  else
   echo "Error!...no se elimino el registro";
?></p></center>
    <table width="200" border="0" align="center">
      <tr>
        <td align="center"><a href="listar_usuario.php">VOLVER AL LISTADO</a></td>
      </tr>
    </table>
    <p>&nbsp;</p></td>
  </tr>
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
  
</table>

</font>
</body>
</html>