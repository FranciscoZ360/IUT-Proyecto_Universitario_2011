<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
require ("clases/class_DAO_usuario.php");
try {
	$usuario = new DAO_usuario();
	// capturamos los datos del formulario
	$id = $_SESSION['id'];
	$contrasena = $_POST['contrasena'];
	$nvacontrasena = $_POST['nuevacontrasena'];
	
    
	$res = $usuario->CambiarContrasena($id,$contrasena,$nvacontrasena);

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
<table width="800"  height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <center>
      Detalle de la operacion:</center>
    <form id="form1" name="form1" method="post" onSubmit="return validar_campos(this);" action="contrasena_cambiada.php">
  <table width="100%" border="0" align="right">
    <tr>
      <td align="center"><?php if ($res){ 
          echo "Su contraseña ha sido cambiada";
	  }else{
		  echo "error!";}
		    
		  
		  ?>
          
          </td>
    </tr>
    <tr>
      <td align="right"><font face="calibri"></td>
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