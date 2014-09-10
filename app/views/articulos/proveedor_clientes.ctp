<div id="nav-menu">
<ul>
<li> <a href="<?php echo $this->webroot?>proveedor/">Inicio</a></li>
<li> <a href="<?php echo $this->webroot?>proveedor/articulos/clientes">Listado de mis clientes</a></li>
</ul>
</div>
<?php echo $this->element('left-menu')?>
<!-- side -->
<div id="admin-table">
	<h2>Clientes</h2>
	<table cellpadding="0" cellspacing="0">
	<tr>

			<th><?php echo ('Nombre');?></th>
			<th><?php echo ('telefonos');?></th>
			<th><?php echo ('email');?></th>
            <th><?php echo ('direccion');?></th>
			<th><?php echo ('codigo_postal');?></th>
		
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($clientes as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
        
	?>
	<tr<?php echo $class;?>>
    <td><?php echo $usuario['Usuario']['title']; ?>&nbsp;</td>
    <td><?php echo $usuario['Usuario']['telefonos']; ?>&nbsp;</td>        
	<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
    <td><?php echo $usuario['Usuario']['direccion']; ?>&nbsp;</td>   
	<td><?php echo $usuario['Usuario']['codigo_postal']; ?>&nbsp;</td>
	<td class="actions">
    
        <a href="<?php echo $this->webroot?>proveedor/usuarios/smail/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('letter.png') ?></a>


        </td>
        <td class="fix">
        
        </td>
	</tr>
<?php endforeach; ?>
<tr class="clear">
<td colspan="7">

</td></tr>

	</table>

</div>
</div>
