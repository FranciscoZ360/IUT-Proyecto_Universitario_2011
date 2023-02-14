<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
date_default_timezone_set("America/Caracas");
require ("clases/class_DAO_profesor.php");
require ("clases/class_DAO_material.php");
// crea el objeto dao usuario
try {
	
	$profesor = new DAO_profesor();
	$omaterial = new DAO_material();
	// capturamos los datos del formulario
	$materiales=$_POST['materiales'];		// viene cantidad --> id_material --> descripcion
	$id_profesor=$_POST['id_profesor'];
	$reg_profesor = $profesor->getProfesor($id_profesor);
	$i = 0;
	$fecha = date ("Y-m-d H:i:s");
	$ver = date ("d/m/Y");
	$res = true;
	while ($res && $i < count($materiales)) {
		$material = $materiales [$i];
		list ($cantidad,$id_material)=explode("-->",$material);
		$res = $omaterial->actualizarCantidad ($id_material,$cantidad);
		if ($res)
			$res = $omaterial->insertarProfMaterial($id_profesor,$id_material,$fecha,$cantidad);
		$i++;
	}
	if (!$res)
		echo mysql_error();
		
		
		
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
    <td width="150" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="527" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <?php
    $a=0;
		while ($a < count($materiales)) {
			$material = $materiales [$a];
		list ($cantidad,$id_material,$des)=explode("-->",$material);
		$salida= $cantidad."-->".$des." "." ";
		$a++;
		
		} ?>
    <?php if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "PROF-MATERIAL";
		$descripcion = "Se realizo una entrega de ". $salida. "al profesor ".$reg_profesor[3]." ".$reg_profesor[4];
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
		?>
    <p>La Entrega de Material se Realizo con Exito!</p>
    <?php } else { ?>
    <p>No hay Suficinete Material.</p>
    <?php } ?>
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del la Entrega</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%"><font face="calibri">Profesor:</font></td>
        <td width="62%"><?php echo $reg_profesor[3];?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Descripcion:</td>
        <td><?php
		$a=0;
		while ($a < count($materiales)) {
			$material = $materiales [$a];
		list ($cantidad,$id_material,$des)=explode("-->",$material);
		$salida= $cantidad."-->".$des." "." ";
		$a++;
		echo $salida;
		} 
		?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td bgcolor="#EAEAEA">Fecha de la Entrega:</td>
        <td bgcolor="#EAEAEA"><?php echo $ver; ?></td>
      </tr>
      </table>
	  <table width="200" border="0" align="center">
      <tr>
        <td align="center"><p>&nbsp;</p>
          <p><a href="entregaMaterial.php?id=<?php echo $id_profesor; ?>">VOLVER A LA ENTREGA DE MATERIAL</a></p></td>
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
<p>&nbsp;</p>
</body>
</html>