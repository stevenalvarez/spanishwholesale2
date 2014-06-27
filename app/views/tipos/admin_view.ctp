<div class="tipos view">
<h2><?php  __('Tipo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orden'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['orden']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Activo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipo['Tipo']['activo']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipo', true), array('action' => 'edit', $tipo['Tipo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Tipo', true), array('action' => 'delete', $tipo['Tipo']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipo['Tipo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Calsados');?></h3>
	<?php if (!empty($tipo['Calsado'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
        <!--
		<th><?php __('Categoria Id'); ?></th>
        -->
		<th><?php __('Code'); ?></th>
        <!--
		<th><?php __('Tipo Id'); ?></th>
        -->
		<th><?php __('Usuario Id'); ?></th>
		<th><?php __('Material Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Marca'); ?></th>
		<th><?php __('Activado'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th><?php __('Venta'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipo['Calsado'] as $calsado):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $calsado['id'];?></td>
            <!--
			<td><?php echo $calsado['categoria_id'];?></td>
            -->
			<td><?php echo $calsado['code'];?></td>
            <!--
			<td><?php echo $calsado['tipo_id'];?></td>
            -->
			<td><?php echo $calsado['usuario_id'];?></td>
			<td><?php echo $calsado['material_id'];?></td>
			<td><?php echo $calsado['country_id'];?></td>
			<td><?php echo $calsado['title'];?></td>
			<td><?php echo $calsado['marca'];?></td>
			<td><?php echo $calsado['activado'];?></td>
			<td><?php echo $calsado['tim'];?></td>
			<td><?php echo $calsado['venta'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'calsados', 'action' => 'view', $calsado['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'calsados', 'action' => 'edit', $calsado['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'calsados', 'action' => 'delete', $calsado['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $calsado['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
