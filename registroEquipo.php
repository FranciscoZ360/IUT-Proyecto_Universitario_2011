<?php 

session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
date_default_timezone_set("America/Caracas");
require ("clases/class_DAO_profesor.php");
require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$equipo = new DAO_equipo();
	$profesor = new DAO_profesor();
	// capturamos los datos del formulario
	$equipos=$_POST['equipos'];
	$id_profesor=$_POST['id'];
	$hora =$_POST['hora'];
	$minutos =$_POST['minutos'];
	$ampm =$_POST['AM_PM'];
	$reg_profesor = $profesor->getProfesor($id_profesor);
	$implode= implode(",",$equipos);
	$ver = $hora.":".$minutos.$ampm;
	$fechaver = date("d/m/Y");
	$horadev = $hora.":".$minutos.$ampm;
	$horadev = strtotime($horadev);
	$horadev = date("Y-m-d H:i:s",$horadev);

	$horaentrega = date("Y-m-d H:i:s");
	$entrega = date("d/m/Y h:i a");
	$i = 0;
	while ($i < count($equipos)) {
		$eq = $equipos [$i];
		list ($tipo,$serial)=explode("-->",$eq);
		$res = $equipo->buscar($serial);
		$id_equipo=$res[0];
		$insert = $equipo->insertarProfMaterial($id_profesor,$id_equipo,$horaentrega,$horadev);
		if ($insert)
			$equipo->cambiarDisponibilidad($id_equipo);
		$i++;
	}
		
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
<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" align="center" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <?php if ($insert) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "PROF-EQUIPO";
		$descripcion = "Se registro un pestamo de"." ".$implode." "."al profesor ".$reg_profesor[3]." ".$reg_profesor[4];
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
		?>
    <p>El Prestamo se ha registrado.</p>
    <?php } else { ?>
    <p>error en la insercion.</p>
    <?php } ?>
      
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del Prestamo</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%"><font face="calibri">Equipo</font></td>
        <td width="62%"><?php echo $implode;?>
        
        
        
         </td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Profesor</td>
        <td><?php echo $reg_profesor[3];?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td bgcolor="#EAEAEA">Hora de Entrega</td>
        <td bgcolor="#EAEAEA"><?php echo $entrega;?></td>
      </tr>
      <tr bgcolor="#DBDBDB">
        <td>Hora de  Devolucion</td>
        <td><?php echo $fechaver." ".$ver;?></td>
      </tr>
      </table>
	  <table width="200" border="0" align="center">
      <tr>
        <td align="center"><p>&nbsp;</p>
          <p><a href="prestamoEquipo.php?id=<?php echo $id_profesor;?>">VOLVER AL PRESTAMO DE EQUIPO</a></p></td>
      </tr>
    </table>
    <p>&nbsp;</p></td>
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