<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_material.php");
// crea el objeto dao material
try {
	$material = new DAO_material();
	// capturamos los datos del formulario
	$descripcion1 = strtoupper($_POST['descripcion']);
	$existencia = $_POST['existencia'];
	$existenciaminima = $_POST['existenciaminima'];
	// se inserta
	$res = $material->insertar($descripcion1, $existencia, $existenciaminima);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "MATERIAL";
		$descripcion = "Agrego el material: $descripcion1, cantidad: $existencia ";
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
	}
} catch (Exception $e) {
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

<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <?php if ($res) { ?>
    <p align="center">Se ha agregado un nuevo <font face="calibri">M</font>aterial.</p>
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del Material</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%" align="left" bgcolor="#EAEAEA">Descripcion</td>
        <td width="62%" align="left"><?php echo $descripcion1; ?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td align="left" bgcolor="#DBDBDB">Cantidad Cargada</td>
        <td align="left"><?php echo $existencia ?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td align="left">Existencia Minima</td>
        <td align="left"><?php echo $existenciaminima; ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><p>&nbsp;</p>
          <p><a href="agregar_material.php">VOLVER AL REGISTRO DE MATERIALES</a></p></td>
        </tr>
     </table>
    <?php } else { ?>
    <script language="javascript">
    alert('Error!, material existente, intente de nuevo!');
	</script>
    <?php } ?>
    
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