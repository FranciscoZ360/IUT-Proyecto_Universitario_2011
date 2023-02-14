<?php 
session_start(); // todas las paginas internas recuperan la sesion
if (!isset($_SESSION['usuario'])) {
	// redirecciona a login
	header("Location: login.php?error=2");
	exit; // detenga el script
}
require ("clases/class_DAO_material.php");
// crea el objeto dao usuario
try {
	//$id = $_GET['id'];
	$material = new DAO_material();

$reg = $material->getDescripcionMaterial();
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
	 
	$("#agregar").click(cargarMaterial);
	$("#eliminar").click(eliminarMaterial);
});

function eliminarMaterial(){
	$("#materiales option").each(function(){
		if($(this).attr("selected")){
			$(this).remove();
		}
	});
	return false;
}


function cargarMaterial(){
	var prueba2 = /^(([0-9]+)([0-9]+)?)$/;
	if (($("#cantidad").attr("value")=="")  || 
		($("#cantidad").attr("value").match(prueba2)==null)){
			alert('Debe introducir una cantidad de solo numeros');
			$("#cantidad").attr("value").focus;
			return false;
	}
	
	
	var material = $("#descripcion").attr("value").split("-->"); // id material
	var cantidad = $("#cantidad").attr("value"); 	// cantidad
	var datos = {id:material[0],cant:cantidad};
	//alert (material[0]);
	$.ajax({					// para usar ajax
		   async:true,			// Carga del objeto de forma asyncrona
		   type: "POST",		// metodo a utilizar
		   dataType: "json",	// tipo de dato a devolver
		   data: datos,			// datos a enviar
		   contentType: "application/x-www-form-urlencoded",
		   url:"revisarCantidad.php", 	// pagina a invocar
		   success:function(res){			
			   if(res[0]!=false){
				   if (res[0]=="SI") { // puede hacer el prestamo
				   		if (res[1]=="SI") {
							alert("Queda poca existencia del material seleccionado");
						}
				   		// se agrega el material a la lista
						var valor= $("#cantidad").attr("value")+"-->"+$("#descripcion").attr("value");
						var valor2 = $("#descripcion").attr("value").split("-->");
						var valormostrar = $("#cantidad").attr("value")+"-->"+valor2[1];
						var option="";
						var existe=false;
						if($("#descripcion").attr("value")!="0"){
							$("#materiales option").each(function(){
								var dentro = $(this).attr("value");
								var materialdentro = dentro.split("-->");
								var opcion = $("#descripcion").attr("value").split("-->");
								if(materialdentro[1]==opcion[0])
									existe=true;
							});
							if(existe==false){
								option="<option value='"+valor+"'>"+valormostrar+"</option>";
								
								$("#materiales").append(option);
							}
						}
				   } else
				   		alert ("No hay suficiente cantidad de material");
			   }
		   },
		   timeout:10000,	// tiempo de espera en milisegundos
		   error:function(valor){
			   		alert("No se pudo procesar su consulta. Tiempo límite sobrepasado:"+valor);
					
			    }
		 });
	return false;
}
function validarLista(action1){
if(action1.materiales.value==""){
alert("Debe seleccionar los elementos en la lista");
	return (false);
	
}
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
    <td width="622" table style="background:url('img/Fondo-2.jpg') no-repeat bottom center"><form id="action1" name="action1" method="post" onSubmit="return validarLista(this);" action="registroMaterial.php">
      <table width="100%" border="0" align="center">
      <tr>
        <td colspan="2" align="center"><table width="100%" border="0" align="center">
          <tr>
          
            <td colspan="4" align="center"><h2>Entrega de material</h2></td>
          </tr>
         
          <tr>
        
            <td width="132" align="right">Descripcion:               </td>
            <td width="132" align="right"><select name="descripcion" id="descripcion">
              <option value="0">Elige Material</option>
              <?php
		 $i = 0;
			while($i < count($reg)){
			 echo "<option value='".$reg[$i]['id_material']."-->".$reg[$i]['descripcion']."'>".$reg[$i]['descripcion']."</option>";
			 $i++;
               }
			   ?>
            </select></td>
            <td width="140">&nbsp;</td>
            <td width="184" rowspan="3"><label for="material"></label>
              <select name="materiales[]" size="4" multiple="multiple" id="materiales" style="width:150px">
              </select></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td width="132" align="right">&nbsp;</td>
            <td align="center"><input type="submit" name="agregar" id="agregar" value="Agregar&gt;&gt;" /></td>
            </tr>
          <tr>
            <td align="right">Cantidad:</td>
            <td align="right"><input name="cantidad" type="text" id="cantidad" size="5" maxlength="5" /></td>
            <td align="center"><input type="submit" name="eliminar" id="eliminar" value="&lt;&lt;Eliminar" /></td>
            </tr>
          <tr>
            <td colspan="4" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4" align="center"><input type="submit" name="prestamo" id="boton_ver" value="Realizar entrega" />
              <input type="hidden" name="id_profesor" id="id_profesor" value="<?php echo $_GET['id']; ?>" /></td>
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