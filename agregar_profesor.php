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
var prueba = /^(([A-Za-z]+)([A-Za-z]+)?)$/;
var prueba2 = /^(([0-9]+)([0-9]+)?)$/;
if (form1.nombre.value == "") {
	alert('Debe introducir un nombre');
	form1.nombre.focus();
	return (false);
} else {
	if (form1.nombre.value.match(prueba)==null) {
		alert('El nombre solo debe poseer letras');
		form1.nombre.focus();
		return (false);
	}
}
if (form1.apellido.value == ""){
	 alert('Debe introducir un apellido');
	 form1.apellido.focus();
	 return (false);
	} else { 
	 if(form1.apellido.value.match(prueba)==null){ 
        alert('El apellido solo debe poseer letras');
form1.apellido.focus();
return (false);
}
	}
	if (form1.ci_pro.value == "") {
	alert('Debe introducir una cedula');
	form1.ci_pro.focus();
	return (false);
} else {
	if (form1.ci_pro.value.match(prueba2)==null) {
		alert('La cedula solo debe poseer numeros');
		form1.ci_pro.focus();
		return (false);
	}
}
if (form1.nro_carnet.value == "") {
	alert('Debe introducir un numero de empleado');
	form1.nro_carnet.focus();
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
    <td width="178" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="form1" name="form1" method="post" onSubmit="return validar_campos(this)"action="insertar_profesor.php">
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="2" align="center"><font face="calibri"><font face="calibri"><h2>Registro de Profesor</h2></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri"><font face="calibri">Nombre:</td>
      <td ><input name="nombre" type="text" id="nombre" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri"><font face="calibri">Apellido:</td>
      <td><input name="apellido" type="text" id="apellido" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri"><font face="calibri">Cedula:</td>
      <td><input name="ci_pro" type="text" id="ci_pro" size="25" maxlength="8" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri"><font face="calibri">Numero de Empleado:</td>
      <td><input name="nro_carnet" type="text" id="nro_carnet" size="25" maxlength="50" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="registro" id="registro" value="Registrar" /></td>
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