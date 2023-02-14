<?php 
require ("clases/class_DAO_usuario.php");
// crea el objeto dao usuario
try {
	$usuario = new DAO_usuario();
	// capturamos los datos del formulario
	$login=$_POST['recuperacion'];
	$respuesta=$_POST['respuesta'];
	// se inserta
	$res = $usuario->cambiarPassword($login, $respuesta);
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
  <table width="759" height="424" border="0" align="center">
    <tr>
      <td background="img/Fondo-login.png"><p>&nbsp;</p>
        <table width="75%" border="0" align="center">
    <tr>
      <td width="399" align="center">
        <p><h3>Recuperación de Contraseña</h3></p>
        <p>
          <?php if ($res) { ?>
          Su contraseña ha sido cambiada.<br />
          Ingrese al sistema colocando en el campo contraseña el mismo nombre de usuario.<br />
          Por seguridad cambie la contraseña al ingresar al sistema.
 		</p>
        <a href="login.php">Ingrese aquí</a>
        <p>
  <?php } else { ?>
          Su respuesta no es correcta. Vuelva a intentarlo.
        </p>        
		<a href="olvido_password.php">Intentar Nuevamente</a>
		<?php   }  ?>
        </td>
    </tr>
    </table></td>
    </tr>
  </table>
   </font>  
</body>
</html>