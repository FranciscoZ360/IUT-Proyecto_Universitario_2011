<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_profesor.php");

// crea el objeto dao usuario
try {
	$profesor = new DAO_profesor(); 
	//se captura el id del dato que se va a editar
	$id_profesor = $_GET['id_profesor'];
	// se ejecuta
	$fila = $profesor->getProfesor($id_profesor);
	
}   catch (Exception $e) {
	header("Location: errorsistema.php");
	exit;
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
       <p><h2>Editar Profesor</h2></p> 
    <form id="form1" name="form1" method="post" action="modificar_profesor.php">
      <table width="100%" border="0" align="center">
        <tr>
          <td align="right">Nro carnet:</td>
          <td><input name="nro_carnet" type="text" id="nro_carnet" size="15" maxlength="15" value="<?php echo $fila['nro_carnet'] ?>"/></td>
        </tr>
        <tr>
          <td align="right"><font face="calibri">C</font>edula:</td>
          <td><input name="ci_pro" value="<?php echo $fila['ci_pro'] ?>" type="text" id="ci_pro" size="15" maxlength="8" /></td>
        </tr>
        <tr>
          <td align="right">Nombre<font face="calibri">:</font></td>
          <td><input name="nombre" type="text" id="nombre" size="15" maxlength="15" value="<?php echo $fila['nombre'] ?>"/></td>
        </tr>
        <tr>
          <td align="right">Apellido:</td>
          <td><input name="apellido" type="text" id="textfield" value="<?php echo $fila['apellido'] ?>" size="15" maxlength="15" /></td>
        </tr>
        <tr align="center">
          <td colspan="2"><p>&nbsp;
            </p>
            <p>
              <input type="submit" name="modificar" id="modificar" value="Modificar" /> 
              <input type="hidden" name="idp" id="idp" value="<?php echo $id_profesor; ?>"/>
              <input type="hidden" name="viejo" id="viejo" value="<?php echo $fila['nro_carnet'] ?>"/>
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
</font>
<p>&nbsp;</p>
</body>
</html>