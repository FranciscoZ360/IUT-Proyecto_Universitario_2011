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
$inicio = 0;
if (isset($_GET['reg']))
	$inicio = $_GET['reg'];
require ("clases/class_DAO_auditoria.php");	
// crea el objeto dao auditoria
try {
	$auditoria = new DAO_auditoria(); 
	$respuesta = $auditoria->listarAuditoria($inicio);}
	
	catch (Exception $e) {
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
<table width="800" height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="150" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="527" valign="top" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    
    <center>
      <p>
      <h2><font face="calibri">Auditoria</font></h2>
      </p></center>
    <table width="100%"  border="0" align="center">
      <tr>
        <td width="134" bgcolor="#EAEAEA"><font face="calibri">Usuario</font></td>
        <td width="116" bgcolor="#DBDBDB"><font face="calibri">Acción</font></td>
        <td width="102" bgcolor="#EAEAEA"><font face="calibri">Tabla</font></td>
        <td width="102"  bgcolor="#DBDBDB"><font face="calibri">Descripcion</font></td>
         <td width="102" bgcolor="#EAEAEA"><font face="calibri">Fecha</font></td>
       
      </tr>
      <?php 
  // se obtiene el total de registros de la consulta
  $res = $respuesta[0];
  $total = count($res);
  for ($i=0; $i<$total; $i++) {
	  $fila = $res[$i];
	   ?>
      <tr>
        <td bgcolor="#EAEAEA"><?php echo $fila['usuario']; ?></td>
        <td bgcolor="#DBDBDB"><?php echo $fila['accion']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['tabla'];?> </td>
        <td width="164" align="center" bgcolor="#DBDBDB"><?php echo $fila['descripcion'];?></td>
        <td width="164" align="center" bgcolor="#EAEAEA"><?php $fecha=$fila['fecha'];
		 $fecha=strtotime($fecha);
		 echo date("d/m/y h:i:a",$fecha);
		?></td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="38" border="0" align="center">
      <tr>
        <td width="50%" height="32" align="left"> 
        <?php 
			if ($inicio!=0) {
		?>
        <a href="auditoria.php?reg=<?php echo $inicio - 10; ?>"><input type="button" name="Anterior" id="Anterior" value="Anterior" /></a>
        <?php } ?>
        </td>
        
        <td width="50%" align="right">
        <?php
		$inicio = $inicio + 10;
		$total_registros = $respuesta[1];
		if ($total_registros>$inicio) {
		?>
        <a href="auditoria.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
        <?php } ?>
        </td>
        </tr>
    </table>
    <p>&nbsp;</p>
    
    </td>
  
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
  
</table>
</font>
</body>
</html>