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
	// se inserta
	$res = $equipo->insertar($tipo, $marca, $serial, $status);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "EQUIPO";
		$descripcion = "Inserto el equipo con el serial: $serial";
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
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <?php if ($res) { ?>
    <p>Se ha agregado un <font face="calibri">N</font>uevo <font face="calibri">E</font>quipo.</p>
    <?php } else { ?>
    <p>sobre carga de equipo... Error !!!.</p>
    <?php } ?>
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del Equipo</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%">Tipo</td>
        <td width="62%"><?php echo $tipo; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Marca</td>
        <td><?php echo $marca; ?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td>Serial</td>
        <td><?php echo $serial; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Status</td>
        <td><?php echo $status; ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><p>&nbsp;</p>
          <p><a href="agregar_equipo.php">VOLVER AL REGISTRO DE EQUIPOS</a></p></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
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