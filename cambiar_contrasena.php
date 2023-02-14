<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
	
}

	?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script language="JavaScript">
function validar_campos(form1)
{
var prueba = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;

if (form1.nuevacontrasena.value.match(prueba)==null){
	alert('La contraseña debe contener entre 8 a 10 caracteres, por lo menos un digito y un alfanumérico y no puede contener caracteres especiales');
form1.contrasena.focus();
return (false);
}

	
if (form1.nuevacontrasena.value != form1.confirmacion.value){
alert("La contraseña escrita no coincide con la confirmacion");
form1.nuevacontrasena.focus();
return (false);
}
}
</script> 
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
      <h2>Cambio de contraseña</h2></center>
    <form id="form1" name="form1" method="post" onSubmit="return validar_campos(this);" action="contrasena_cambiada.php">
  <table width="100%" border="0" align="right">
    <tr>
      <td colspan="2" align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Contraseña Actual:</td>
      <td><input name="contrasena" type="password" id="contrasena" size="25" maxlength="10" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Nueva Contraseña:</td>
      <td><input name="nuevacontrasena" type="password" id="nuevacontrasena" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right">Confirme nueva contraseña:</td>
      <td><input name="confirmacion" type="password" id="confirmacion" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="registro" id="registro" value="Aceptar"/>
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