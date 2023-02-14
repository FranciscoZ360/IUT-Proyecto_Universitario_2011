<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_material.php");

// crea el objeto dao material
try {
	$material = new DAO_material(); 
	//se captura el id del dato que se va a editar
	$id_material = $_GET['id_material'];
	// se ejecuta
	$fila = $material->getMaterial($id_material);
	
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
<table width="799" height="570" border="0" align="center" cellpadding="0" cellspacing="0">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="619" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
       <p><h2>Editar Material</h2></p> 
    <form id="form1" name="form1" method="post" action="modificar_material.php">
      <table width="100%" border="0" align="center">
        <tr>
          <td align="right">Descripcion</td>
          <td><input name="descripcion" type="text" id="descripcion" size="15" maxlength="15" value="<?php echo $fila['descripcion'] ?>"/></td>
        </tr>
        <tr>
          <td align="right">Cantidad</td>
          <td><input name="cantidad" value="<?php echo $fila['existencia'] ?>" type="text" id="cantidad" size="15" maxlength="15" /></td>
        </tr>
        <tr>
          <td align="right">Existencia minima</td>
          <td><input name="existenciaminima" type="text" id="existenciaminima" size="15" maxlength="15" value="<?php echo $fila['existencia_minima'] ?>"/></td>
        </tr>
        <tr align="center">
          <td colspan="2"><p>&nbsp;
            </p>
            <p>
              <input type="submit" name="modificar" id="modificar" value="Modificar" /> 
              <input type="hidden" name="idp" id="idp" value="<?php echo $id_material; ?>"/>
              <input type="hidden" name="viejo" id="viejo" value="<?php echo $fila['descripcion']." ".$fila['existencia'] ?>"/>
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