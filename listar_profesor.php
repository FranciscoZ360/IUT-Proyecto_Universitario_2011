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

require ("clases/class_DAO_profesor.php");
// crea el objeto dao profesor
try {
	$profesor = new DAO_profesor(); 
	$respuesta = $profesor->listar($inicio);}
	
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
<script language="javascript">
function eliminar(){
	var texto = confirm("¿Esta seguro que desea eliminar a este Profesor?");
	if (texto){
		return true;
		}
		else{
			return false;
			}
	}

</script>
<body><font face="calibri">
<table width="800" height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" valign="top" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    
    <center>
      <p>
      <h2>Listado de <font face="calibri">P</font>rofesor<font face="calibri">es</font></h2></p></center>
    <table width="100%"  border="0" align="center">
      <tr>
        <td width="134" bgcolor="#EAEAEA">Nombre</td>
        <td width="107" bgcolor="#DBDBDB">Apellido</td>
        <td width="120" bgcolor="#EAEAEA">Cedula</td>
        <td width="140" bgcolor="#EAEAEA">Numero de <font face="calibri">E</font>mpleado</td>
        <td colspan="2" align="center" bgcolor="#DBDBDB">Opciones</td>
      </tr>
      <?php 
  // se obtiene el total de registros de la consulta
  $res = $respuesta[0];
  $total = count($res);
  for ($i=0; $i<$total; $i++) {
	  $fila = $res[$i];
	   ?>
      <tr>
        <td bgcolor="#EAEAEA"><?php echo $fila['nombre']; ?></td>
        <td bgcolor="#DBDBDB"><?php echo $fila['apellido']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['ci_pro']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['nro_carnet'];?> </td>
        <td width="36" align="center" bgcolor="#DBDBDB"><a onclick="return eliminar();" href="eliminar_profesor.php?id_profesor=<?php echo $fila['id_profesor']; ?>"><img src="img/b_drop.png" alt="eliminar" width="16" height="16" border="0" /></a></td>
        <td width="33" align="center" bgcolor="#DBDBDB"><a href="editar_profesor.php?id_profesor=<?php echo $fila['id_profesor']; ?>"><img src="img/b_edit.png" alt="modificar" width="16" height="16" border="0" /></a></td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="38" border="0" align="center">
      <tr>
        <td width="50%" height="32" align="left"> 
        <?php 
			if ($inicio!=0) {
		?>
        <a href="listar_profesor.php?reg=<?php echo $inicio - 10; ?>"><input type="button" name="Anterior" id="Anterior" value="Anterior" /></a>
        <?php } ?>
        </td>
        
        <td width="50%" align="right">
        <?php
		$inicio = $inicio + 10;
		$total_registros = $respuesta[1];
		if ($total_registros>$inicio) {
		?>
        <a href="listar_profesor.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
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