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

require ("clases/class_DAO_material.php");
// crea el objeto dao material
try {
	$material = new DAO_material(); 
	$respuesta = $material->listar($inicio);}
	
	catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<script language="javascript">
function eliminar(){
	var texto = confirm("¿Esta seguro que desea eliminar este Material?");
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
    <td width="150" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="527" valign="top" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    
    <center>
      <p>
      <h2>Listado de Material:</h2></p></center>
    <table width="100%"  border="0" align="center">
      <tr>
        <td width="185" bgcolor="#EAEAEA">Descripcion</td>
        <td width="140" bgcolor="#DBDBDB">Cantidad Existente</td>
        <td width="176" bgcolor="#EAEAEA">Existencia Minima</td>
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
        <td bgcolor="#EAEAEA"><?php echo $fila['descripcion']; ?></td>
        <td bgcolor="#DBDBDB"><?php echo $fila['existencia']; ?></td>
        <td bgcolor="#EAEAEA"><?php echo $fila['existencia_minima'];?> </td>
        <td width="41" align="center" bgcolor="#DBDBDB"><a onClick="return eliminar();" href="eliminar_material.php?id_material=<?php echo $fila['id_material']; ?>"><img src="img/b_drop.png" alt="eliminar" width="16" height="16" border="0" /></a></td>
        <td width="32" align="center" bgcolor="#DBDBDB"><a href="editar_material.php?id_material=<?php echo $fila['id_material']; ?>"><img src="img/b_edit.png" alt="modificar" width="16" height="16" border="0" /></a></td>
        </tr>
      <?php }?>
    </table>
    <table width="100%" height="38" border="0" align="center">
      <tr>
        <td width="50%" height="32" align="left"> 
        <?php 
			if ($inicio!=0) {
		?>
        <a href="listar_material.php?reg=<?php echo $inicio - 10; ?>"><input type="button" name="Anterior" id="Anterior" value="Anterior" /></a>
        <?php } ?>
        </td>
        
        <td width="50%" align="right">
        <?php
		$inicio = $inicio + 10;
		$total_registros = $respuesta[1];
		if ($total_registros>$inicio) {
		?>
        <a href="listar_material.php?reg=<?php echo $inicio; ?>"><input type="button" name="Siguiente" id="Siguiente" value="Siguiente" /></a>
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