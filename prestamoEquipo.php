<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
require ("clases/class_DAO_equipo.php");
// crea el objeto dao usuario
try {
	$equipo = new DAO_equipo();
	

$reg = $equipo->getDescripcionEquipos();
}
catch (Exception $e){
header("Location: errorsistema.php");
	exit;	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
// Ready: método de jQuery, que revisa si el DOM está listo para usarse. (Solo la estructura)
$(document).ready(function(){
	$("#descripcion").change(cargarMarca); 
	$("#agregar").click(cargarEquipos);
	$("#eliminar").click(eliminarEquipos);
});

function eliminarEquipos(){
	$("#equipos option").each(function(){
		if($(this).attr("selected")){
			$(this).remove();
		}
	});
	return false;
}

function cargarEquipos(){
	var valor= $("#descripcion").attr("value")+"-->"+$("#serial").attr("value");
	var ver= $("#descripcion").attr("value")+"-->"+$("#serial").attr("value");
	var option="";
	var existe=false;
	if(valor!="0"){
		$("#equipos option").each(function(){
			if($(this).attr("value")==valor)
				existe=true;
		});
		if(existe==false){
			option="<option value='"+ver+"'>"+ver+"</option>";
			$("#equipos").append(option);
		}
	}
	return false;
	
}
function validarLista(action1){
if(action1.equipos.value==""){
alert("Debe seleccionar los elementos en la lista");
	return (false);
	
}
	
}

function cargarMarca() {
	var valor= $("#descripcion").attr("value"); // obtiene el valor seleccionado
	var datos = {des:valor};	// notacion json. atributo des = valor
	$.ajax({					// para usar ajax
		   async:true,			// Carga del objeto de forma asyncrona
		   type: "POST",		// metodo a utilizar
		   dataType: "json",	// tipo de dato a devolver
		   data: datos,			// datos a enviar
		   contentType: "application/x-www-form-urlencoded",
		   url:"cargarListaMarca.php", 	// pagina a invocar
		   success:function(res){			
		   	var marca = "<option value='0'>elige marca</option>";
			var serial = "<option value='0'>elige serial</option>";
			   if(res[0]!=false){
				    var i=0;
					while (i < res.length) {
				    	marca += "<option value='"+res[i]+"'>"+res[i]+"</option>";
						i++;
					}
			   }
			   $("#marca").html(marca);
			   $("#serial").html(serial);
			   $("#marca").change(cargarSerial);
		   },
		   timeout:10000,	// tiempo de espera en milisegundos
		   error:function(valor){
			   		alert("No se pudo procesar su consulta. Tiempo límite sobrepasado:"+valor);
					
			    }
		 }); 	
}

function cargarSerial() {
	var descripcion= $("#descripcion").attr("value");
	var marca= $("#marca").attr("value");
	var datos = {des:descripcion,mar:marca};	// notacion json. atributo login = valor
	$.ajax({					// para usar ajax
		   async:true,			// Carga del objeto de forma asyncrona
		   type: "POST",		// metodo a utilizar
		   dataType: "json",	// tipo de dato a devolver
		   data: datos,			// datos a enviar
		   contentType: "application/x-www-form-urlencoded",
		   url:"cargarListaSerial.php", 	// pagina a invocar
		   success:function(res){			
		   	var serial = "<option value='0'>elige serial</option>";
			   if(res[0]!=false){
				    var i=0;
					while (i < res.length) {
				    	serial += "<option value='"+res[i]+"'>"+res[i]+"</option>";
						i++;
					}
			   }
			   $("#serial").html(serial);
		   },
		   timeout:10000,	// tiempo de espera en milisegundos
		   error:function(valor){
			   		alert("No se pudo procesar su consulta. Tiempo límite sobrepasado:"+valor);
					
			    }
		 }); 	
}
</script>
</head>
<body><font face="calibri">
<table width="800"  height="570" border="0" cellspacing="0" cellpadding="0" align="center">
  <!-- Primera fila: Banner -->
  <tr>
    <td colspan="2"><?php require("require/banner.php"); ?></td>
  </tr>
  <!-- Segunda fila: Menu y Contenido  -->
  <tr>
    <td width="178" valign="top"><?php require("require/menu.php"); ?></td>
    
    <!-- contenido de la pagina -->
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="action1" name="action1" method="post" onSubmit="return validarLista(this);" action="registroEquipo.php">
      <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center"><table width="100%" border="0" align="center">
          <tr>
          
            <td colspan="4" align="center"><h2>Prestamo de Equipo</h2></td>
          </tr>
         
          <tr>
        
            <td width="159" align="right">Descripcion:              </td>
            <td width="107" align="right"><select name="descripcion" id="descripcion">
              <option value="0" selected="selected" id="0" >elige equipo</option>
              <?php
		 $i = 0;
			while($i < count($reg)){
			 echo "<option value=".$reg[$i].">".$reg[$i]."</option>";
			 $i++;
               }
			   ?>
            </select></td>
            <td width="135">&nbsp;</td>
            <td width="195" rowspan="3"><label for="equipos"></label>

              <select name="equipos[]" size="4" multiple="MULTIPLE" id="equipos" style="width:200px">
</select></td>
          </tr>
          <tr>
            <td align="right">Marca:              </td>
            <td align="right"><select name="marca" id="marca">
              <option value="0">elige marca</option>
            </select></td>
            <td align="center"><input type="submit" name="agregar" id="agregar" value="Agregar&gt;&gt;" /></td>
            </tr>
          <tr>
            <td align="right">Serial:              </td>
            <td align="right"><select name="serial" id="serial">
              <option value="0">elige serial</option>
            </select></td>
            <td align="center"><input type="submit" name="eliminar" id="eliminar" value="&lt;&lt;Eliminar" /></td>
            </tr>
          <tr>
            <td colspan="4" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center">Hora de Devoluci&oacute;n: 
              <label for="minutos"></label>
              <select name="hora" id="hora">
                <option value="1" selected="selected">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select> 
              : 
              <select name="minutos" id="minutos">
                <option value="00">00</option>
                <option value="05">05</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
                <option value="25">25</option>
                <option value="30">30</option>
                <option value="35">35</option>
                <option value="40">40</option>
                <option value="45">45</option>
                <option value="50">50</option>
                <option value="55">55</option>
              </select> 
              - 
              <label for="minutos"></label>
              <select name="AM_PM" id="AM_PM">
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select></td>
          </tr>
          <tr>
            <td colspan="4" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center"><input type="submit" name="prestamo" id="prestamo" value="Realizar Prestamo" />
              <input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>" /></td>
          </tr>
          <div id="listar"> <!--div que muestra los datos enviados al hacer click en el botón -->
	 
	</div>
    </table>          <h3>&nbsp;</h3></td>
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