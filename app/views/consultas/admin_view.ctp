<div class="consultas view">
<h2><?php  __('Consulta');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consulta['Consulta']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($consulta['Usuario']['title'], array('controller' => 'usuarios', 'action' => 'view', $consulta['Usuario']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Usuario Prov Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consulta['Consulta']['usuario_prov_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Consulta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consulta['Consulta']['consulta']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tim'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $consulta['Consulta']['tim']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Consulta', true), array('action' => 'edit', $consulta['Consulta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Consulta', true), array('action' => 'delete', $consulta['Consulta']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $consulta['Consulta']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Consultas', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Consulta', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Usuarios', true), array('controller' => 'usuarios', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usuario', true), array('controller' => 'usuarios', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Respuestas', true), array('controller' => 'respuestas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Respuesta', true), array('controller' => 'respuestas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Respuestas');?></h3>
	<?php if (!empty($consulta['Respuesta'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Consulta Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Respuesta'); ?></th>
		<th><?php __('Tim'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($consulta['Respuesta'] as $respuesta):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $respuesta['id'];?></td>
			<td><?php echo $respuesta['consulta_id'];?></td>
			<td><?php echo $respuesta['title'];?></td>
			<td><?php echo $respuesta['respuesta'];?></td>
			<td><?php echo $respuesta['tim'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'respuestas', 'action' => 'view', $respuesta['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'respuestas', 'action' => 'edit', $respuesta['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'respuestas', 'action' => 'delete', $respuesta['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $respuesta['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Respuesta', true), array('controller' => 'respuestas', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
