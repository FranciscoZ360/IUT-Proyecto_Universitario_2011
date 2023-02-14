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
var prueba2 = /([a-z]+[0-9]+)|([0-9]+[a-z]+)/;
if (form1.tipo.value == "") {
	alert('Debe introducir un equipo');
	form1.tipo.focus();
	return (false);
} else {
	if (form1.tipo.value.match(prueba)==null) {
		alert('El equipo solo debe poseer letras');
		form1.tipo.focus();
		return (false);
	}
}
if (form1.marca.value == "") {
	alert('Debe introducir una marca');
	form1.marca.focus();
	return (false);
} else {
	if (form1.marca.value.match(prueba)==null) {
		alert('La marca solo debe poseer letras');
		form1.marca.focus();
		return (false);
	}
}
if (form1.serial.value == "") {
	alert('Debe introducir un serial');
	form1.serial.focus();
	return (false);
} else {
	if (form1.serial.value.match(prueba2)==null) {
		alert('El serial debe ser alfanumérico');
		form1.serial.focus();
		return (false);
	}
}
}
</script>
<body>
<table width="800"  height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="178" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="form1" name="form1" method="post" onSubmit="return validar_campos(this)"action="insertar_equipo.php">
      <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center"><table width="271" border="0" align="center">
          <tr>
            <td colspan="2" align="center"><h2><font face="calibri">Agregar Equipo</font></h2></td>
          </tr>
          <tr>
            <td width="45" align="right"><font face="calibri"><font face="calibri">Tipo:</font></font></td>
            <td width="216"><input name="tipo" type="text" id="tipo" size="25" maxlength="25" /></td>
          </tr>
          <tr>
            <td align="right"><font face="calibri"><font face="calibri">Marca:</font></font></td>
            <td><input name="marca" type="text" id="marca" size="25" maxlength="25" /></td>
          </tr>
          <tr>
            <td align="right"><font face="calibri"><font face="calibri">Serial:</font></font></td>
            <td><input name="serial" type="text" id="serial" size="25" maxlength="25" /></td>
          </tr>
          <tr>
            <td align="right"><font face="calibri"><font face="calibri">Status:</font></font></td>
            <td align="center"><input name="status" type="radio" id="radio" value="HABILITADO" checked="checked" />
              <font face="calibri">Habilitado /
                <input type="radio" name="status" id="radio2" value="DESHABILITADO" />
                Desabilitado</font></td>
          </tr>
          <tr>
            <td colspan="2" align="center"><input type="submit" name="agregar" id="agregar" value="Agregar" /></td>
          </tr>
        </table>          <h3>&nbsp;</h3></td>
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