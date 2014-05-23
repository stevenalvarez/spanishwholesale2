<?php echo $this->element('nav-menu')?>
<?php echo $this->element('left-menu')?>

<div id="right-side">
<div class="admin-search">
<h2>B&uacute;squeda de Proveedores</h2>
<table>
<tr><td>T&eacute;mino de b&uacute;squeda</td><td>Buscar por</td><td></td><td></td> </tr>
<tr><td><input type="text" /></td><td><select><option>Nombre</option></select></td><td><input type="submit" /></td></tr>
</table>

</div>

<div id="admin-table">
	<h2><?php __('Usuarios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
<!--
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('regione_id');?></th>
			<th><?php echo $this->Paginator->sort('rol');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('tipo_de_negocio');?></th>
-->
			<th><?php echo $this->Paginator->sort('Proveedor','persona_contacto');?></th>
            <th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('telefonos');?></th>
            
			<th><?php echo $this->Paginator->sort('email');?></th>
			<!--
<th><?php echo $this->Paginator->sort('cif');?></th>
			<th><?php echo $this->Paginator->sort('direccion');?></th>
			<th><?php echo $this->Paginator->sort('codigo_postal');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('re');?></th>
		

			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th><?php echo $this->Paginator->sort('fecha_alta');?></th>-->
			<th><?php echo $this->Paginator->sort('estado');?></th>
		<!--
	<th><?php echo $this->Paginator->sort('ip');?></th>
-->
			<th class="actions"><?php __('Actions');?></th>
            <td class="fix"></td>
	</tr>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
        else
        $class = ' class="noaltrow"';
        
	?>
	<tr<?php echo $class;?>>
	<!--	<td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuario['Regione']['title'], array('controller' => 'regiones', 'action' => 'view', $usuario['Regione']['id'])); ?>
		</td>
	
	<td><?php echo $usuario['Usuario']['rol']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['title']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['tipo_de_negocio']; ?>&nbsp;</td>
-->
		<td><?php echo $usuario['Usuario']['persona_contacto']; ?>&nbsp;</td>
        <td><?php echo $usuario['Usuario']['fax']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['telefonos']; ?>&nbsp;</td>        
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
        
		<!--
<td><?php echo $usuario['Usuario']['cif']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['direccion']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['codigo_postal']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['iva']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['re']; ?>&nbsp;</td>
	
		<td><?php echo $usuario['Usuario']['tim']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['fecha_alta']; ?>&nbsp;</td>
		
-->     <td><?php echo $usuario['Usuario']['estado']; ?>&nbsp;</td>

<!--
		<td><?php echo $usuario['Usuario']['ip']; ?>&nbsp;</td>
-->
		<td class="actions">
        <a href="<?php echo $this->webroot?>admin/usuarios/edit/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('pencil.png') ?></a>
        <a href="<?php echo $this->webroot?>admin/usuarios/edit/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('letter.png') ?></a>
        <a href="<?php echo $this->webroot?>admin/usuarios/edit/<?php echo $usuario['Usuario']['id'] ?>"><?php echo $html->image('x.png') ?></a>
        <input type="checkbox" name="aprove[]" value="<?php echo $usuario['Usuario']['id'] ?>"  />
        </td>
        <td class="fix" >
        
        
        
        </td>
	</tr>
<?php endforeach; ?>
<tr class="clear">
<td colspan="7">
<?php
	echo $this->Paginator->counter(array(
	'format' => __('P&aacute;gina %page% de %pages%', true)
	));
	?>


	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?><?php echo $this->Paginator->numbers();?><?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>

</td></tr>


<tr class="clear">
    <td colspan="7">
    <input type="button" class="btn-admin-green" value="Nuevo" />
    
    <div class="admin-buttons">
   
    <input type="button" class="btn-admin-lblue" value="SELECCIONAR" />
    <input type="button" class="btn-admin-lblue" value="DESSELECCIONAR" />
    <input type="button" class="btn-admin-blue" value="APROBAR" />
    
    </div>
    
    </td>
</tr>


	</table>

</div>
</div>
<div class="actions" style="display: none;">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Regiones', true), array('controller' => 'regiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regione', true), array('controller' => 'regiones', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Consultas', true), array('controller' => 'consultas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consulta', true), array('controller' => 'consultas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pedidos', true), array('controller' => 'pedidos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pedido', true), array('controller' => 'pedidos', 'action' => 'add')); ?> </li>
	</ul>
</div>