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
	
$cedula = $_POST['cedula'];
$reg = $equipo->PrestamosProfesor($cedula);
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
    
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="form1" name="form1" method="post" onSubmit="return validar_campos(this)"action="insertar_profesor.php">
    <table width="100%"  border="0" align="center">
    <center><h2>Reporte de prestamo de equipos por profesor</h2></center>
    <tr>
    Profesor : <?php echo $reg[0][0]." ".$reg[0][1]; ?>
    </tr>
      <tr>
        <td width="125" align="left" bgcolor="#DBDBDB"><font face="calibri">Descripcion</font></td>
        <td width="129" align="left" bgcolor="#EAEAEA"><font face="calibri">Marca</font></td>
        <td width="85" align="left" bgcolor="#DBDBDB"><font face="calibri">Serial</font></td>
        <td width="85" align="left" bgcolor="#DBDBDB">Fecha entrega</td>
         <td width="85" align="left" bgcolor="#DBDBDB"><font face="calibri">Fecha devolucion</font></td>
         <td width="85" align="left" bgcolor="#DBDBDB"><font face="calibri">Fecha devolucion real</font></td>
        </tr>
      <?php 
  // se obtiene el total de registros de la consulta
  $total=count($reg);
	           for ($i=0; $i < $total; $i++){
	   ?>
      <tr>
        <td bgcolor="#DBDBDB"><?php echo $reg[$i]['descripcion']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $reg[$i]['marca']; ?> </td>
        <td bgcolor="#DBDBDB"><?php echo $reg[$i]['serial']; ?> </td>
        <td bgcolor="#DBDBDB"><?php $fecha_entrega=$reg[$i]['fecha_entrega'];
		$fecha_entrega=strtotime($fecha_entrega);
		echo date("d/m/y h:i a",$fecha_entrega);
		?></td>
        <td bgcolor="#DBDBDB"><?php $fecha_devolucion=$reg[$i]['fecha_devolucion'];
		$fecha_devolucion=strtotime($fecha_devolucion);
		echo date("d/m/y h:i a",$fecha_devolucion);
		?></td>
        <td bgcolor="#DBDBDB"><?php if ($reg[$i]['fecha_devolucion_real'] != 0){
			$real=$reg[$i]['fecha_devolucion_real'];
		$real=strtotime($real);
		echo date("d/m/y h:i a",$real);}
		?></td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="70" border="0" align="center">
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
		$total_registros = $reg[0][1];
		if ($total_registros>$inicio) {
		?>
        <a href="reProEquipo.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
        <?php } ?>
        </td>
        </tr>
      <tr>
        <td height="32" colspan="2" align="center"><input type="button" name="imprimir" id="imprimir" value="imprimir" onclick="window.print();"/></td>
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
</body>
</html>