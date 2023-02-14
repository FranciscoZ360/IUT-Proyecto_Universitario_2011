<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css" />
<font face="calibri">
<table cellpadding="0" cellspacing="0" border="0" width="19%">
<tr> 
<td align="left" width="143">
        <ul id="MenuBar1" class="MenuBarVertical">        ---Men&uacute; Principal---       
        <li ><a href="inicio.php" >Entrega|Prestamo</a>        </li>
        <?php if ($_SESSION['nivel']==1) { ?>
        <li><a href="#" class="MenuBarItemSubmenu">Cuenta de Usuario</a>
          <ul>
            <li><a href="agregar_usuario.php">Crear Nueva</a></li>
            <li><a href="listar_usuario.php">Listado</a></li>
          </ul>
        </li>
        <?php } ?>
        <li><a href="#" class="MenuBarItemSubmenu">Profesor</a>
          <ul>
            <li><a href="agregar_profesor.php">Crear Nuevo</a></li>
            <li><a href="listar_profesor.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Equipos</a>
          <ul>
            <li><a href="agregar_equipo.php">Agregar</a></li>
            <li><a href="listar_equipo.php">Listar</a></li>
            <li><a href="equipos_prestados.php">Equipos en pr&eacute;stamo</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Materiales</a>
          <ul>
            <li><a href="agregar_material.php">Agregar</a></li>
            <li><a href="listar_material.php">Listar</a></li>
          </ul>
        </li>
        <li><a href="#" class="MenuBarItemSubmenu">Reportes</a>
          <ul>
            <li><a href="#" class="MenuBarItemSubmenu">Prestamo equipos</a>
              <ul>
                <li><a href="reporte_fecha_equipo.php">Fecha</a></li>
                <li><a href="reporte_profe_equipo.php">Profesor</a></li>
              </ul>
            </li>
            <li><a href="#" class="MenuBarItemSubmenu">Entrega material</a>
              <ul>
                <li><a href="reporte_fecha_material.php">Fecha</a></li>
                <li><a href="reporte_profe_material.php">Profesor</a></li>
              </ul>
            </li>
            <?php if ($_SESSION['nivel']==1) { ?>
            <li><a href="auditoria.php">Ver Auditoria</a></li><?php } ?>
          </ul>
        </li>
        ---Men&uacute; Principal---
        </ul>
    </td>
        </tr>
        </table>
        </font>
    <script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
  </script>
