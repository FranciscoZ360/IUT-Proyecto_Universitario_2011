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
<!-- LIBRERÍAS PARA EL CALENDARIO -->
<link href= "css/css-calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/calendar-es.js"></script>
<script type="text/javascript" src="js/calendar-setup.js"></script>		
<!-- FIN DE LAS LIBRERÍAS PARA EL CALENDARIO -->
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
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center" valign="top"><form id="form1" name="form1" method="post" action="reFechMaterial.php">
      <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center"><h3>Reporte de <font face="calibri">entrega de material</font> por Fecha</h3>
        <p>&nbsp;</p></td>
      </tr>
      <tr>
      <td align="center">
        <p><font face="calibri">Desde</font>: 
          <label for="fecha_ini"></label>
          <input name="fecha_ini" type="text" id="fecha_ini" size="15" readonly="readonly">
          <img src="img/cron.jpg" name="buttoncal1" width="16" height="16" id="buttoncal1"> 
      <script type="text/javascript">
				Calendar.setup(
				{
				inputField  : "fecha_ini", 
				ifFormat    : "y-mm-dd",
				button      : "buttoncal1" 
				});
	  </script>
           Hasta: 
           <input name="fecha_fin" type="text" id="fecha_fin" size="15" readonly="readonly">
           <img src="img/cron.jpg" name="buttoncal2" width="16" height="16" id="buttoncal2"> 
      <script type="text/javascript">
				Calendar.setup(
				{
				inputField  : "fecha_fin", 
				ifFormat    : "y-mm-dd",
				button      : "buttoncal2" 
				});
	  </script>
           <br>
        </p></td>
      </tr>
    <tr>
      <td align="center"><p><br>
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