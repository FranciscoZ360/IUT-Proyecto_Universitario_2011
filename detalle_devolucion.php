<?php 
session_start(); // todas las paginas internas recuperan la sesion
date_default_timezone_set("America/Caracas");
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_equipo.php");
require ("clases/class_DAO_profesor.php");

// crea el objeto dao equipo
try {
	$equipo = new DAO_equipo();
	$profesor = new DAO_profesor();
	//se captura el id del dato que se va a editar
	$serial = $_GET['serial'];
	$id = $_GET['id'];
	// se ejecuta
	$fecha = date("Y-m-d H:i:s");
	$res = $equipo->modificarEstado($serial,$fecha);
	$reg_profesor = $profesor->getProfesor($id);
		
	
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
<table width="800" height="570" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <?php if ($res) { 
	$fechareal = $equipo->devolucion($fecha,$id,$serial); 
	// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "MODIFICAR";
		$tabla = "PROF-EQUIPO";
		$descripcion = "Se devolvio el equipo"." ".$serial." "."por el profesor"." ".$reg_profesor[3]." ".$reg_profesor[4];;
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	?>
    <p>Se ha devuelto un <font face="calibri"></font> <font face="calibri">E</font>quipo.</p>
    <?php } else { ?>
    <p>sobre carga de equipo... Error !!!.</p>
    <?php } ?>
    <br>
    <br>
    <br>
    <br>
    <br><a href="devolucion.php?id=<?php echo $id ;?>"><input type="button" name="VOLVER AL LISTADO" id="VOLVER AL LISTADO" value="VOLVER AL LISTADO" /></a></td>
  </tr>
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
</table>

<p>&nbsp;</p>
</font>
</body>
</html>