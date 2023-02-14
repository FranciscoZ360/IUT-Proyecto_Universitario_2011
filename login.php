<?php 
session_start();
if (isset($_SESSION['usuario'])) {
	// redirecciona a inicio
	header("Location: inicio.php");
	exit; // detenga el script
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body><font face="calibri">
<form id="form1" name="form1" method="post" action="autenticar.php">
  <table width="759" height="424" border="0" align="center">
    <tr>
      <td background="img/Fondo-login.png"><p>&nbsp;</p>
        <table width="331" border="0" align="center">
    <tr>
      <td colspan="3" align="center"><p>Bienvenido</p></td>
    </tr>
    <tr>
      <td height="32" colspan="3" align="right">
      <?php 
	  
	  if (isset($_GET['error'])){
	  	if ($_GET['error']==1) {?>
		
		<script language="javascript">	
    alert('Usuario no encontrado, intente de nuevo');
	</script> <?php }?>
    <?php 
		if ($_GET['error']==2) { ?>
			
			<script language="javascript">	
    alert('Usuario no autorizado.. Ingrese sus datos.');
	</script> <?php }?>
    
	 <?php }
	  ?>
      </td>
      </tr>
    <tr>
      <td width="72" height="32" align="right"><font face="calibri">Usuario:</td>
      <td width="152"><input name="usuario" type="text" id="usuario" size="20" maxlength="25" /></td>
      <td width="93"> <img src="img/icono_login.png" width="22" height="31" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Contraseña:</td>
      <td><input name="contrasena" type="password" id="contrasena" size="20" maxlength="25" /></td>
      <td><img src="img/icono_login (1).png" width="30" height="31" /></td>
    </tr>
    <tr align="center">
      <td colspan="3"><input type="submit" name="entrar" id="entrar" value="          Entrar          " /><font face="calibri"></td>
    </tr>
    <tr>
      <td colspan="3" align="center"><p>&nbsp;</p>
        <p><a href="olvido_password.php"><font face="calibri">¿Olvido su contraseña?</a></p></td>
    </tr>
  </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>