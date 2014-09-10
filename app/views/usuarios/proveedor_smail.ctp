<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>admin/usuarios/proveedores">Listado de proveedores</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->

<div id="right-side">

<div id="admin-table">
<form method="post" action="<?php echo $this->webroot?>proveedor/usuarios/smail/<?php echo $usuario['Usuario']['id']; ?>">
<input type="hidden" name="id" value="<?php echo $usuario['Usuario']['id']; ?>" />
	<h2>Enviar Mail (<?php echo $usuario['Usuario']['rol']; ?>)</h2>
    <table>
    <tr>
    <td>Email:</td><td><input type="text" readonly="" value="<?php echo $usuario['Usuario']['email']?>" size="100" /></td>
    </tr>
    <tr>
    <td>Asunto:</td><td><input type="text" name="asunto" size="100"  /></td>
    </tr>
   
    <tr>
    <td colspan="2" style="padding: 10px;">
    <textarea name="texto" style="margin: auto; padding: 10px; padding: 2px; width: 658px; height: 100px;" >Hola <?php echo $usuario['Usuario']['title']; ?>:
    </textarea>
    
    </td>
    
    </tr>
    <tr><td colspan="2"><input type="submit" class="btn-admin-green2" value="Enviar Mail" /> </td></tr>
    <tr><td colspan="2"></td></tr>
    
    </table>
</form>
</div>
</div>
