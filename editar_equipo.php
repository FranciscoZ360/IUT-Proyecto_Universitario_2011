<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}



require ("clases/class_DAO_equipo.php");

// crea el objeto dao equipo
try {
	$equipo = new DAO_equipo(); 
	//se captura el id del dato que se va a editar
	$id_equipo = $_GET['id_equipo'];
	// se ejecuta
	$fila = $equipo->getEquipo($id_equipo);
	
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
    <td width="180"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
       <p><h2>Editar Equipo</h2></p> 
    <form id="form1" name="form1" method="post" action="modificar_equipo.php">
      <table width="100%" border="0" align="center">
        <tr>
          <td align="right">Descripcion:</td>
          <td><input name="tipo" type="text" id="tipo" size="15" maxlength="15" value="<?php echo $fila['descripcion'] ?>"/></td>
        </tr>
        <tr>
          <td align="right">Marca:</td>
          <td><input name="marca" value="<?php echo $fila['marca'] ?>" type="text" id="marca" size="15" maxlength="15" /></td>
        </tr>
        <tr>
          <td align="right">Serial</td>
          <td><input name="serial" type="text" id="serial" size="15" maxlength="15" value="<?php echo $fila['serial'] ?>" /></td>
        </tr>
        <tr>
          <td align="right">Status:</td>
          <td><input name="status" type="radio"  id="radio3" value="habilitado"  <?php if($fila['status']=='HABILITADO') echo "checked='checked'" ?> />
            Hab /
               <input type="radio" name="status" id="radio4" value="deshabilitado" <?php if($fila['status']=='DESHABILITADO') echo "checked='checked'" ?>/>
              Des</td>
        </tr>
        <tr align="center">
          <td colspan="2"><p>&nbsp;
            </p>
            <p>
              <input type="submit" name="modificar" id="modificar" value="Modificar" /> 
              <input type="hidden" name="idp" id="idp" value="<?php echo $id_equipo; ?>"/>
              <input type="hidden" name="serial_viejo" id="serial_viejo" value="<?php echo $fila['serial'] ?>"/>
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