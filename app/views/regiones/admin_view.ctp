<div class="regiones view">
<h2><?php  __('Regione');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $regione['Regione']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($regione['Country']['title'], array('controller' => 'countries', 'action' => 'view', $regione['Country']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $regione['Regione']['title']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Regione', true), array('action' => 'edit', $regione['Regione']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Regione', true), array('action' => 'delete', $regione['Regione']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $regione['Regione']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regiones', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regione', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Usuarios');?></h3>
	<?php if (!empty($regione['Usuario'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Regione Id'); ?></th>
		<th><?php __('Rol'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Tipo De Negocio'); ?></th>
		<th><?php __('Persona Contacto'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('Cif'); ?></th>
		<th><?php __('Direccion'); ?></th>
		<th><?php __('Codigo Postal'); ?></th>
		<th><?php __('Iva'); ?></th>
		<th><?php __('Re'); ?></th>
		<th><?php __('Fax'); ?></th>
		<th><?php __('Telefonos'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th><?php __('Fecha Alta'); ?></th>
		<th><?php __('Estado'); ?></th>
		<th><?php __('Ip'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($regione['Usuario'] as $usuario):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $usuario['id'];?></td>
			<td><?php echo $usuario['regione_id'];?></td>
			<td><?php echo $usuario['rol'];?></td>
			<td><?php echo $usuario['title'];?></td>
			<td><?php echo $usuario['tipo_de_negocio'];?></td>
			<td><?php echo $usuario['persona_contacto'];?></td>
			<td><?php echo $usuario['email'];?></td>
			<td><?php echo $usuario['cif'];?></td>
			<td><?php echo $usuario['direccion'];?></td>
			<td><?php echo $usuario['codigo_postal'];?></td>
			<td><?php echo $usuario['iva'];?></td>
			<td><?php echo $usuario['re'];?></td>
			<td><?php echo $usuario['fax'];?></td>
			<td><?php echo $usuario['telefonos'];?></td>
			<td><?php echo $usuario['tim'];?></td>
			<td><?php echo $usuario['fecha_alta'];?></td>
			<td><?php echo $usuario['estado'];?></td>
			<td><?php echo $usuario['ip'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'usuarios', 'action' => 'view', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'usuarios', 'action' => 'edit', $usuario['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'usuarios', 'action' => 'delete', $usuario['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usuario['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
