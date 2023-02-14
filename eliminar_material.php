<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}


$inicio = 0;
if (isset($_GET['reg']))
	$inicio = $_GET['reg'];
require ("clases/class_DAO_material.php");

// crea el objeto dao usuario
try {
	$material = new DAO_material(); 
	//se captura el id del dato que se va a eliminar
	$id_material = $_GET['id_material'];
	
//se elimina
   
	$exito = $material->eliminar($id_material);
	if ($exito) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "ELIMINAR";
		$tabla = "MATERIAL";
		$descripcion = "Elimino el material";
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	}
}   catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
}


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        <td align="center"><a href="listar_material.php">VOLVER AL LISTADO</a></td>
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