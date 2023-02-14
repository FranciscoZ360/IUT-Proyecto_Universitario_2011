<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<script language="JavaScript">
function validar_campos(form1){
	var prueba2 = /^(([0-9]+)([0-9]+)?)$/;
	if (form1.cedula.value == "") {
	alert('Debe introducir una cedula');
	form1.cedula.focus();
	return (false);
} else {
	if (form1.cedula.value.match(prueba2)==null) {
		alert('La cedula solo debe poseer numeros');
		form1.cedula.focus();
		return (false);
	}
}
	}
</script> 
</head>

<body marginheight="0" marginwidth="0"><font face="calibri">
<table width="800" height="570" border="0" cellspacing="0" cellpadding="0" align="center" >
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center" valign="top"><form id="form1" name="form1" method="post" onSubmit="return validar_campos(this)" action="reProMaterial.php">
      <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center"><h3>Reporte deEntrega de Material por Profesor</h3>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
      <td align="center">
        <p>
          <label>
            Cedula Profesor:
              <input name="cedula" type="text" id="cedula" value="">
          </label>
        </p>
        <p>&nbsp;</p></td>
      </tr>
    <tr>
      <td align="center"><p>
        <input type="submit" name="verificar" id="verificar" value="Generar Reporte" />
        </p></td>
      
      </tr>
    <tr>
      <td align="center"><p>&nbsp;</p>
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