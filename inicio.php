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


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

// Ready: método de jQuery, que revisa si el DOM está listo para usarse. (Solo la estructura)
$(document).ready(function(){
	$("#verificar").click(verificarProfesor); // # siempre precede al mombre del id
	
});
function verificarProfesor() {
	var prueba2 = /^(([0-9]+)([0-9]+)?)$/;
	var valor= $("#ci_pro").attr("value"); // obtiene el valor seleccionado
	var datos = {ci:valor};	// notacion json. atributo ci = valor
	if (form1.ci_pro.value == "") {
	alert('Debe introducir una cedula');
	form1.ci_pro.focus();
	return (false);
} else {
	if (form1.ci_pro.value.match(prueba2)==null) {
		alert('La cedula solo debe poseer numeros');
		form1.ci_pro.focus();
		return (false);
	}
}
	//alert(valor);
	$.ajax({					// para usar ajax
		   async:false,			// Carga del objeto de forma asyncrona
		   type: "POST",		// metodo a utilizar
		   dataType: "json",	// tipo de dato a devolver
		   data: datos,			// datos a enviar
		   contentType: "application/x-www-form-urlencoded",
		   url:"verificarProfesor.php", 	// pagina a invocar
		   success:function(res){			// Permite ejecutar código al ser exitoso un llamado
		   									// function (res) recibe los datos	
    		   if(res[0]!=false){
				    $("#ci_pro").attr("readonly", true);
					var nombre = res[3]+" "+res[4]; 
					$("#nombreProfesor").html(nombre);
					$("#agregar").hide("fast");	
					$("#prestamoE").html("<a href='prestamoEquipo.php?id="+res[0]+"'>Prestamo de Equipos</a>");
					$("#entregaM").html("<a href='entregaMaterial.php?id="+res[0]+"'>Entrega de Materiales</a>");
					$("#devolucion").html("<a href='devolucion.php?id="+res[0]+"'>Devolucion de equipo</a>");
					$("#movimiento").show("fast");				
			   } else {
				    alert("El profesor no se encuentra en el sistema");
					$("#movimiento").hide("fast");	
					$("#agregar").show("fast");	
			   }
		   },
		   timeout:4000,	// tiempo de espera en milisegundos
		   error:function(valor){
			   		alert("No se pudo procesar su consulta. Tiempo límite sobrepasado:"+valor);
					
			    }
		 }); 
		 return false;	
}

</script>
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
    <td width="620" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center" valign="top">
    <?php
    if (isset($_GET['error'])) {
		if ($_GET['error']==2) {?>
			<script language="javascript">	
    alert('No tiene los privilegios para accesar a la pagina');
	</script> <?php }?>
	
    <?php }	?>
    <form id="form1" name="form1" method="post" action="devolucion.php" onSubmit="return validar_campos(this)">
  <table width="100%" border="0" align="center" cellspacing="0" cellpadding="0">
    <tr>
      <td align="right" width="30%">&nbsp;</td>
      <td width="70%">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Cedula Profesor:</td>
      <td><input name="ci_pro" type="text" id="ci_pro" size="15" maxlength="8" />
        <input type="submit" name="verificar" id="verificar" value="Realizar movimiento"  /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><p>&nbsp;</p>
      <div id="agregar" style="display: none;">
      <a href="agregar_profesor.php"><input type="button" name="Agregar Profesor" id="Agregar Profesor" value="Agregar Profesor"/></a>
      </div>
      
      <div id="movimiento" style="display: none;">
        <table width="100%" border="0">
          <tr>
            <td align="right">Nombre del Profesor:</td>
            <td id="nombreProfesor">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td width="30%" align="center" id="prestamoE"></td>
            <td width="50%" align="center" id="entregaM"></td>
            
          </tr>
          <tr>
             <td colspan="2" align="center" id="devolucion"></td>
             </tr>
        </table>
      </div>
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