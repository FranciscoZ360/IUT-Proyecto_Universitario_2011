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

require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$equipo = new DAO_equipo(); 
	$respuesta = $equipo->listarPrestamos($inicio);
	}
	
	catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    
    <center><font face="calibri">
      <p>
      <h2><font face="calibri">Listado de<font face="calibri"> Equipos en Prestamo</font></h2></p></center>
    <table width="100%"  border="0" align="center">
      <tr>
         <td width="125" align="left" bgcolor="#DBDBDB"><font face="calibri">Profesor</font></td>
        <td width="125" align="left" bgcolor="#EAEAEA"><font face="calibri">Descripcion</font></td>
        <td width="129" align="left" bgcolor="#DBDBDB"><font face="calibri">Marca</font></td>
        <td width="85" align="left" bgcolor="#EAEAEA"><font face="calibri">Serial</font></td>
        </tr>
      <?php 
  // se obtiene el total de registros de la consulta
  $res = $respuesta[0];
  $total = count($res);
  for ($i=0; $i<$total; $i++) {
	  $fila = $res[$i];
	   ?>
      <tr>
        <td bgcolor="#DBDBDB"><?php echo $fila['nombre']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['descripcion']; ?></td>
        <td bgcolor="#DBDBDB"><?php echo $fila['marca'];?> </td>
        <td bgcolor="#EAEAEA"><?php echo $fila['serial']; ?> </td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="38" border="0" align="center">
      <tr>
        <td width="50%" height="32" align="left"> 
        <?php 
			if ($inicio!=0) {
		?>
        <a href="listar_equipo.php?reg=<?php echo $inicio - 10; ?>"><input type="button" name="Anterior" id="Anterior" value="Anterior" /></a>
        <?php } ?>
        </td>
        
        <td width="50%" align="right" >
        <?php
		$inicio = $inicio + 10;
		$total_registros = $respuesta[1];
		if ($total_registros>$inicio) {
		?>
        <a href="listar_equipo.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
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