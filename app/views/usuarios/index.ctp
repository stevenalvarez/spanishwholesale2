<div class="usuarios index">
	<h2><?php __('Usuarios');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('regione_id');?></th>
			<th><?php echo $this->Paginator->sort('rol');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('tipo_de_negocio');?></th>
			<th><?php echo $this->Paginator->sort('persona_contacto');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th><?php echo $this->Paginator->sort('cif');?></th>
			<th><?php echo $this->Paginator->sort('direccion');?></th>
			<th><?php echo $this->Paginator->sort('codigo_postal');?></th>
			<th><?php echo $this->Paginator->sort('iva');?></th>
			<th><?php echo $this->Paginator->sort('re');?></th>
			<th><?php echo $this->Paginator->sort('fax');?></th>
			<th><?php echo $this->Paginator->sort('telefonos');?></th>
			<th><?php echo $this->Paginator->sort('tim');?></th>
			<th><?php echo $this->Paginator->sort('fecha_alta');?></th>
			<th><?php echo $this->Paginator->sort('estado');?></th>
			<th><?php echo $this->Paginator->sort('ip');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $usuario['Usuario']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($usuario['Regione']['title'], array('controller' => 'regiones', 'action' => 'view', $usuario['Regione']['id'])); ?>
		</td>
		<td><?php echo $usuario['Usuario']['rol']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['title']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['tipo_de_negocio']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['persona_contacto']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['cif']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['direccion']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['codigo_postal']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['iva']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['re']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['fax']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['telefonos']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['tim']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['fecha_alta']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['estado']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['ip']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $usuario['Usuario']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['Usuario']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
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