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
	$n_empleado = strtoupper($_POST['nro_carnet']);
	$cedula = $_POST['ci_pro'];
	$nombre = strtoupper($_POST['nombre']);
	$apellido = strtoupper($_POST['apellido']);
	
	// se inserta
	$res = $profesor->insertar($n_empleado,$cedula,$nombre,$apellido);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "PROFESOR";
		$descripcion = "Agrego al profesor: $nombre $apellido";
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
    <p>Se ha registrado un nuevo Profesor.</p>
    <?php } else { ?>
    <p>Profesor existente!!. Verifique los datos nuevamente.</p>
    <?php } ?>
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del Profesor</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%">Nombre:</td>
        <td width="62%"><?php echo $nombre; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Apellido:</td>
        <td><?php echo $apellido; ?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td>Cedula</td>
        <td><?php echo $cedula; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Numero de Empleado</td>
        <td><?php echo $n_empleado; ?></td>
      </tr>
      </table>
	  <table width="200" border="0" align="center">
      <tr>
        <td align="center"><p>&nbsp;</p>
          <p><a href="agregar_profesor.php">VOLVER AL REGISTRO DE PROFESOR</a></p></td>
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