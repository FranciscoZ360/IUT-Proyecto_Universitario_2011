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
	// capturamos los datos del formulario
	$login = ($_POST['login']);
	$contraseña = $_POST['contrasena'];
	$nombre = strtoupper($_POST['nombre']);
	$apellido = strtoupper($_POST['apellido']);
	$nivel= $_POST['nivel'];
	$pregunta=$_POST['pregunta'];
	$respuesta = $_POST['respuesta'];
	$cargo = strtoupper($_POST['cargo']);
	// se inserta
	$res = $usuario->insertar($login, $contraseña, $nombre, $apellido, $nivel,
							  $pregunta, $respuesta, $cargo);
	if ($res) {
		// hacemos auditoria
		require ("clases/class_DAO_auditoria.php");
		date_default_timezone_set("America/Caracas");
		$auditoria = new DAO_auditoria();
		$accion = "INSERTAR";
		$tabla = "USUARIO";
		$descripcion = "Agrego al usuario : $nombre $apellido";
		$auditoria->auditar ($_SESSION['usuario'], $accion, $tabla, $descripcion ,date("Y-m-d H:i:s"));
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
    <?php if ($res) { ?>
    <p>Se ha registrado un nuevo usuario.</p>
    
    <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center">Datos del Usuario</td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td width="38%">Nombre:</td>
        <td width="62%"><?php echo $nombre; ?></td>
      </tr>
      <tr>
        <td bgcolor="#DBDBDB">Apellido:</td>
        <td bgcolor="#DBDBDB"><?php echo $apellido; ?></td>
      </tr>
      <tr bgcolor="#EAEAEA">
        <td>Cargo:</td>
        <td><?php echo $cargo; ?></td>
      </tr>
      <tr>
        <td bgcolor="#DBDBDB">Nombre de Usuario:</td>
        <td bgcolor="#DBDBDB"><?php echo $login; ?></td>
      </tr>
      <tr>
        <td bgcolor="#EAEAEA">Nivel:</td>
        <td bgcolor="#EAEAEA"><?php if($nivel==1)
		echo "Jefe"; 
		else
		if($nivel==2)
		echo "Secretaria"; ?></td>
      </tr>
      <tr>
        
        </tr><td colspan="2" align="center"><p>&nbsp;</p>
            <p><a href="agregar_usuario.php">VOLVER AL REGISTRO DE USUARIO</a></p></td>
      </table>
       <?php } else { ?>
     <script language="javascript">
    alert('Error!, usuario existente, intente de nuevo!');
	

	</script>
    <?php } 
	
	?>
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