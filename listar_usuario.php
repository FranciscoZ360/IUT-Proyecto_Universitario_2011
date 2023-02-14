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


require ("clases/class_DAO_usuario.php");
// crea el objeto dao usuario
try {
	define ("jefe", "Jefe");
	define ("secre", "Secretaria");
	$usuario = new DAO_usuario(); 
	$res = $usuario->listar();}
	
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
	var texto = confirm("¿Esta seguro que desea eliminar este Usuario?");
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
    
    <center><p><h2><font face="calibri">Listado de Usuarios</h2></p></center>
    <table width="100%" border="0" align="center">
      <tr>
        <td width="168" bgcolor="#EAEAEA"><font face="calibri">Nombre</td>
        <td width="153" bgcolor="#DBDBDB"><font face="calibri">Apellido</td>
        <td width="73" bgcolor="#EAEAEA"><font face="calibri">Nivel</td>
        <td width="75" bgcolor="#DBDBDB"><font face="calibri">Cargo</td>
        <td colspan="2" bgcolor="#EAEAEA"><font face="calibri">Opciones</td>
      </tr>
      <?php 
  // se obtiene el total de registros de la consulta
  $total = count($res);
  for ($i=0; $i<$total; $i++) {
	  $fila = $res[$i];
	   ?>
      <tr>
        <td bgcolor="#EAEAEA"><?php echo $fila['nombre']; ?></td>
        <td bgcolor="#DBDBDB"><?php echo $fila['apellido']; ?></td>
        <td bgcolor="#EAEAEA"><?php if ($fila['nivel'] == 1){
			echo jefe ;
			} else {
				echo secre;
				} ;?> </td>
        <td bgcolor="#DBDBDB"><?php echo $fila['cargo']; ?> </td>
        <td width="40" align="center" bgcolor="#EAEAEA" ><a onClick="return eliminar();" href="eliminar_usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>"><img src="img/b_drop.png" width="16" height="16" border="0" /></a></td>
        <td width="28" align="center" bgcolor="#EAEAEA"> <a href="editar_usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>"> <img src="img/b_edit.png" alt="modificar" width="16" height="16" border="0" /></a></td>
      </tr>
      <?php }?>
    </table>
    <p>&nbsp;</p></td>
  
  <!-- Tercera fila: Pie de Pagina  -->
  <tr>
    <td colspan="2"><?php require("require/piepagina.html"); ?></td>
  </tr>
  
</table>
</font>
</body>
</html>