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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>
<script language="JavaScript">
function validar_campos(form1)
{  
var prueba = /^(([A-Za-z]+)([A-Za-z]+)?)$/;
var prueba2 = /^[a-z\d_]{4,25}$/;
var prueba3 = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{8,10})$/;
if (form1.nombre.value == "") {
	alert('Debe introducir un nombre');
	form1.nombre.focus();
	return (false);
} else {
	if (form1.nombre.value.match(prueba)==null) {
		alert('El nombre solo debe poseer letras');
		form1.nombre.focus();
		return (false);
	}
}
if (form1.apellido.value == ""){
	 alert('Debe introducir un apellido');
	 form1.apellido.focus();
	 return (false);
	} else { 
	 if(form1.apellido.value.match(prueba)==null){ 
        alert('El apellido solo debe poseer letras');
form1.apellido.focus();
return (false);
}
	}
	if (form1.cargo.value == ""){
	 alert('Debe introducir un cargo');
	 form1.cargo.focus();
	 return (false);
	} else { 
	 if(form1.cargo.value.match(prueba)==null){ 
        alert('El cargo solo debe poseer letras');
form1.cargo.focus();
return (false);
}
	}
	
	if (form1.login.value == ""){
	 alert('Debe introducir un nombre de usuario');
	 form1.login.focus();
	 return (false);
	} else { 
	 if(form1.login.value.match(prueba2)==null){ 
        alert('El nombre de usuario no debe poseer caracteres especiales');
form1.login.focus();
return (false);
}
	}
	
if (form1.contrasena.value.match(prueba3)==null){
	alert('La contraseña debe contener entre 8 a 10 caracteres, por lo menos un digito y un alfanumérico y no puede contener caracteres especiales');
form1.contrasena.focus();
return (false);
}
		
	
if (form1.contrasena.value != form1.confirmar.value){
alert("La contraseña escrita no coincide con la confirmacion");
form1.confirmar.focus();
return (false);
}
if (form1.respuesta.value == ""){
	 alert('Debe introducir una respuesta');
	 form1.respuesta.focus();
	 return (false);
	} else { 
	 if(form1.respuesta.value.match(prueba)==null){ 
        alert('La respuesta solo debe poseer letras');
form1.respuesta.focus();
return (false);
}
	}
}

</script>    
<body><font face="calibri">
<table width="800"  height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="180" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center">
    <center><h2><font face="calibri">Registro de Usuario</h2></center>
    <form id="form1" name="form1" method="post" onSubmit="return validar_campos(this);" action="insertar_usuario.php">
  <table width="100%" border="0" align="right">
    <tr>
      <td colspan="2" align="center">*(Todos los campos son obligatorios)</td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Nombre:</td>
      <td><input name="nombre" type="text" id="nombre" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Apellido:</td>
      <td><input name="apellido" type="text" id="apellido" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Cargo:</td>
      <td><input name="cargo" type="text" id="cargo" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Nombre de Usuario:</td>
      <td><input name="login" type="text" id="login" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Contraseña:</td>
      <td><input name="contrasena"  type="password" id="contrasena" size="25" maxlength="10" /></td>
        <td><code><samp>(Debe poseer de 8 a 10 <font face="calibri">caracteres alfanuméricos)</font></samp></code></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Confirmar Contraseña:</td>
      <td><input name="confirmar"  type="password" id="confirmar" size="25" maxlength="25" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Nivel:</td>
      <td><font face="calibri">Jéfe
        <input name="nivel" type="radio" id="nivel" value="1" />
        <font face="calibri">Secretaria
        <input name="nivel" type="radio" id="nivel" value="2" checked="checked" /></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Pregunta Secreta:</td>
      <td><select name="pregunta" size="1" id="pregunta">
        <option value="1" selected="selected">Nombre de tu abuela paterna</option>
        <option value="2">Nombre de tu colegio</option>
        <option value="3">Nombre de tu mascota</option>
        <option value="4">Tu comida favorita</option>
        <option value="5">Tu color favorito</option>
      </select></td>
    </tr>
    <tr>
      <td align="right"><font face="calibri">Respuesta:</td>
      <td><input name="respuesta" type="text" id="respuesta" size="25" maxlength="50" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="registro" id="registro" value="Registrar"/></td>
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