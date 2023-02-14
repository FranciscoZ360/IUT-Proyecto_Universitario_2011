<?php

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$equipo = new DAO_equipo();
	// capturamos los datos del formulario
	
	$tipo = strtoupper($_POST['tipo']);
	$marca = strtoupper($_POST['marca']);
	$serial = strtoupper($_POST['serial']);
	$status = $_POST['status'];
	$serial_viejo = $_POST['serial_viejo'];
	$idp=$_POST['idp'];
	// se inserta
	$res = $equipo->modificar($idp,$tipo,$marca,$serial,$status);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "MODIFICAR";
		$tabla = "EQUIPO";
		$descripcion = "Modifico el equipo $serial_viejo al nuevo $serial";
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	}
} catch (Exception $e) {
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
    <td width="527" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><font face="calibri">
    <center><p>Detalle de la operacion:<br><?php 
if($res)
  echo "Se ha modificado el equipo";
  else
   echo "Error!...";
?></p></center>
    <table width="100%" height="89" border="0" align="center">
      <tr bgcolor="#EAEAEA">
        <td width="166">Descricion:</td>
        <td width="151"><?php echo $tipo; ?></td>
        </tr>
      
      <tr bgcolor="#DBDBDB">
        <td>Marca:</td>
        <td><?php echo $marca; ?></td>
        </tr>
      <tr bgcolor="#EAEAEA">
        <td>Serial:</td>
        <td><?php echo $serial; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Status:</td>
        <td><?php echo $status; ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><p>&nbsp;</p>
          <p><a href="listar_equipo.php">VOLVER AL LISTADO</a></p></td>
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