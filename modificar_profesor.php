<?php

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_profesor.php");
// crea el objeto dao usuario
try {
	$profesor = new DAO_profesor();
	// capturamos los datos del formulario
	
	$nro_carnet = strtoupper($_POST['nro_carnet']);
	$ci_pro = $_POST['ci_pro'];
	$nombre = strtoupper($_POST['nombre']);
	$apellido = strtoupper($_POST['apellido']);
	$idp=$_POST['idp'];
	$viejo=$_POST['viejo'];
	// se inserta
	$res = $profesor->modificar($idp, $nro_carnet, $ci_pro, $nombre, $apellido);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "MODIFICAR";
		$tabla = "PROFESOR";
		$descripcion = "Modifico el profesor $viejo al nuevo $nro_carnet";
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	}
} catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
}
?>
<html">
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
if($res)
  echo "Se ha modificado el registro";
  else
   echo "Error!...no se modifico el registro";
?></p></center>
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del usuario</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%">Nª Empleado</td>
        <td width="62%"><?php echo $nro_carnet;	?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Cedula:</td>
        <td><?php echo $ci_pro;?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td>Nombre:</td>
        <td><?php echo $nombre;	?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Apellido:</td>
        <td><?php echo $apellido;	?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><p>&nbsp;</p>
          <p><a href="listar_profesor.php">VOLVER AL LISTADO</a></p></td>
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