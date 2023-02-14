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
	$id=$_GET['id'];
	$equipo = new DAO_equipo();
	$respuesta = $equipo->listarPrestamosProfesor($inicio,$id);
}
catch (Exception $e){
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
<table width="800"  height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="178" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="form1" name="form1" method="post" onSubmit="return validar_campos(this)"action="">
    <table width="100%"  border="0" align="center">
    <center><h2>Prestamo por Profesor</h2></center>
      <tr>
        <td width="117" align="left" bgcolor="#DBDBDB">Descripcion</td>
        <td width="99" align="left" bgcolor="#EAEAEA">Marca</td>
        <td width="99" align="left" bgcolor="#DBDBDB">Serial</td>
        <td width="99" align="left" bgcolor="#EAEAEA">Fecha entrega</td>
        <td width="120" align="left" bgcolor="#DBDBDB">Fecha devolucion</td>
        <td width="60" align="left" bgcolor="#EAEAEA">Devolver</td>
        </tr>
     <?php 
  // se obtiene el total de registros de la consulta
  $res = $respuesta[0];
  $total = count($res);
  for ($i=0; $i<$total; $i++) {
	  $fila = $res[$i];
	   ?>
      <tr>
        <td bgcolor="#DBDBDB"><?php echo $fila['descripcion']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['marca'];?> </td>
        <td bgcolor="#DBDBDB"><?php echo $fila['serial']; ?> </td>
        <td bgcolor="#EAEAEA"><?php echo $fila['fecha_entrega']; ?> </td>
        <td bgcolor="#DBDBDB"><?php echo $fila['fecha_devolucion']; ?> </td>
        <td align="center" bgcolor="#EAEAEA"><a href="detalle_devolucion.php?serial=<?php echo $fila['serial']; ?>&id=<?php echo $id;?>"><img src="img/b_edit.png" alt="modificar" width="16" height="16" border="0" />
          <input name="id" type="hidden" id="id" value="<?php echo $id; ?>" />
        </a></td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="38" border="0" align="center">
      <tr>
        <td width="50%" height="32" align="left"> 
        <?php 
			if ($inicio!=0) {
		?>
        
        <a href="reProEquipo.php?reg=<?php echo $inicio - 10; ?>"><input type="button" name="Anterior" id="Anterior" value="Anterior" /></a>
        <?php } ?>
        </td>
        
        <td width="50%" align="right" >
        <?php
		$inicio = $inicio + 10;
		$total_registros = $respuesta[1];
		if ($total_registros>$inicio) {
		?>
        <a href="reProEquipo.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
        <?php } ?>
        </td>
        </tr>
    </table>
    </form>
    </td>
  </tr>
   
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
</table>
</font>
</body>
</html>