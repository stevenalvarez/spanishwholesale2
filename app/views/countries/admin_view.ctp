<div class="countries view">
<h2><?php  __('Country');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $country['Country']['title']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Country', true), array('action' => 'edit', $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Country', true), array('action' => 'delete', $country['Country']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $country['Country']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Countries', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Calsados', true), array('controller' => 'calsados', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Calsado', true), array('controller' => 'calsados', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Regiones', true), array('controller' => 'regiones', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regione', true), array('controller' => 'regiones', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Calsados');?></h3>
	<?php if (!empty($country['Calsado'])):?>
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
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Calsado'] as $calsado):
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
<div class="related">
	<h3><?php __('Related Regiones');?></h3>
	<?php if (!empty($country['Regione'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Country Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($country['Regione'] as $regione):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $regione['id'];?></td>
			<td><?php echo $regione['country_id'];?></td>
			<td><?php echo $regione['title'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'regiones', 'action' => 'view', $regione['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'regiones', 'action' => 'edit', $regione['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'regiones', 'action' => 'delete', $regione['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $regione['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Regione', true), array('controller' => 'regiones', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
