<?php

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_material.php");
// crea el objeto dao usuario
try {
	$material = new DAO_material();
	// capturamos los datos del formulario
	
	$descripcion1 = strtoupper($_POST['descripcion']);
	$cantidad = $_POST['cantidad'];
	$existenciaminima=$_POST['existenciaminima'];
	$idp=$_POST['idp'];
	$viejo=$_POST['viejo'];
	// se inserta
	$res = $material->modificar($idp,$descripcion1, $cantidad, $existenciaminima);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "MODIFICAR";
		$tabla = "MATERIAL";
		$descripcion = "Modifico el material $viejo al nuevo $descripcion1 $cantidad";
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

<body>
<table width="800" height="570" border="0" align="center" cellpadding="0" cellspacing="0">  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="150" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="527" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    
    <center><p>Detalle de la Operacion:<br><?php 
if($res)
  echo "Se ha modificado el Material";
  else
   echo "Error!...";
?></p>
    </center>
    <table width="85%" height="89" border="0" align="left">
      <tr bgcolor="#EAEAEA">
        <td width="166" bgcolor="#EAEAEA">Descripcion</td>
        <td width="151"><?php echo $descripcion1; ?></td>
        </tr>
      
      <tr bgcolor="#DBDBDB">
        <td bgcolor="#DBDBDB">Cantidad</td>
        <td><?php echo $cantidad; ?></td>
        </tr>
      <tr>
        <td bgcolor="#EAEAEA">Existencia minima</td>
        <td bgcolor="#EAEAEA"><?php echo $existenciaminima; ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><p>&nbsp;</p>
          <p><a href="listar_material.php">VOLVER AL LISTADO</a></p></td>
        </tr>
      
      
    </table>
    <p>&nbsp;</p></td>
  </tr>
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
  
</table>


</body>
</html>