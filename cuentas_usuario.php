<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php
require("menu.php");
?>
<table width="200" border="0" align="center">
  <tr>
    <td align="center">Cuentas de usuarios</td>
  </tr>
  <tr>
    <form action="agregar_usuario.php">
      <td align="center"><input type="submit" name="agregar_u" id="agregar_u" value="Agregar usuario" /></td></form>
  </tr>
  <tr>
    <form action="modificar_usuario.php">
      <td align="center"><input name="modificar_u" type="submit" id="modificar_u" value="Modificar usuario" /></td></form>
  </tr>
  <tr>
    <form action="eliminar_usuario.php">
      <td align="center"><input type="submit" name="eliminar_u" id="eliminar_u" value="Eliminar usuario" /></td></form>
  </tr>
</table>
</body>
</html>