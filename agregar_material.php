<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<script language="JavaScript">
function validar_campos(form1)
{  
var prueba = /^(([A-Za-z]+)([A-Za-z]+)?)$/;
var prueba2 = /^(([0-9]+)([0-9]+)?)$/;
if (form1.descripcion.value == "") {
	alert('Debe introducir un material');
	form1.descripcion.focus();
	return (false);
} else {
	if (form1.descripcion.value.match(prueba)==null) {
		alert('El material solo debe poseer letras');
		form1.descripcion.focus();
		return (false);
	}
}
if (form1.existencia.value == "") {
	alert('Debe introducir una cantidad');
	form1.existencia.focus();
	return (false);
} else {
	if (form1.existencia.value.match(prueba2)==null) {
		alert('La cantidad solo debe poseer numeros');
		form1.existencia.focus();
		return (false);
	}
}
if (form1.existenciaminima.value == "") {
	alert('Debe introducir una existencia minima');
	form1.existenciaminima.focus();
	return (false);
} else {
	if (form1.existenciaminima.value.match(prueba2)==null) {
		alert('La existencia minima solo debe poseer numeros');
		form1.existenciaminima.focus();
		return (false);
	}
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
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="form1" name="form1" method="post" onSubmit="validar_campos(this)" action="insertar_material.php">
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="2" align="center"><h2>Agregar Material</h2></td>
    </tr>
    <tr>
      <td align="right">Descripcion</td>
      <td><input name="descripcion" type="text" id="descripcion" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right">Cantidad:</td>
      <td><input name="existencia" type="text" id="existencia" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right">Existencia minima</td>
      <td><input name="existenciaminima" type="text" id="existencia_minima" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="agregar" id="agregar" value="Agregar" /></td>
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