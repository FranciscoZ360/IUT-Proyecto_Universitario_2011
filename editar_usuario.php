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
	$usuario = new DAO_usuario(); 
	//se captura el id del dato que se va a editar
	$id_usuario = $_GET['id_usuario'];
	// se ejecuta
	$fila = $usuario->getUsuario($id_usuario);
	
}   catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body><font face="calibri">
 <table width="800" height="570" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="129"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="971" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
       <p><font face="calibri"> <h2>Editar Usuario</h2></p> 
    <form id="form1" name="form1" method="post" action="modificar_usuario.php">
      <table width="100%" border="0" align="center">
        <tr>
          <td width="50%" align="right">Nombre:</td>
          <td width="50%"><input name="nombre" type="text" id="nombre" size="15" maxlength="15" value="<?php echo $fila['nombre'] ?>"/></td>
        </tr>
        <tr>
          <td align="right">Apellido:</td>
          <td><input name="apellido" value="<?php echo $fila['apellido'] ?>" type="text" id="apellido" size="15" maxlength="15" /></td>
        </tr>
        <tr>
          <td align="right">Nivel:</td>
          <td><input name="nivel" type="radio"  id="radio3" value="1"  <?php if($fila['nivel']==1) echo "checked='checked'" ?> />
            Jefe
              <input type="radio" name="nivel" id="radio4" value="2" <?php if($fila['nivel']==2) echo "checked='checked'" ?>/>
Secretaria </td>
        </tr>
        <tr>
          <td align="right">Cargo:</td>
          <td><input name="cargo" type="text" id="textfield" value="<?php echo $fila['cargo'] ?>" size="15" maxlength="50" /></td>
        </tr>
        <tr align="center">
          <td colspan="2"><p><a href="listar_usuario.php">            </a>
            </p>
            <p>
              <input type="submit" name="modificar" id="modificar" value="Modificar" /> 
              <input type="hidden" name="idp" id="idp" value="<?php echo $id_usuario; ?>"/>
              <input type="hidden" name="viejo" id="viejo" value="<?php echo $fila['nombre']." ".$fila['apellido'] ?>"/>
            </p>
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

<p>&nbsp;</p>
</font>
</body>
</html>