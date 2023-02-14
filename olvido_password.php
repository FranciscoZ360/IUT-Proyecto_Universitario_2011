<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
// Ready: método de jQuery, que revisa si el DOM está listo para usarse. (Solo la estructura)
$(document).ready(function(){
	$("#verificar").click(verificarUsuario); // # siempre precede al mombre del id
	
});

function verificarUsuario() {
	var valor= $("#recuperacion").attr("value"); // obtiene el valor seleccionado
	var datos = {login:valor};	// notacion json. atributo login = valor
	$.ajax({					// para usar ajax
		   async:true,			// Carga del objeto de forma asyncrona
		   type: "POST",		// metodo a utilizar
		   dataType: "json",	// tipo de dato a devolver
		   data: datos,			// datos a enviar
		   contentType: "application/x-www-form-urlencoded",
		   url:"recuperarPregunta.php", 	// pagina a invocar
		   success:function(res){			// Permite ejecutar código al ser exitoso un llamado
		   									// function (res) recibe los datos	
			   if(res[0]!=false){
				    $("#recuperacion").attr("readonly", true);
					$("#pregunta").html(res[0]);   
					$("#mostrarPregunta").show("fast");				
			   } else {
				    alert("Usuario Inválido.");
			   }
		   },
		   timeout:4000,	// tiempo de espera en milisegundos
		   error:function(valor){
			   		alert("No se pudo procesar su consulta. Tiempo límite sobrepasado:"+valor);
					
			    }
		 }); 	
}
</script>

</head>

<body><font face="calibri">
<form id="form1" name="form1" method="post" action="nuevo_password.php">
  <table width="759" height="424" border="0" align="center">
    <tr>
      <td background="img/Fondo-login.png"><p>&nbsp;</p>
        <table width="75%" border="0" align="center">
    <tr>
      <td colspan="2" align="center">
        <p><h3>Recuperación de Contraseña</h3></p></td>
    </tr>
    <tr>
      <td width="30%" align="right">Usuario:</td>
      <td width="70%"><input name="recuperacion" type="text" id="recuperacion" size="31" maxlength="15" />
      <a id="verificar" href="#"><img src="img/icono_login.png" width="17" height="23" border="0" /></a>
      </td>
    </tr>
  

    <tr align="center">
      <td colspan="2">
      <div id ="mostrarPregunta" style="display: none;">  
      <table width="100%" border="0">
            <tr>
              <td width="30%" align="right">
              Pregunta Secreta:
              </td>
      		  <td width="70%" id="pregunta"></td>
      <td width="22">&nbsp;</td>
    </tr>
    <tr>
      <td align="right">Respuesta:</td>
      <td width="283"><input name="respuesta" type="text" id="respuesta" size="31" maxlength="50" /></td>
      <td width="22">&nbsp;</td>
    </tr>
        <tr align="center">
      <td colspan="3"><input type="submit" name="verificar" id="verificar" value="Aceptar" /></td>
    </tr>

      </table>
      </div>
      </td>
    </tr>
    
  </table></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
</font>
</body>
</html>